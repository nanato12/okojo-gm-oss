<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Profile extends Model
{
    use HasFactory;

    protected $table = 'profile';
    protected $primaryKey = 'id';

    protected $attributes = [
        'is_registered' => false,
    ];

    function rpg()
    {
        return $this->hasOne(RPG::class, 'uid', 'uid');
    }

    /**
     * 招待コードからユーザーIDを取得する関数
     *
     * @return string|null ユーザーID
     */
    public static function getUidByInviteCode(string $inviteCode): ?string
    {
        $profile = self::where('invite_code', $inviteCode)->first();
        if (is_null($profile)) {
            return null;
        }
        return $profile->uid;
    }
}
