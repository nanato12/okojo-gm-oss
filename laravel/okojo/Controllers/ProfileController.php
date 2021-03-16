<?php

namespace OkojoBot\Controllers;

use App\Models\Profile;
use App\Models\RPG;

interface IProfileController
{
    /**
     * 新規登録する関数
     */
    function register(): void;

    /**
     * 新規登録済か判定する関数
     *
     * @return bool
     */
    function isRegistered(): bool;
}

/**
 * ユーザープロフィールを管理するコントローラ
 *
 * @property string $uid ユーザーID
 * @property Profile $profile Profileモデル
 */
class ProfileController implements IProfileController
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

    function register(): void
    {
        $this->profile->is_registered = true;
        $this->profile->save();
    }

    function isRegistered(): bool
    {
        return $this->profile->is_registered;
    }
}
