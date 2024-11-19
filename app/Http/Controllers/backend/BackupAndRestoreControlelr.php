<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\DB;
use mysqli;

class BackupAndRestoreControlelr extends Controller
{
    public function index()
    {
        return view('backend.backup-restore');
    }

    public function backup()
    {
        try {
            // Lấy thông tin kết nối từ file .env
            $dbName = env('DB_DATABASE');
            $dbUser = env('DB_USERNAME');
            $dbPassword = env('DB_PASSWORD');
            $dbHost = env('DB_HOST', '127.0.0.1');

            // Tạo thư mục lưu trữ backup nếu chưa tồn tại
            $backupDirectory = storage_path('app/backup');
            if (!file_exists($backupDirectory)) {
                mkdir($backupDirectory, 0777, true); // Tạo thư mục với quyền truy cập đầy đủ
            }

            // Tạo tên tệp backup
            $backupFile = $backupDirectory . '/' . $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.sql';
            $zipBackupFile = $backupDirectory . '/' . $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.zip'; // Tên tệp zip

            // Lệnh backup bao gồm routines và triggers
            $command = "mysqldump -h {$dbHost} -u {$dbUser} --password=\"{$dbPassword}\" --routines --triggers {$dbName} > \"{$backupFile}\"";

            // Thực thi lệnh mysqldump
            exec($command, $output, $return_var);

            // Kiểm tra kết quả thực thi
            if ($return_var !== 0) {
                throw new \Exception('Backup command failed: ' . implode("\n", $output));
            }

            // Nén tệp sao lưu thành .zip
            $zipCommand = "7z a \"{$zipBackupFile}\" \"{$backupFile}\"";
            exec($zipCommand, $output, $return_var);

            // Kiểm tra kết quả nén tệp
            if ($return_var !== 0) {
                throw new \Exception('Compression command failed: ' . implode("\n", $output));
            }

            // Xóa tệp .sql sau khi nén (tuỳ chọn)
            unlink($backupFile);

            return back()->with('success', "Backup created successfully! File: {$zipBackupFile}");
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }




    public function restore(Request $request)
    {
        try {
            // Kiểm tra xem tệp sao lưu có tồn tại không
            $file = $request->file('backup_file');
            if (!$file) {
                return back()->with('error', 'Please upload a backup file.');
            }

            // Lưu tệp sao lưu vào thư mục tạm thời
            $path = $file->storeAs('backup', $file->getClientOriginalName());

            // Kiểm tra xem tệp có phải là file nén không (ví dụ: .zip)
            $fileExtension = $file->getClientOriginalExtension();
            $extractPath = storage_path('app' . DIRECTORY_SEPARATOR . 'backup' . DIRECTORY_SEPARATOR . 'extracted');

            if (!file_exists($extractPath)) {
                mkdir($extractPath, 0777, true); // Tạo thư mục nếu không tồn tại
            }

            $zip = new \ZipArchive();
            $pathToExtractedFile = ''; // Biến lưu trữ đường dẫn đến tệp SQL

            if (in_array($fileExtension, ['zip', 'tar', 'gz'])) {
                // Giải nén tệp nếu là file nén
                if ($fileExtension === 'zip' && $zip->open(storage_path('app' . DIRECTORY_SEPARATOR . $path)) === TRUE) {
                    $zip->extractTo($extractPath);
                    $zip->close();
                    // Kiểm tra thư mục sau khi giải nén
                } elseif ($fileExtension === 'tar') {
                    $phar = new \PharData(storage_path('app' . DIRECTORY_SEPARATOR . $path));
                    $phar->extractTo($extractPath);
                    // Kiểm tra thư mục sau khi giải nén
                }
            }
            // Tìm tất cả các file .sql trong thư mục giải nén
            $extractedFiles = glob($extractPath . DIRECTORY_SEPARATOR . '*.sql');

            // Kiểm tra xem có file .sql không
            if (empty($extractedFiles)) {
                return back()->with('error', 'No SQL file found in the extracted archive.');
            }

            // Chọn file SQL đầu tiên (nếu có nhiều hơn một file .sql)
            $pathToExtractedFile = $extractedFiles[0];

            // Kiểm tra xem file SQL có tồn tại sau khi giải nén không
            if (!file_exists($pathToExtractedFile)) {
                return back()->with('error', 'SQL file not found after extraction.');
            }

            // Đọc nội dung tệp SQL
            $sqlContent = file_get_contents($pathToExtractedFile);
            if (!$sqlContent) {
                return back()->with('error', 'SQL file is empty or could not be read.');
            }
            $dbName = env('DB_DATABASE'); // Lấy tên database từ file .env
            $dbUser = env('DB_USERNAME'); // Lấy username từ file .env
            $dbHost = env('DB_HOST'); // Lấy host từ file .env

            // Drop database và tạo lại trước khi phục hồi
            DB::statement("DROP DATABASE IF EXISTS {$dbName}");
            DB::statement("CREATE DATABASE {$dbName}");
            $command = "mysql -v -u {$dbUser} --default-character-set=utf8mb4 {$dbName} < {$pathToExtractedFile}";
            exec($command, $output, $status);
            unlink($pathToExtractedFile);

            if ($output === null) {
                return back()->with('error', 'Error occurred during restore process.');
            }
            return back()->with('success', 'Database restored successfully!');
        } catch (\Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    // 'mysql' => [
    //     'dump' => [
    //         'host' => env('DB_HOST', '127.0.0.1'),
    //         'port' => env('DB_PORT', '3306'),
    //         'database' => env('DB_DATABASE'),
    //         'username' => env('DB_USERNAME'),
    //         'password' => env('DB_PASSWORD'),
    //         'useSingleTransaction' => true,
    //         'add_extra_option' => '--routines --triggers', // Bổ sung routines và triggers
    //     ],
    // ],
}
