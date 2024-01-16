<?php
include "bootstrap/config.php";

$url = 'https://f5ec-2-182-127-40.ngrok-free.app' . '/Bots/mainBot/bot.php';

include "vendor/autoload.php";
$bot = new \App\Telegram\telegramBot(TOKEN);
var_dump( $bot -> setWebhook(preg_replace('/\s+/', '', $url)));
