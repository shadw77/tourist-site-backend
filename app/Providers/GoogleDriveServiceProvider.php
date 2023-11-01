<?php

namespace App\Providers;
// require './vendor/autoload.php';

use Illuminate\Support\ServiceProvider;
use Hypweb\Flysystem\GoogleDrive\GoogleDriveAdapter;

class GoogleDriveServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        \Storage::extend('google', function($app, $config) {
            $client = new \Google_Client();
            $client->setClientId($config['clientId']);
            $client->setClientSecret($config['clientSecret']);
            $client->refreshToken($config['refreshToken']);
            $service = new \Google_Service_Drive($client);
            $adapter =  new GoogleDriveAdapter($service, $config['folderId']);
			

            return new \League\Flysystem\Filesystem($adapter);
        });
    }
	public function register()
    {
        //
    }
}