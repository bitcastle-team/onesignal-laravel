<?php

namespace Bitcastle\OneSignal;

use Illuminate\Support\Collection;
use GuzzleHttp\Client;

class OneSignalService
{
    const API_URL = "https://onesignal.com/api/v1";

    const ENDPOINT_NOTIFICATIONS = "/notifications";
    const ENDPOINT_PLAYERS       = "/players";

    private $client;
    private $appSettings = [];

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Set property appSettings
     *
     * @param array $confs
     * @return none
     */
    public function setConfigs(array $confs){
        if(!is_null($confs)) {
            $this->appSettings = $confs;
        }
    }

    /**
     * Return a config value from appSettings property
     *
     * @param string $settingKey
     * @return mixed $config
     */
    public function setting(string $settingKey){
        // check for setting key to return it
        if(isset($this->appSettings[$settingKey])){
            return $this->appSettings[$settingKey];
        }

        return null;
    }

    /**
     * Send notification to OneSignal
     *
     * @param OneSignalNotification $notification
     * @return GuzzleHttp\Psr7\Response
     */
    public function sendNotification(OneSignalNotification $notification)
    {

        // set app_id property based on Service Settings from configs/onesignal.php
        if(empty($notification->app_id)){
            $notification->setAppId($this->setting("appKey"));
        }

        $response = $this->client->request('POST', self::API_URL . self::ENDPOINT_NOTIFICATIONS, [
            'json' => $notification->toArray(),
            'headers' => [
                'Content-Type'  => 'application/json; charset=utf-8',
                'Authorization' => 'Basic ' . $this->setting("restKey")
            ]
        ]);

        return $response;
    }

}
