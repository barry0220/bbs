<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Plates extends Model
{
    //设置表名
    protected $table = 'plates';

    //允许批量操作的字段
//    protected $fillable = ['pname', 'imgfile','isvip'];
    //不允许批量操作的字段
//    protected $guarded = [];
    public $timestamps = false;

    public function childPlates()
    {
        return $this->hasOne('App\Models\ChildPlates','pid');
    }

//$comments = App\Post::find(1)->comments()->where('title', 'foo')->first();
    //获取所有板块与子类 并且重写格式 专为分类选择使用
    public function treeName()
    {
        $pls = $this -> get();
        $cpls = ChildPlates::get();

        $npls = array();

        foreach ($pls as $k => $v){
            $npls[] = $v->pname;
            foreach ($cpls as $m => $n){
                if ($n->pid == $v -> id) {
                    $npls[] = '　|--'.$n->cname;
                }
            }
        }
        return $npls;
    }
}
