<?php
ini_set('display_errors', 1);
require_once '../../vendor/autoload.php';

use Symfony\Component\Cache\Adapter\FilesystemAdapter;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Cache\SymfonyCache;
use BotMan\BotMan\Drivers\DriverManager;

require_once('conversacion.php');

$config = [
    'facebook' => [
        'token' => 'EAAFzPhCnZCqEBAKEdX8EZBxmFkb6zlkCMA7tWbzv0giPJ8K8BTfIN1Euti2Hz2oGwVeFSHLYLKaHje1GPKdYIZB2kPRHu426D9vvvNSZB0rNo5ipikZCXDw6Ndbam0txYXm2mtbsLSMsn6nEARjyTonScz8csZCCzh1tfE80mLKIn31fO2xCN7cakyxQxk9YdymGPmI35P4puVjDshj4PL',
        'app_secret' => '02f0ecd3e4cf905915bf8d222c376c11',
        'verification' => 'Token-RvoBot',
    ],
    'user_cache_time' => 720,
    'config' => [
        'conversation_cache_time' => 720 ,
    ],
];

DriverManager::loadDriver(\BotMan\Drivers\Web\WebDriver::class);
DriverManager::loadDriver(\BotMan\Drivers\Facebook\FacebookDriver::class);

$adapter = new FilesystemAdapter();

$botman = BotManFactory::create($config, new SymfonyCache($adapter));

$botman->hears('.*(hola|buenas|buen|día|dia|tarde|noche|buenos día|buenos dia|buenas tarde|buenas noche).*', function ($bot) {
    //Se espera un segundo+
    $bot->typesAndWaits(3);
    //Se inicia la conversación
    $bot->startConversation(new conversacion);
});

// $botman->hears('pause', function($bot) {
// })->skipsConversation();

$botman->hears('salir', function($bot) {
})->stopsConversation();

// $botman->fallback(function ($bot) {
//     $bot->typesAndWaits(3);
//     $bot->reply('Lo siento no te puedo ayudar, no entiendo este comando');
// });


$botman->listen();
