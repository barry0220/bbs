<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserHome extends Model
{

    //设置表名
    protected $table = 'user';
    public $timestamps = false;


    public function posts()
    {
        return $this->hasOne('App\Models\Post','uid','id');
    }

    public function details()
    {
        return $this -> hasOne('App\Models\UserDetail','uid','id');
    }

}
