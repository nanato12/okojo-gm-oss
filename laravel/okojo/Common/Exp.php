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

namespace OkojoBot\Common;

/**
 * 経験値に関するクラス
 */
class Exp
{
    /**
     * @var int 招待で取得できる経験値
     */
    const INVITATION_BONUS = 200;

    /**
     * @var int 寄付した時に取得できる経験値
     */
    const DONATION_BONUS = 1000;

    /**
     * トークで獲得できるランダム経験値
     *
     * @param int $adjustPercent 補正値（%）
     *
     * @return int 経験値
     */
    public static function up(int $adjustPercent = 100): int
    {
        /** @var int $randomPercent ランダム% */
        $randomPercent = rand(1, 100);

        // 5% 60-80
        if ($randomPercent <= 5) {
            $value = rand(60, 80);
        }
        // 10% 50-60
        elseif ($randomPercent <= 15) {
            $value = rand(50, 60);
        }
        // 45% 40-50
        elseif ($randomPercent <= 60) {
            $value = rand(40, 50);
        }
        // 40% 30-40
        else {
            $value = rand(30, 40);
        }

        // 補正値計算した値を返す。
        return Func::calcPercent($value, $adjustPercent);
    }

    /**
     * 必要経験値を取得する関数
     *
     * @param int $level レベル
     *
     * @return int 必要経験値
     */
    public static function getNeedExpByLevel(int $level): int
    {
        if ($level < 5) {
            $needExp = 100;
        } elseif ($level < 10) {
            $needExp = 200;
        } elseif ($level < 20) {
            $needExp = 300;
        } elseif ($level < 30) {
            $needExp = 400;
        } elseif ($level < 40) {
            $needExp = 500;
        } elseif ($level < 50) {
            $needExp = 600;
        } elseif ($level < 100) {
            $needExp = (int)floor(0.25 * $level ** 2);
        } elseif ($level < 500) {
            $needExp = (int)floor(0.3 * $level ** 2);
        } elseif ($level < 600) {
            $needExp = (int)floor(0.35 * $level ** 2);
        } else {
            $needExp = (int)floor(0.4 * $level ** 2);
        }
        return $needExp;
    }
}
