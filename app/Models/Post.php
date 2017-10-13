<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    //设置表名
    protected $table = 'post';
    public $timestamps = false;


    public function user()
    {
        return $this->belongsTo('App\Models\UserHome','id','uid');
    }
}


