<?php

namespace Tests\Unit\OkojoBot\Models;

use App\Models\Profile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class ProfileTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * Profileモデルのインスタンステスト
     *
     * @return void
     */
    public function testInit()
    {
        $profile = new Profile();
        $profile->uid = "test_init_profile_uid";
        $profile->save();

        $this->assertEquals(
            "test_init_profile_uid",
            $profile->uid,
            "登録したUIDであること。"
        );
        $this->assertEquals(
            null,
            $profile->display_name,
            "display_name の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->picture_url,
            "picture_url の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->status_message,
            "status_message の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->lang,
            "lang の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->last_word,
            "last_word の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->regulation_words,
            "regulation_words の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->invite_code,
            "invite_code の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->used_invite_code,
            "used_invite_code の初期値は NULL であること。"
        );
        $this->assertEquals(
            null,
            $profile->regulation_timestamp,
            "regulation_timestamp の初期値は NULL であること。"
        );
        $this->assertEquals(
            false,
            $profile->is_registered,
            "is_registered の初期値は false であること。"
        );
        $this->assertEquals(
            0,
            $profile->donation,
            "donation の初期値は 0 であること。"
        );
    }
}
