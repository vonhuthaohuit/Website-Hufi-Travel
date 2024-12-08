<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Webklex\IMAP\Facades\IMAP;

class EmailController extends Controller
{
    public function getEmails()
    {
        // Kết nối đến IMAP server (Gmail)
        $client = IMAP::open([
            'host' => env('MAIL_HOST'),
            'port' => env('MAIL_PORT'),
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'encrypt' => env('MAIL_ENCRYPTION'),
        ]);

        // Kiểm tra kết nối có lỗi hay không
        if ($client->hasError()) {
            echo "Error: " . $client->getError();
        } else {
            // Lấy tất cả email
            $emails = $client->getMessages();

            foreach ($emails as $email) {
                echo 'Subject: ' . $email->getSubject() . '<br>';
                echo 'From: ' . $email->getFrom()->getAddress() . '<br>';
                echo 'Date: ' . $email->getDate() . '<br>';
                echo 'Body: ' . $email->getTextBody() . '<br>';
                echo '<hr>';
            }
        }
    }
}
