<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //Postsテーブルとのリレーション（主テーブル側）
    public function posts() {
      return $this->hasMany('App\Post');
    }

    //Postsテーブルとの多対多リレーション
    public function favo_posts() {
      return $this->belongsToMany('App\Post');
    }

    //imagesテーブルとの1対多nリレーション(主テーブル)
    public function images() {
      return $this->hasMany('App\Image');
    }

    //

}
