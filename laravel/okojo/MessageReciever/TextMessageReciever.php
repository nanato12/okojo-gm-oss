<?php

namespace OkojoBot\MessageReciever;

use LINE\LINEBot;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use OkojoBot\MessageReciever\BaseReciever;

class TextMessageReciever extends BaseReciever
{
    /** @var LINEBot $bot Botインスタンス */
    protected $bot;

    /** @var TextMessage $event テキストメッセージイベント */
    protected $event;

    /**
     * 受信したテキストによって処理を分ける。
     */
    function do(): void
    {
        /** @var string $text 受信テキスト */
        $text = $this->event->getText();

        switch ($text) {
            default:
                $this->bot->replyText($this->event->getReplyToken(), $text);
        }
    }
}
