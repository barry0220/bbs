@extends('Layouts.home') @section('title','帖子首页') 
@section('content')


            <div class="bbsCont">
                <div class="bbsLeft">
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78530465";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                    <div class="hotplate">
                        <div class="title">
                            热门版块
                        </div>
                        <ul>

                        @foreach($plates as $k => $v)   
                            <li>
                                <a href="/home/plateslist/{{$v->id}}" tppabs="http://club.kdnet.net/list.asp?boardid=1">
                                    <img src="{{$v->imgfile}}" tppabs="{{asset('/home/img/1.43e9e240.png')}}">
                                    <span>
                                        {{$v->pname}}
                                    </span>
                                </a>
                            </li>

                        @endforeach
                          

                        </ul>

                    </div>
                    <div class="bbslist">
                        <div class="title">
                            <a id="a"  href="{{url('/home/post')}}" class="active" tppabs="{{url('/home/post')}}" >
                                原创帖文
                            </a>
                            <a id="b"  href="{{url('/home/cateye')}}"   class="active" tppabs="{{url('/home/cateye')}}">
                                猫眼观察
                            </a>
                        </div>
                <script src="{{asset('/home/js/jquery-1.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                </script>
                 <script>
                    
                   //  $('#a').click(function(){
                       

                   //      $(this).attr('class','active');
                   //      $('#b').removeattr('class');

                   //  });
                   // $('#b').click(function(){
                        
                        
                   //      $(this).addClass('active');                         
                   //      $('#a').removeattr('class');
                   //  });
                </script>

                        <ul>
                    @foreach($post as $k=> $v)
                            <li>
                                <a target="_blank" href="dispbbs.asp-id=12447302&boardid=1.htm" tppabs="http://club.kdnet.net/dispbbs.asp?id=12447302">
                                    <img src="{{asset('/home//img/59dc45910faf4.jpg')}}" tppabs="{{asset('/home//img/59dc45910faf4.jpg')}}">
                                </a>
                                <div class="list-title">
                                    <a target="_blank" href="/home/post/{{$v->id}}" tppabs="/home/post/{{$v->id}}">
                                        {{$v->title}}
                                    </a>
                                </div>
                                <div class="list-desc">
                                    <a target="_blank" href="/home/post/{{$v->id}}" tppabs="/home/post/{{$v->id}}">
                                       {{$v->keywords}}
                                    </a>
                                </div>
                                <div class="list-author">
                                    <a target="_blank" href="javascript:;" tppabs="http://club.kdnet.net/dispbbs.asp?id=12447302">
                                        {{$postusers["$v->uid"]}}
                                    </a>
                                    <span>
                                      {{date('Y-m-d H:i:s',$v->posttime)}}
                                    </span>
                                    <span>
                                        点击
                                        <a target="_blank" href="dispbbs.asp-id=12447302&boardid=1.htm" tppabs="http://club.kdnet.net/dispbbs.asp?id=12447302">
                                            {{$v->clickcount}}
                                        </a>
                                    </span>
                                    <span>
                                        回复
                                        <a target="_blank" href="dispbbs.asp-id=12447302&boardid=1.htm" tppabs="http://club.kdnet.net/dispbbs.asp?id=12447302">
                                            {{$v->replaycount}}
                                        </a>
                                    </span>
                                    <a href="{{url('/home/plateslist/'.$v->pid)}}" tppabs="http://club.kdnet.net/list.asp?boardid=1"
                                    class="plate">
                                        来自：{{$postplates[$v->pid]}}
                                    </a>
                                </div>
                            </li>
                    @endforeach

                        </ul>


                        
                        <div style="margin-left:500px" class="postlist-page">
                            <!-- <form class="c_pager">
                                <span class="numInfo">
                                    共1140个记录，页次1/38页
                                </span>
                                <a href="javascript:void(0);" class="btn btn-default reloadbtn">
                                    刷新
                                </a>
                                <a href="-p=c1-1&page=2.htm" tppabs="http://club.kdnet.net/?p=c1-1&page=2"
                                class="btn btn-default next">
                                    下一页
                                    <i class="fa fa-chevron-right">
                                    </i>
                                </a>
                                <div class="input-group">
                                    <input type="text" class="form-control" id="page_input">
                                    <button type="submit" class="btn btn-primary page_button" action-uri="//club.kdnet.net?p=c1-1&page=%d">
                                        GO
                                    </button>
                                </div>
                            </form> -->
                            {!!$post->render()!!}
                        </div>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78524648";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}" tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                </div>

        @endsection
       