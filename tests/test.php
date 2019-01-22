<?php
require_once __DIR__ . '/../vendor/autoload.php';
use Bitcastle\OneSignal\OneSignalService;
use Bitcastle\OneSignal\OneSignalNotification;

$notification = new OneSignalNotification("Testing Message", "Testing Title");
$client = new OneSignalService();
echo "Notification and Client instantiated, namespace works";