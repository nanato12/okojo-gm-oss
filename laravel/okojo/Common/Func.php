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
 * その他関数に関するクラス
 */
class Func
{
    /**
     * URLセーフなbase64エンコード
     *
     * @param string $value 対象文字列
     *
     * @return string 変換後文字列
     */
    public static function base64_urlsafe_encode(string $value): string
    {
        $value = base64_encode($value);
        return str_replace(array('+', '/', '='), array('_', '-', '.'), $value);
    }

    /**
     * URLセーフなbase64デコード
     *
     * @param string $value 対象文字列
     *
     * @return string 変換後文字列
     */
    public static function base64_urlsafe_decode(string $value): string
    {
        $value = str_replace(array('_', '-', '.'), array('+', '/', '='), $value);
        return base64_decode($value);
    }

    /**
     * %計算をする関数
     *
     * @param int $value 値
     * @param int $percent %
     *
     * @return int
     */
    public static function calcPercent(int $value, int $percent): int
    {
        return ceil($value * $percent / 100);
    }

    /**
     * アイテム所持上限数を取得する関数
     *
     * @param int $level
     *
     * @return int 所持上限数
     */
    public static function getItemLimitCountByLevel(int $level): int
    {
        $count = 10 + floor($level / 10);
        if ($count > 35) {
            $count = 35;
        }
        return $count;
    }
}
