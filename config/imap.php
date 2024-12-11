<?php

return [
    'default' => env('IMAP_MAILBOX', 'default'),

    'mailboxes' => [
        'default' => [
            'host' => env('MAIL_HOST', 'imap.gmail.com'),
            'port' => env('MAIL_PORT', 993),
            'protocol' => 'imap',  // Dùng IMAP
            'username' => env('MAIL_USERNAME'),
            'password' => env('MAIL_PASSWORD'),
            'encrypt' => 'ssl',    // Sử dụng SSL
        ],
    ],
];
