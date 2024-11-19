<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Spatie\Backup\BackupDestination;
use Spatie\Backup\Tasks\Backup\BackupJobFactory;
use Spatie\Backup\Tasks\Backup\BackupJob;
use Illuminate\Support\Facades\DB;

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

            $command = "mysqldump -h {$dbHost} -u {$dbUser}  {$dbName}";

            // Thêm tham số --routines nếu cần
            if ($includeRoutines) {
                $command .= ' --routines';
            }

            // Thêm tham số --triggers nếu cần
            if ($includeTriggers) {
                $command .= ' --triggers';
            }

            // Tạo tên tệp backup hoặc sử dụng tên tùy chỉnh
            $filename = $this->option('filename') ?? storage_path('app/backup') . '/' . $dbName . '_' . date('Y-m-d_H-i-s') . '.sql';

            // Thực thi lệnh mysqldump
            exec($command . " > {$filename}", $output, $returnVar);

            if ($returnVar !== 0) {
                $this->error('Backup failed: ' . implode("\n", $output));
                return;
            }
            // Thêm chức năng nén tệp sao lưu
            \Log::info("message");
            $zipBackupFile = storage_path('app/backup') . '/' . $dbName . '_' . date('Y-m-d_H-i-s') . '.zip';
            $zipCommand = "D:\dowload\Game_UD\7-Zip -r {$zipBackupFile} {$filename}";

            exec($zipCommand, $zipOutput, $zipReturnVar);

            if ($zipReturnVar !== 0) {
                $this->error('Compression failed: ' . implode("\n", $zipOutput));
                return;
            }

            // Xóa tệp .sql sau khi nén để tiết kiệm không gian
            unlink($filename);
            // Thông báo thành công
            $this->info("Backup created successfully at: {$filename}");
        } catch (\Exception $e) {
            $this->error('Error: ' . $e->getMessage());
        }
    }
}
