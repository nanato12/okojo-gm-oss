<?php

namespace OkojoBot\MessageReciever;

use LINE\LINEBot\Event\BaseEvent;
use Phine\Client;

abstract class BaseReciever
{
    /** @var Client $bot Botインスタンス */
    protected $bot;

    /** @var BaseEvent $event 受信イベント */
    protected $event;

    /**
     * レシーバのコンストラクタ
     *
     * @param Client $bot LINEBotのインスタンス
     * @param BaseEvent $event 受信したイベント
     */
    function __construct(Client $bot, BaseEvent $event)
    {
        $this->bot = $bot;
        $this->event = $event;
    }

    abstract public function do(): void;
}
