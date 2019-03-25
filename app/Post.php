<?php

namespace App;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'title', 'body', 'photo', 'user_id'
    ];

    public function getBodyExcerptAttribute()
    {
        return Str::words($this->body, '25');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }


}
