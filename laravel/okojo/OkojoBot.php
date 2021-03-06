<?php

/**
 *     okojo-gm-oss - linebot okojoGM Open Source
 *     Copyright (C) 2021  nanato12 <admin@nanato12.info>
 *
 *     This program is free software: you can redistribute it and/or modify
 *     it under the terms of the GNU General Public License as published by
 *     the Free Software Foundation, either version 3 of the License, or
 *     (at your option) any later version.
 *
 *     This program is distributed in the hope that it will be useful,
 *     but WITHOUT ANY WARRANTY; without even the implied warranty of
 *     MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *     GNU General Public License for more details.
 *
 *     You should have received a copy of the GNU General Public License
 *     along with this program.  If not, see <https://www.gnu.org/licenses/>.
 *
 * Also add information on how to contact you by electronic and paper mail.
 *
 *   If the program does terminal interaction, make it output a short
 * notice like this when it starts in an interactive mode:
 *
 *     okojo-gm-oss  Copyright (C) 2021  nanato12 <admin@nanato12.info>
 *     This program comes with ABSOLUTELY NO WARRANTY; for details type `show w'.
 *     This is free software, and you are welcome to redistribute it
 *     under certain conditions; type `show c' for details.
 *
 * The hypothetical commands `show w' and `show c' should show the appropriate
 * parts of the General Public License.  Of course, your program's commands
 * might be different; for a GUI interface, you would use an "about box".
 *
 *   You should also get your employer (if you work as a programmer) or school,
 * if any, to sign a "copyright disclaimer" for the program, if necessary.
 * For more information on this, and how to apply and follow the GNU GPL, see
 * <https://www.gnu.org/licenses/>.
 *
 *   The GNU General Public License does not permit incorporating your program
 * into proprietary programs.  If your program is a subroutine library, you
 * may consider it more useful to permit linking proprietary applications with
 * the library.  If this is what you want to do, use the GNU Lesser General
 * Public License instead of this License.  But first, please read
 * <https://www.gnu.org/licenses/why-not-lgpl.html>.
 */

namespace OkojoBot;

use LINE\LINEBot\Event\BaseEvent;
use LINE\LINEBot\Event\MessageEvent;
use LINE\LINEBot\Event\MessageEvent\TextMessage;
use OkojoBot\MessageReciever\BaseReciever;
use OkojoBot\MessageReciever\TextMessageReciever;
use Phine\Client;

/**
 * OkojoBot クラスのインターフェース
 */
interface IOkojoBot
{
    /**
     * 各イベントタイプごとにレシーバを設定する。
     *
     * @param Client    $bot   Botインスタンス
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

/**
 * OkojoBot の処理
 */
class OkojoBot implements IOkojoBot
{
    /**
     * @var BaseReciever $reciever レシーバ
     */
    private $reciever;

    /**
     * Clientの処理をする。
     *
     * @param Client    $bot   Botインスタンス
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
