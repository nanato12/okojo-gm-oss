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

namespace OkojoBot\Utils;

use OkojoBot\Exception\InvalidFlexJsonFileException;

class Flex
{
    /**
     * flex.json から該当するキーのFlex配列を返す関数
     *
     * @param string $key キー
     *
     * @return array Flex配列
     */
    private static function getContentByKey(string $key): array
    {
        // flex.jsonの存在確認
        $jsonFilePath = __DIR__ . "/flex.json";
        if (!file_exists($jsonFilePath)) {
            throw new InvalidFlexJsonFileException("No such file or directory: ${jsonFilePath}");
        }

        // ファイル読み込み
        $flexItems = file_get_contents(__DIR__ . "/flex.json");

        // jsonパース
        $jsonContent = json_decode($flexItems, true);
        if (is_null($jsonContent)) {
            throw new InvalidFlexJsonFileException("Invalid json.");
        } elseif (empty($jsonContent)) {
            throw new InvalidFlexJsonFileException("Json file is empty.");
        } elseif (!array_key_exists($key, $jsonContent)) {
            throw new InvalidFlexJsonFileException("Not found key: ${key}");
        }

        return $jsonContent[$key];
    }

    /**
     * Flex配列にフッターを付与する関数
     *
     * @param array Flex配列
     *
     * @return array Flex配列
     */
    private static function addFooter(array $flexContent): array
    {
        $footer = self::getContentByKey("footer");
        for ($i = 0; $i < count($flexContent["contents"]); $i++) {
            $flexContent["contents"][$i]["footer"] = $footer;
        }
        return $flexContent;
    }

    /**
     * 新規登録ボタンFlexを返す関数
     *
     * @return array Flex配列
     */
    public static function getNoRegister(): array
    {
        return self::addFooter(self::getContentByKey("no_register"));
    }
}
