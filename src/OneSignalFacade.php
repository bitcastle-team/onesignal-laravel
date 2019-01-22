<?php

namespace Bitcastle\OneSignal;

use Illuminate\Support\Facades\Facade;
use OneSignalService as OneSignal;

class OneSignalFacade extends Facade
{
    protected static function getFacadeAccessor()
    {
        return OneSignal::class;
    }
}
