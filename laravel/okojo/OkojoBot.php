<?php

namespace OkojoBot;

use LINE\LINEBot\Event\BaseEvent;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use OkojoBot\MessageReciever\BaseReciever;
use OkojoBot\MessageReciever\TextMessageReciever;
use Phine\Client;

interface IOkojoBot
{
    /**
     * 各イベントタイプごとにレシーバを設定する。
     *
     * @param Client $bot Botインスタンス
     * @param BaseEvent $event イベントオブジェクト
     *
     * @return void
     */
    function setReciever(Client $bot, BaseEvent $event): void;

    /**
     * レシーバを実行する。
     *
     * @return void
     */
    function do(): void;
}

class OkojoBot implements IOkojoBot
{
    /** @var BaseReciever $reciever レシーバ */
    private $reciever;

    /**
     * Clientの処理をする。
     *
     * @param Client $bot Botインスタンス
     * @param BaseEvent $event イベントオブジェクト
     */
    function __construct(Client $bot, BaseEvent $event)
    {
        // レシーバの設定
        $this->setReciever($bot, $event);
    }

    function setReciever(Client $bot, BaseEvent $event): void
    {
        // リプライトークンをセットする。
        $bot->setReplyToken($event->getReplyToken());

        // メッセージイベント
        if ($event instanceof MessageEvent) {
            // テキストメッセージ
            if ($event instanceof TextMessage) {
                // テキストメッセージレシーバをセットする。
                $this->reciever = new TextMessageReciever($bot, $event);
            }
        }
    }

    function do(): void
    {
        $this->reciever->do();
    }
}
