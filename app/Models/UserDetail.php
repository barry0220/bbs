<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserDetail extends Model
{
    //设置表名
    protected $table = 'user_detail';
    public $timestamps = false;

    public function user()
    {
        return $this->belongsTo('App\Models\UserHome','uid','id');
    }
}
