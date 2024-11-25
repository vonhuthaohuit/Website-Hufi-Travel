<?php
namespace App\Console;

use App\Models\Backup;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    protected function schedule(Schedule $schedule): void
    {
        // Lấy tất cả các lịch sao lưu từ bảng Backup
        $backupSchedules = Backup::all();

        foreach ($backupSchedules as $backupSchedule) {
            // Nếu tần suất là hàng ngày
            if ($backupSchedule->frequency === 'daily') {
                $schedule->command('backup:run --only-db --routines --triggers')
                    ->dailyAt($backupSchedule->backup_time) // Lên lịch vào thời gian sao lưu
                    ->appendOutputTo(storage_path('logs/backup.log'));
            }

            // Nếu tần suất là hàng tuần
            elseif ($backupSchedule->frequency === 'weekly') {
                $schedule->command('backup:run --only-db --routines --triggers')
                    ->weeklyOn(
                        array_search($backupSchedule->backup_day, ['Sunday', 'Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday']),
                        $backupSchedule->backup_time
                    )
                    ->appendOutputTo(storage_path('logs/backup.log'));
            }

            // Nếu tần suất là hàng tháng
            elseif ($backupSchedule->frequency === 'monthly') {
                $schedule->command('backup:run --only-db --routines --triggers')
                    ->monthlyOn($backupSchedule->backup_day_of_month, $backupSchedule->backup_time)
                    ->appendOutputTo(storage_path('logs/backup.log'));
            }
        }
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__ . '/Commands');

        require base_path('routes/console.php');
    }

    // Đảm bảo rằng lệnh của bạn đã được đăng ký
    protected $commands = [
        \App\Console\Commands\CustomBackupCommand::class,
    ];
}
