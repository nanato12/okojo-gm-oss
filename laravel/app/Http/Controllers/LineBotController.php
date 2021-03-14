<?php

namespace App\Http\Controllers;

use LINE\LINEBot;
use Illuminate\Http\Request;
use LINE\LINEBot\Constant\HTTPHeader;
use LINE\LINEBot\Exception\InvalidEventRequestException;
use LINE\LINEBot\Exception\InvalidSignatureException;
use OkojoBot\OkojoBot;

class LineBotController extends Controller
{
    /**
     * LINEBot webhook
     *
     * @param Request $request HTTPリクエスト
     *
     * @return Response レスポンス
     */
    public function callback(Request $request)
    {
        /** @var LINEBot $bot */
        $bot = app('line-bot');

        // LINEのシグネチャ確認
        if (isset($_SERVER['HTTP_' . HTTPHeader::LINE_SIGNATURE])) {
            $signature = $_SERVER['HTTP_' . HTTPHeader::LINE_SIGNATURE];
            if (empty($signature)) {
                return Response('Bad Request', 400);
            }
        } else {
            return Response('Bad Request', 400);
        }

        // イベントパース
        try {
            $events = $bot->parseEventRequest($request->getContent(), $signature);
        } catch (InvalidSignatureException $e) {
            return Response('Invalid signature', 400);
        } catch (InvalidEventRequestException $e) {
            return Response('Invalid event request', 400);
        }

        // イベント処理
        foreach ($events as $event) {
            if (env("APP_ENV") === "local") {
                error_log($request->getContent());
            }
            $okojoBot = new OkojoBot($bot, $event);
            $okojoBot->do();
        }

        return Response('OK', 200);
    }
}
