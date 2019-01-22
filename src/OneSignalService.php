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

    public function __construct()
    {
        $this->client = new Client();
    }

    /**
     * Send notification to OneSignal
     *
     * @param OneSignalNotification $notification
     * @return GuzzleHttp\Psr7\Response
     */
    public function sendNotification(OneSignalNotification $notification)
    {

        $response = $this->client->request('POST', self::API_URL . self::ENDPOINT_NOTIFICATIONS, [
            'json' => $notification->toArray(),
            'headers' => [
                'Content-Type'  => 'application/json; charset=utf-8',
                'Authorization' => 'Basic ' . config('oneSignal.restKey')
            ]
        ]);

        return $response;
    }
}
