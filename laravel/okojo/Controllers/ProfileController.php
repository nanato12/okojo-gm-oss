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

namespace OkojoBot\Controllers;

use App\Models\Profile;
use App\Models\RPG;
use OkojoBot\Common\Exp;
use OkojoBot\Common\Func;
use OkojoBot\Common\Point;
use OkojoBot\Config;
use Phine\Structs\Profile as StructsProfile;

/**
 * ユーザープロフィールを管理するコントローラ
 *
 * @property string $uid ユーザーID
 * @property Profile $profile Profileモデル
 */
class ProfileController
{
    /**
     * @var string $uid ユーザーID
     */
    public $uid;

    /**
     * @var Profile $profile Profileモデル
     */
    public $profile;

    function __construct(string $uid)
    {
        $this->uid = $uid;

        /**
         * @var null|Profile　$profile Profileモデル
         */
        $profile = Profile::where('uid', $uid)->first();
        if (is_null($profile)) {
            $profile = new Profile;
            $profile->uid = $this->uid;
            $profile->save();
            $profile->rpg()->save(
                new RPG()
            );
        }
        $this->profile = $profile;
    }

    /**
     * 新規登録する関数
     *
     * @return void
     */
    function register(): void
    {
        $this->profile->is_registered = true;
        $this->profile->save();
    }

    /**
     * 新規登録済か判定する関数
     *
     * @return bool 新規登録済か否か
     */
    function isRegistered(): bool
    {
        return $this->profile->is_registered;
    }

    /**
     * LINE表示名を取得する関数
     *
     * @return string|null LINE表示名
     */
    function getDisplyName(): ?string
    {
        $displayName = $this->profile->display_name;
        if (is_null($displayName)) {
            return null;
        }
        return Func::base64_urlsafe_decode($displayName);
    }

    /**
     * プレイヤー名を取得する関数
     *
     * @return string|null プレイヤー名
     */
    function getPlayerName(): ?string
    {
        return $this->profile->rpg->player_name;
    }

    /**
     * プレイヤーを設定する関数
     *
     * @param string $playerName プレイヤー名
     *
     * @return void
     */
    function setPlayerName(string $playerName): void
    {
        $this->profile->rpg->player_name = $playerName;
        $this->profile->rpg->save();
    }

    /**
     * プレイヤーIDを取得する関数
     *
     * @return string|null プレイヤーID
     */
    function getPlayerID(): ?string
    {
        return $this->profile->rpg->player_id;
    }

    /**
     * プレイヤーを設定する関数
     *
     * @param string $playerID プレイヤーID
     *
     * @return void
     */
    function setPlayerID(string $playerID): void
    {
        $this->profile->rpg->player_id = $playerID;
        $this->profile->rpg->save();
    }

    /**
     * 個体値を取得する関数
     *
     * @return int 個体値
     */
    function getIndividual(): int
    {
        return $this->profile->rpg->individual;
    }

    /**
     * 個体値を設定する関数
     *
     * @param int $individual 個体値
     *
     * @return void
     */
    function setIndividual(int $individual): void
    {
        $this->profile->rpg->individual = $individual;
        $this->profile->rpg->save();
    }

    /**
     * レベルを取得する関数
     *
     * @return int レベル
     */
    function getLevel(): int
    {
        return $this->profile->rpg->level;
    }

    /**
     * ポイントを取得する関数
     *
     * @return int 所持ポイント
     */
    function getPoint(): int
    {
        return $this->profile->rpg->point;
    }

    /**
     * ポイントを付与する関数
     *
     * @param int|null $point 付与ポイント
     *
     * @return void
     */
    function givePoint(?int $point = null): void
    {
        if (is_null($point)) {
            $interval = time() - $this->profile->rpg->point_update;
            if ($interval < Config::INTERVAL_LOWEST) {
                return;
            } elseif ($interval < Config::INTERVAL_POINT) {
                $point = 0;
            } else {
                $point = Point::up();
            }
        }
        $this->profile->rpg->point += $point;
        $this->profile->rpg->point_update = time();
        $this->profile->rpg->save();
    }

