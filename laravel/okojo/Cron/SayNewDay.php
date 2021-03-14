<?php

namespace OkojoBot\Cron;

use LINE\LINEBot;
use LINE\LINEBot\MessageBuilder\MultiMessageBuilder;
use LINE\LINEBot\MessageBuilder\TextMessageBuilder;
use OkojoBot\Config;

class SayNewDay
{
    public static function helloAdmin()
    {
        /** @var LINEBot $bot */
        $bot = app('line-bot');

        $messages = new MultiMessageBuilder();
        $messages->add(new TextMessageBuilder("hello"));
        $messages->add(new TextMessageBuilder("hi"));

        $bot->pushMessage(Config::ADMIN_UID, $messages);
    }
}
