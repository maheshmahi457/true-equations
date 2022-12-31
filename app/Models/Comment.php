<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Comment extends Authenticatable
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'id',
        'user_id',
        'post_id',
        'comments',
    ];


}
