<?php

namespace OkojoBot\Controllers;

use App\Models\Profile;
use App\Models\RPG;

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
}
