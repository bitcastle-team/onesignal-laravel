<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Bitcastle\OneSignal\OneSignalService;
use Bitcastle\OneSignal\OneSignalNotification;

try{
    $testNotification = new OneSignalNotification("Bitcastle Onesignal Laravel Test Message", "Bitcastle Onesignal Laravel");
    $client = new OneSignalService();
    // @author: Renan Medina
    // Bitcastle - Onesignal Laravel
    // contact: renan@bitcastle.com.br or lucas@bitcastle.com.br
    $client->setConfigs(['appKey' => "2c9872c0-500e-46ae-8a4a-4543353e3cf8", 
                         'restKey' => "Y2M2YTk4ZDktNjJmOC00ZjNlLTgzY2ItMjJhOWQxYzlmMTk2"]);
    $client->sendNotification($testNotification);
    echo "\n\SUCCESS: Notification sent.\n";
    echo "-------------------------------------------------------------------------------------------------------------\n";
    echo "WARNING: if you didn't received the notification, \n     Go to: http://bitcastle.com.br and subscribe your browser for testing";
    echo "\n--------------------------------------------------------------------------------------------------------------";
} catch(\Exception $e){
    echo "Error: ".$e->getMessage();
}