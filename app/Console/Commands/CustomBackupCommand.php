<?php

namespace App\Console\Commands;

use App\Mail\BackupNotificationMail;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Mail;

class CustomBackupCommand extends Command
{
    protected $signature = 'backup:run
                            {--only-db : Backup only the database}
                            {--routines : Include routines in the backup}
                            {--triggers : Include triggers in the backup}
                            {--filename= : Specify the filename for the backup}
                            {--only-to-disk= : Specify which disk to store the backup on}
                            ';
    protected $description = 'Backup the database including routines and triggers if specified';
    public function handle()
    {
        try {
            // Kiểm tra các tùy chọn có được cung cấp không
            $includeRoutines = $this->option('routines');
            $includeTriggers = $this->option('triggers');
            // Tạo câu lệnh mysqldump cho cơ sở dữ liệu
            $dbHost = env('DB_HOST', '127.0.0.1');
            $dbName = env('DB_DATABASE');
            $dbUser = env('DB_USERNAME');
            $dbPassword = env('DB_PASSWORD');

            $command = "mysqldump  -h {$dbHost} -u {$dbUser}  {$dbName}";

            // Thêm tham số --routines nếu cần
            if ($includeRoutines) {
                $command .= ' --routines';
            }

            // Thêm tham số --triggers nếu cần
            if ($includeTriggers) {
                $command .= ' --triggers';
            }

            // Tạo tên tệp backup hoặc sử dụng tên tùy chỉnh
            $filename = $this->option('filename') ?? storage_path('app/backup') . '/' . $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.sql';

            // Thực thi lệnh mysqldump
            exec($command . " > {$filename}", $output, $returnVar);

            if ($returnVar !== 0) {
                $this->error('Backup failed: ' . implode("\n", $output));
                return;
            }
            // Thêm chức năng nén tệp sao lưu
            $zipBackupFile = storage_path('app/backup') . '/' . $dbName . '_backup_' . date('Y-m-d_H-i-s') . '.zip';
            $zipCommand = "7z a {$zipBackupFile} {$filename}";

            exec($zipCommand, $zipOutput, $zipReturnVar);

            if ($zipReturnVar !== 0) {
                $this->error('Compression failed: ' . implode("\n", $zipOutput));
                return;
            }

            // Xóa tệp .sql sau khi nén để tiết kiệm không gian
            unlink($filename);
            // Thông báo thành công
            $this->info("Backup created successfully at: {$filename}");
            $this->sendBackupNotification('success', $filename);
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
            $this->sendBackupNotification('failed', $e->getMessage());
        }
    }
    protected function sendBackupNotification($isSuccessful)
    {
        // Lấy thông tin sao lưu từ hệ thống
        $backupPath = storage_path('app/backup');
        $backupFiles = File::files($backupPath);

        // Lấy tệp sao lưu mới nhất
        $newestBackupFile = collect($backupFiles)->sortByDesc(function ($file) {
            return File::lastModified($file);
        })->first();

        $newestBackupSize = File::size($newestBackupFile) / 1024;
        $numberOfBackups = count($backupFiles);
        $totalStorageUsed = collect($backupFiles)->sum(function ($file) {
            return File::size($file);
        }) / 1024 / 1024; // Tổng dung lượng sử dụng (MB)

        // Lấy ngày sao lưu mới nhất
        $newestBackupDate = date('Y/m/d H:i:s', File::lastModified($newestBackupFile));
        $oldestBackupDate = date('Y/m/d H:i:s', File::lastModified($backupFiles[0])); // Ngày sao lưu cũ nhất

        // Cập nhật thông số vào biến $details
        $details = [
            'backup_name' => 'Laravel',
            'disk' => 'local',
            'newest_backup_size' => number_format($newestBackupSize, 2), // Định dạng kích thước sao lưu
            'number_of_backups' => $numberOfBackups,
            'total_storage_used' => number_format($totalStorageUsed, 2),
            'newest_backup_date' => $newestBackupDate,
            'oldest_backup_date' => $oldestBackupDate,
        ];

        // Gửi email thông báo với chi tiết sao lưu
        Mail::to('hoankien140703@gmail.com')->send(new BackupNotificationMail($isSuccessful ? 'Backup successful' : 'Backup failed', $details));
    }
}
