<?php

namespace App;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'body',
        'slug'
    ];
    public function user(){
        return $this->hasMany('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function tags(){
        return $this->belongsToMany('App\Tag');
    }
    
}
