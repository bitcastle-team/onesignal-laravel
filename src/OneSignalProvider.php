<?php

namespace Bitcastle\OneSignal;

use Illuminate\Support\ServiceProvider;
use OneSignalService as OneSignal;

class OneSignalProvider extends ServiceProvider
{
    /**
     * Register bindings in the container.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(OneSignal::class, function ($app) {
            return new OneSignal;
        });
    }
}
