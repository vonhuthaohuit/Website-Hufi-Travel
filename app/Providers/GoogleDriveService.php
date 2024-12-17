<?php

namespace App\Providers;
use Google\Client;
use Google\Service\Drive;

class GoogleDriveService
{
    protected $client;

    public function __construct()
    {
        $this->client = new Client();
        $this->client->setClientId(config('services.google.client_id'));
        $this->client->setClientSecret(config('services.google.client_secret'));
        $this->client->refreshToken(config('services.google.refresh_token'));
    }

    public function uploadFile($filePath, $fileName)
    {
        $driveService = new Drive($this->client);

        $fileMetadata = new Drive\DriveFile([
            'name' => $fileName,
        ]);

        $content = file_get_contents($filePath);

        $file = $driveService->files->create($fileMetadata, [
            'data' => $content,
            'mimeType' => mime_content_type($filePath),
            'uploadType' => 'multipart',
            'fields' => 'id',
        ]);

        return $file->id;
    }
}
