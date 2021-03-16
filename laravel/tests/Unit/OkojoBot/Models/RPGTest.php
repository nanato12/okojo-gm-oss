<?php

namespace Tests\Unit\OkojoBot\Models;

use App\Models\RPG;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class RPGTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * PRGモデルのインスタンステスト
     *
     * @return void
     */
    public function testInit()
    {
        $rpg = new RPG;
        $rpg->uid = "test_init_rpg_uid";
        $rpg->save();

        $this->assertEquals(
            "test_init_rpg_uid",
            $rpg->uid,
            "登録したUIDであること。"
        );
        $this->assertEquals(
            null,
            $rpg->player_name,
            "player_name の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->player_id,
            "player_id の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->level,
            "level の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->exp,
            "exp の初期値は NULL であること"
        );
        $this->assertEquals(
            20000,
            $rpg->point,
            "point の初期値は 20000 であること"
        );
        $this->assertEquals(
            1,
            $rpg->individual,
            "individual の初期値は 0 であること"
        );
        $this->assertEquals(
            null,
            $rpg->type,
            "type の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->item,
            "item の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->party,
            "party の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->party_request,
            "party_request の初期値は NULL であること"
        );
        $this->assertEquals(
            0,
            $rpg->point_update,
            "point_update の初期値は 0 であること"
        );
        $this->assertEquals(
            0,
            $rpg->exp_update,
            "exp_update の初期値は 0 であること"
        );
        $this->assertEquals(
            7,
            $rpg->item_limit_count,
            "item_limit_count の初期値は 7 であること"
        );
        $this->assertEquals(
            0,
            $rpg->coin,
            "coin の初期値は 0 であること"
        );
        $this->assertEquals(
            null,
            $rpg->last_login,
            "last_login の初期値は NULL であること"
        );
        $this->assertEquals(
            0,
            $rpg->total_login_count,
            "total_login_count の初期値は 0 であること"
        );
        $this->assertEquals(
            0,
            $rpg->continuous_login_count,
            "continuous_login_count の初期値は 0 であること"
        );
        $this->assertEquals(
            null,
            $rpg->same_skill_1,
            "same_skill_1 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->same_skill_2,
            "same_skill_2 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->same_skill_3,
            "same_skill_3 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->same_skill_4,
            "same_skill_4 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->free_skill_1,
            "free_skill_1 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->free_skill_2,
            "free_skill_2 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->free_skill_3,
            "free_skill_3 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->free_skill_4,
            "free_skill_4 の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->limit_exp_boost,
            "limit_exp_boost の初期値は NULL であること"
        );
        $this->assertEquals(
            null,
            $rpg->limit_point_boost,
            "limit_point_boost の初期値は NULL であること"
        );
        $this->assertEquals(
            1,
            $rpg->bp_level,
            "bp_level の初期値は 1 であること"
        );
        $this->assertEquals(
            0,
            $rpg->bp_point,
            "bp_point の初期値は 0 であること"
        );
        $this->assertEquals(
            "normal",
            $rpg->bp_type,
            "bp_type の初期値は 'normal' であること"
        );
        $this->assertEquals(
            3000,
            $rpg->rate,
            "rate の初期値は 3000 であること"
        );
    }
}
