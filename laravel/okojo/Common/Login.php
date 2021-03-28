<?php

namespace OkojoBot\Common;

use Carbon\Carbon;
use OkojoBot\Objects\Bonus;

class Login
{
    /**
     * ログインボーナスを取得する関数
     *
     * @param int $continuousLoginCount
     * @param int $totalLoginCount
     * @param Carbon|null $lastLogin
     *
     * @return Bonus ログインボーナス
     */
    public static function getBounus(
        int $continuousLoginCount,
        int $totalLoginCount,
        ?Carbon $lastLogin
    ): Bonus {
        /** @var Bonus $bonus ログインボーナス */
        $bonus = new Bonus;

        /**
         * 通常ログインボーナス
         */
        // 50日未満
        if ($continuousLoginCount < 50) {
            // ログイン日数に応じてのポイントボーナス
            $dailyPoint = (1 + floor($continuousLoginCount / 10)) * 500;
        }
        // 100日単位
        elseif ($continuousLoginCount % 100 == 0) {
            $dailyPoint = 50000;
        }
        // それ以外
        else {
            // 50日以上であれば、一律3,000ポイント
            $dailyPoint = 3000;
        }

        /** @var int $dailyExp 経験値 */
        $dailyExp = $dailyPoint / 2;

        // ボーナスポイント・経験値加算
        $bonus->description[] = number_format($dailyPoint) . "pt ログイン日数ボーナス";
        $bonus->description[] = number_format($dailyExp) . "exp ログイン日数ボーナス";
        $bonus->point += $dailyPoint;
        $bonus->exp += $dailyExp;

        if (self::isTenThousandAnniversary($lastLogin)) {
            $point = 100000;
            $bonus->point += $point;
            $bonus->description[] = number_format($point) . "pt 1万人記念ボーナス";
        }

        return $bonus;
    }

    /**
     * 1万人記念中かどうか判定する。
     * (2021/03/27 00:00:00 ~ 2021/04/29 23:59:59)
     *
     * @param Carbon|null $lastLogin 最終ログイン日時
     *
     * @return bool
     */
    public static function isTenThousandAnniversary(?Carbon $lastLogin): bool
    {
        /**
         * @var Carbon $today 現在時刻
         */
        $today = Carbon::now();

        /**
         * @var Carbon $startDate 開始時刻
         */
        $startDate = new Carbon("2021-03-27 00:00:00");

        /**
         * @var Carbon $endDate 終了時刻
         */
        $endDate = new Carbon("2021-04-09 23:59:59");

        // 2021/03/27 00:00:00 ~ 2021/04/29 23:59:59 でログイン確認
        if ($today->between($startDate, $endDate)) {
            // ログインしたことがなければ true
            if (is_null($lastLogin)) {
                return true;
            }
            // ログインしたことがあれば
            else {
                // 開始時刻より以前にログインしていれば true
                return $lastLogin->lt($startDate);
            }
        }
        return false;
    }
}
