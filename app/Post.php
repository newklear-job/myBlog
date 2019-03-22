<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable  = [
        'title', 'body', 'photo', 'user_id'
    ];
}
