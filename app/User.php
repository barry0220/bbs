<?php

namespace App;

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

class User extends Model implements AuthenticatableContract,
                                    AuthorizableContract,
                                    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;

    //模型关联的表
    protected $table = 'admins';
    //表的主键
    public $primaryKey = 'id';
    //允许批量操作的字段
    protected $fillable = ['username', 'password'];
    //不允许批量操作的字段
//    protected $guarded = [];
    //是否维护时间字段
    public $timestamps = false;
}
