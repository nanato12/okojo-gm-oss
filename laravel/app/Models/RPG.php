<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RPG extends Model
{
    use HasFactory;

    protected $table = 'rpg';
    protected $primaryKey = 'id';

    function profile()
    {
        return $this->belongsTo(Profile::class, 'uid', 'uid');
    }
}
