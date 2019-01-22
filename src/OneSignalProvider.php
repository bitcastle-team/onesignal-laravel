<?php

namespace Bitcastle\OneSignal;

use Illuminate\Support\ServiceProvider;
use OneSignalService as OneSignal;

class OneSignalProvider extends ServiceProvider
{

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $configPath = __DIR__ . '/../config/onesignal.php';
        $this->publishes([$configPath => config_path('onesignal.php')], 'config');
        $this->mergeConfigFrom($configPath, 'onesignal');
        if ( class_exists('Laravel\Lumen\Application') ) {
            $this->app->configure('onesignal');
        }
    }

    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {            
        $this->app->bind(OneSignal::class, function ($app) {
            // check for defined onesignal config for the application
            $config = isset($app['config']['services']['onesignal']) ? $app['config']['services']['onesignal'] : null;
            if (is_null($config)) {
                $config = $app['config']['onesignal'] ?: $app['config']['onesignal::config'];
            }

            // initialize service and set config application for it
            $onesignalClient = new OneSignal();
            $onesignalClient->setConfig($config);
            return $onesignalClient;
        });
    }
}
