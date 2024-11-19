<?php
namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class BackupNotificationMail extends Mailable
{
    use SerializesModels;

    public $status;
    public $details;

    public function __construct($status, $details)
    {
        $this->status = $status;  // Trạng thái sao lưu (thành công hoặc thất bại)
        $this->details = $details;  // Các chi tiết sao lưu như tên sao lưu, dung lượng, ngày giờ, v.v.
    }

    public function build()
    {
        return $this->subject('Database Backup Status')
                    ->view('backend.email.backup_notification');  // Sử dụng view để hiển thị nội dung email
    }
}
