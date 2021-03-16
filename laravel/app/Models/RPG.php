<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPG extends Model
{
    use HasFactory;

    protected $table = 'rpg';
    protected $primaryKey = 'id';

    protected $attributes = [
        'point' => 20000,
        'individual' => 1,
        'item_limit_count' => 7,
        'bp_level' => 1,
        'bp_type' => 'normal',
        'rate' => 3000,
    ];

    function profile()
    {
        return $this->belongsTo(Profile::class, 'uid', 'uid');
    }
}
