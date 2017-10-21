<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Admireortread extends Model
{
    //设置表名
    protected $table = 'admireortread';
    protected $fillable = ['postid','uid','status'];
    public $timestamps = false;
}
