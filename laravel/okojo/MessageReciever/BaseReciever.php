<?php

namespace OkojoBot\MessageReciever;

use LINE\LINEBot;
use LINE\LINEBot\Event\BaseEvent;

abstract class BaseReciever
{
    /** @var LINEBot $bot Botインスタンス */
    protected $bot;

    /** @var BaseEvent $event 受信イベント */
    protected $event;

    /**
     * レシーバのコンストラクタ
     *
     * @param LINEBot $bot LINEBotのインスタンス
     * @param BaseEvent $event 受信したイベント
     */
    function __construct(LINEBot $bot, BaseEvent $event)
    {
        $this->bot = $bot;
        $this->event = $event;
    }

    abstract public function do(): void;
}