    /**
     * 経験値を取得する関数
     *
     * @return int 所持経験値
     */
    function getExp(): int
    {
        return $this->profile->rpg->exp;
    }

    /**
     * 経験値を付与する関数
     *
     * @param int|null $exp 付与経験値
     *
     * @return bool レベルアップしたか否か
     */
    function giveExp(?int $exp = null): bool
    {
        // 経験値指定がなければ、トークでの経験値加算
        if (is_null($exp)) {
            // 最終経験値取得時間を取得する。
            $interval = time() - $this->profile->rpg->exp_update;

            // 最低限インターバル判定
            if ($interval < Config::INTERVAL_LOWEST) {
                return false;
            }
            // 経験値インターバル判定
            elseif ($interval < Config::INTERVAL_EXP) {
                $exp = 0;
            }
            // トークでの経験値取得
            else {
                $exp = Exp::up();
            }
        }

        /** @var int ユーザー経験値 */
        $userExp = $this->profile->rpg->exp + $exp;
        /** @var int ユーザーレベル */
        $userLevel = $this->profile->rpg->level;

        /** @var bool レベルアップ判定 */
        $result = false;

        while (Exp::getNeedExpByLevel($userLevel) <= $userExp) {
            $userExp -= Exp::getNeedExpByLevel($userLevel);
            $userLevel++;
            $result = true;
        }

        // 経験値加算、最終経験値取得時間を更新する。
        $this->profile->rpg->level = $userLevel;
        $this->profile->rpg->exp = $userExp;
        $this->profile->rpg->exp_update = time();
        $this->profile->rpg->save();

        return $result;
    }

    /**
     * コインを取得する関数
     *
     * @return int 所持コイン
     */
    function getCoin(): int
    {
        return $this->profile->rpg->coin;
    }

    /**
     * コインを付与する関数
     *
     * @param int コイン枚数
     *
     * @return void
     */
    function giveCoin(int $coin): void
    {
        $this->profile->rpg->coin += $coin;
        $this->profile->rpg->save();
    }

    /**
     * 寄付額を取得する関数
     *
     * @return int 所持寄付額
     */
    function getDonation(): int
    {
        return $this->profile->donation;
    }

    /**
     * 寄付額を付与する関数
     *
     * @param int $price
     *
     * @return void
     */
    function giveDonation(int $price): void
    {
        $this->profile->donation += $price;
        $this->profile->save();
    }

    /**
     * アイテム所持上限数を取得する関数
     *
     * @return int
     */
    function getItemLimitCount(): int
    {
        return Func::getItemLimitCountByLevel($this->getLevel());
    }

    /**
     * 招待コードを取得する関数
     *
     * @return string 招待コード
     */
    function getInviteCode(): string
    {
        // 招待コードが設定されていなければ、発行
        if (is_null($this->profile->invite_code)) {
            // uniqidを36進数変換して大文字変換
            $this->profile->invite_code = strtoupper(base_convert(uniqid(), 16, 36));
            $this->profile->save();
        }
        return $this->profile->invite_code;
    }

    /**
     * 招待コードを使用する関数
     *
     * @param string $inviteCode 招待コード
     *
     * @return bool 使用できたか否か
     */
    function useInviteCode(string $inviteCode): bool
    {
        // NULLであれば使用可能
        if (is_null($this->profile->used_invite_code)) {
            // 使用済みに設定
            $this->profile->used_invite_code = $inviteCode;
            $this->profile->save();

            // 招待ボーナスを付与する。
            $this->givePoint(Point::INVITATION_BONUS);
            $this->giveExp(Exp::INVITATION_BONUS);
            return true;
        }
        return false;
    }

    /**
     * プロフィール情報を保存する関数
     *
     * @param StructsProfile|null $profile プロフィールオブジェクト
     *
     * @return void
     */
    function saveProfile(?StructsProfile $profile): void
    {
        if (is_null($profile)) {
            return;
        }
        $this->profile->display_name = Func::base64_urlsafe_encode($profile->displayName);
        $this->profile->picture_url = $profile->pictureUrl;
        $this->profile->status_message = $profile->statusMessage;
        $this->profile->lang = $profile->language;
        $this->profile->save();
    }
}
