<?php

namespace Tests\Unit\OkojoBot\Controllers;

use App\Models\Profile;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use OkojoBot\Controllers\ProfileController;
use Tests\TestCase;

class ProfileControllerTest extends TestCase
{
    use DatabaseTransactions;

    /**
     * インスタンステスト
     *
     * @return void
     */
    public function testInit()
    {
        $profileController = new ProfileController("test_is_registered");
        $this->assertEquals(
            "test_is_registered",
            $profileController->uid,
            "引数のuidとprofileControllerのuidが一致すること。",
        );
    }

    public function testIsRegistered()
    {
        $profileController = new ProfileController("test_is_registered");
        $this->assertEquals(
            false,
            $profileController->isRegistered(),
            "初期であれば、isRegistered は false になること。"
        );
    }
}
