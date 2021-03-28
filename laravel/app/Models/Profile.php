<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use OkojoBot\Common\Func;

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
     * プレイヤー名からユーザーIDを取得する関数
     *
     * @param string $playerName プレイヤー名
     *
     * @return string|null ユーザーID
     */
    public static function getUidByPlayerName(string $playerName): ?string
    {
        $profile = self::where('player_name', $playerName)->first();
        if (is_null($profile)) {
            return null;
        }
        return $profile->uid;
    }

    /**
     * プレイヤーIDからユーザーIDを取得する関数
     *
     * @param string $playerID プレイヤーID
     *
     * @return string|null ユーザーID
     */
    public static function getUidByPlayerID(string $playerID): ?string
    {
        $profile = self::where('player_id', $playerID)->first();
        if (is_null($profile)) {
            return null;
        }
        return $profile->uid;
    }

    /**
     * 招待コードからユーザーIDを取得する関数
     *
     * @param string $inviteCode 招待コード
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

    /**
     * LINE名からユーザーIDを取得する関数
     *
     * @param string $displayName LINE名
     *
     * @return string|null ユーザーID
     */
    public static function getUidByDisplayName(string $displayName): ?string
    {
        $name = Func::base64_urlsafe_encode($displayName);
        $profile = self::where('display_name', $name)->first();
        if (is_null($profile)) {
            return null;
        }
        return $profile->uid;
    }

    /**
     * プレイヤー名が存在しているか判定する関数
     *
     * @param string $playerName
     *
     * @return bool 存在しているか否か
     */
    public static function isExistPlayerName(string $playerName): bool
    {
        $profile = Profile::where('player_name', $playerName)->first();
        if (is_null($profile)) {
            return false;
        } else {
            return true;
        }
    }

    /**
     * プレイヤーIDが存在しているか判定する関数
     *
     * @param string $playerID
     *
     * @return bool 存在しているか否か
     */
    public static function isExistPlayerID(string $playerID): bool
    {
        $profile = Profile::where('player_id', $playerID)->first();
        if (is_null($profile)) {
            return false;
        } else {
            return true;
        }
    }

}
