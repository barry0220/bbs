<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Scorelog extends Model
{
    //设置表名
    protected $table = 'scorelog';
    protected $fillable = ['uid','time','handle','scorelog'];
    public $timestamps = false;
}
