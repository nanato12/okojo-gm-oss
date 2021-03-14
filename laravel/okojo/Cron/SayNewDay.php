<?php

namespace OkojoBot\Cron;

use OkojoBot\Config;
use Phine\Client;

class SayNewDay
{
    public static function helloAdmin()
    {
        $bot = new Client(
            env("LINE_BOT_CHANNEL_SECRET"),
            env("LINE_BOT_CHANNEL_ACCESS_TOKEN")
        );

        $messages = $bot->createMultiMessage(
            [
                $bot->createTextMessage("hello"),
                $bot->createTextMessage("hi"),
            ]
        );

        $bot->pushMessage(Config::ADMIN_UID, $messages);
    }
}
