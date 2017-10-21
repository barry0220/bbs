<?php

namespace App\Http\Controllers\Home;

use App\Models\Adspace;
use App\Models\Links;
use App\Models\Plates;
use App\Models\Post;
use App\Models\Runimg;
use App\Models\Tags;
use App\Models\UserDetail;
use App\Models\UserHome;
use App\User;
use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //一级板块
        $plates = Plates::limit(6)->get();
        $platess = Plates::get();
        //标签名
        $tag = Tags::get();
        $tagname = [];
        foreach ($tag as $k => $v) {
            $tagname[$v->id] = $v->tagname;

        }

        //活动帖子
        $huodong = Post::whereIn('postcode', ['1','2'])->orderBy('posttime', 'desc')->limit(5)->get();

        //普通帖子
        $post = Post::where('postcode', '0')->orderBy('clickcount')->get();
//        dd($post);
        //重新定义数组格式便于前台遍历
        $arr = [];
        foreach ($post as $k => $v) {
            foreach ($plates as $m => $n) {
                if ($v->pid == $n->id) {
                    if (array_key_exists($n->pname, $arr)) {
                        if (count($arr[$n->pname]) >= 12) {
                            continue;
                        }
                    }
                    $arr[$n->pname][] = $v;
                }
            }
        }

        // dd($tagpost);
//        dd($arr);
        $maxtwo = \DB::table('post')
            ->leftjoin('plates','plates.id','=','post.pid')
            ->select('post.*','plates.pname')
            ->orderBy('post.clickcount', 'desc')
            ->limit(2)
            ->get();
        //影像板块
        $plate = Plates::orderBy('id')->limit(4)->get();


        //用户表信息
        $userinfo = UserHome::get();

        $username = [];
        foreach ($userinfo as $k => $v) {
            $username[$v->id] = $v->username;

        }
        $userdetail = UserDetail::get();
        $userface = [];
        foreach ($userdetail as $k => $v) {
            $userface[$v->uid] = $v->profile;

        }
        // dd($userface);
//      dd($username);
        //作者推荐
        $auther = Post::orderBy('clickcount', 'desc')->groupBy('uid')->limit(10)->get();

        //轮播图
        $runimg = Runimg::where('expiretime', '>', time())->orderby('expiretime', 'desc')->limit(3)->get();

        //友情链接
        $link = Links::get();

        //广告位
        $adspace = Adspace::get();

 //        $posts1 = Post::orderBy('clickcount','desc')->limit(2)->get();
//        $posts2 = Post::orderBy('postcode','desc')->limit(5)->get();
//        $posts3 = Post::where('tagid','1')->get();
//        $posts4 = Post::where('tagid','2')->get();
//        $posts5 = Post::orderBy('clickcount','desc')->limit(10)->get();
//        $posts6 = Post::orderBy('admire','desc')->limit(10)->get();
//        $posts7 = Post::where('pid','1')->orderBy('pid','desc')->limit(10)->get();
//        $posts8 = Post::where('cid','2')->orderBy('pid','desc')->limit(10)->get();

//        $post = Post::get();
//        $post = Post::get();

//        return view('home/index',compact('plates','runimg','post','posts1','posts2','posts3','posts4','posts5','posts6','posts7','posts8'));
        return view('home/index', compact('plates', 'platess','userface','runimg', 'arr', 'huodong', 'maxtwo', 'plate', 'auther', 'username', 'link', 'tagname','adspace'));


//        return view('home/index',compact('plates'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
