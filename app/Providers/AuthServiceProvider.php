<?php

namespace App\Providers;

// use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        //
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot()
    {
        // Storage::extend('google', function ($app, $config) {
        //     $client = new Google_Client();
        //     $client->setClientId($config['client_id']);
        //     $client->setClientSecret($config['client_secret']);
        //     $client->refreshToken($config['refresh_token']);
        //     $service = new \Google_Service_Drive($client);
        //     $adapter = new GoogleDriveAdapter($service, $config['folder_id']);
        //     return new Filesystem($adapter);
        // });
    }
}
