<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Backup;
use Exception;
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
            // Thực thi lệnh backup từ Artisan command
            $output = Artisan::call('backup:run', [
                '--only-db' => true,    // Chỉ backup database
                '--routines' => true,   // Bao gồm routines
                '--triggers' => true,   // Bao gồm triggers
            ]);

            // Kiểm tra kết quả và trả về thông báo
            if ($output === 0) {
                return back()->with('success', 'Database backup completed successfully!');
            } else {
                return back()->with('error', 'Database backup failed!');
            }
        } catch (Exception $e) {
            return back()->with('error', 'Error: ' . $e->getMessage());
        }
    }

    public function scheduleBackup(Request $request)
    {
        $request->validate([
            'backup_frequency' => 'required|in:daily,weekly,monthly',
            'backup_time' => 'required',
            'backup_day' => 'nullable|required_if:backup_frequency,weekly',
            'backup_day_of_month' => 'nullable|required_if:backup_frequency,monthly|integer|min:1|max:31',
        ]);
        // Lưu vào bảng backup_schedules
        $schedule = new Backup();
        $schedule->frequency = $request->backup_frequency;
        $schedule->backup_time = $request->backup_time;
        $schedule->backup_day = $request->backup_day;
        $schedule->backup_day_of_month = $request->backup_day_of_month;
        $schedule->save();
        return back()->with('success', 'Chọn lịch sao lưu thành công!');
    }
    public function removeSchedules()
    {
        try
        {
            Backup::truncate();
            return redirect()->route('backup.index')->with('success', 'Xoá lịch thành công.');
        }
        catch(Exception $e)
        {
            return redirect()->route('backup.index')->with('error', 'Xoá lịch không thành công.');
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



}
