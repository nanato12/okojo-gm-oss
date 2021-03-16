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
}
