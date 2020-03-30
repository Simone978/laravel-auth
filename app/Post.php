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
    
}
