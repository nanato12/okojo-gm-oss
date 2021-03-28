<?php

namespace OkojoBot\Objects;

/**
 * 主にログインボーナスで使用されるクラス
 *
 * @property int $point ポイント
 * @property int $exp   経験値
 * @property string[] $description   ログインボーナス説明
 */
class Bonus
{
    public $point = 0;
    public $exp = 0;
    public $description = [];
}
