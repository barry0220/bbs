@extends('Layouts.home') 



@section('title',"列表") 



@section('content')

            <div class="bbsCont bbstext">
                <div class="bbsLeft">
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78856938";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"
                        tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                    <div class="postbox">
                        <div class="postlist-header">
                            <div class="bbsshortcut-box">
                                <div class="bbsshortcut" id="bbsshortcut">
                                    <em>
                                        版块快捷入口：
                                    </em>
                                   @foreach($plates as $k=>$v)
                                    <a href="{{url('/home/list/$v->id')}}" tppabs="http://club.kdnet.net/list.asp?boardid=52">
                                        {{$v->pname}}
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="bbsshortcut-list" id="bbsshortcut-list">
                                      @foreach($plates as $k=>$v)
                                    <a href="{{url('/home/list/$v->id')}}" tppabs="http://club.kdnet.net/list.asp?boardid=52">
                                        {{$v->pname}}
                                    </a>
                                    @endforeach
                                                  
                                </div>
                                <a class="bbsshortcut-morebtn" id="bbsshortcut-morebtn">
                                    <span>
                                        更多
                                    </span>
                                    <i class="fa fa-caret-down">
                                    </i>
                                </a>
                            </div>
                            <div class="postlist-header-top">
                                <a class="newpostbtn"  href="{{url('/home/post/create')}} "
                                tppabs="http://upfile1.kdnet.net/textareaeditor/post_ubb.asp?action=new&boardid=1">
                                    <i>
                                    </i>
                                    发布新帖
                                </a>
                                
                                <a class="frbtn reloadbtn">
                                    刷新
                                </a>
                         
                            </div>
<!--                             <div class="postfilter">
                                <div class="postfilter-nav">
                                    <a href="list.asp-boardid=1&topicmode=1.htm" tppabs="http://club.kdnet.net/list.asp?boardid=1&topicmode=1">
                                        精华
                                    </a>
                                    <a href="list.asp-boardid=1&topicmode=3.htm" tppabs="http://club.kdnet.net/list.asp?boardid=1&topicmode=3">
                                        原创
                                    </a>
                                    <a href="list.asp-boardid=1&topicmode=2.htm" tppabs="http://club.kdnet.net/list.asp?boardid=1&topicmode=2">
                                        热帖
                                    </a>
                                    <a href="list.asp-boardid=1&topicmode=4.htm" tppabs="http://club.kdnet.net/list.asp?boardid=1&topicmode=4">
                                        百姓家史
                                    </a>
                                </div>
                                <div class="postfilter-order">
                                    <a class="postfilter-order-btn" id="postfilter-order-btn">
                                        <span>
                                            按最新主帖排序
                                        </span>
                                        <i class="fa fa-caret-down">
                                        </i>
                                    </a>
                                    <div class="postfilter-order-list">
                                        <a href="list.asp-boardid=1&date=desc.htm" tppabs="http://club.kdnet.net/list.asp?boardid=1&date=desc">
                                            按最后更新排序
                                        </a>
                                        <a href="list.asp-boardid=1&atti=desc.htm" tppabs="http://club.kdnet.net/list.asp?boardid=1&atti=desc"
                                        class="active">
                                            按最新主帖排序
                                        </a>
                                    </div>
                                </div>
                            </div> -->
                        </div>
                        <div class="postlist-table">
                            <table>
                                <thead>
                                    <tr>
                                        <th class="table-state">
                                            状态
                                        </th>
                                        <th class="table-title">
                                            主题
                                        </th>
                                        <th class="table-author">
                                            作者
                                        </th>
                                        <th class="table-read">
                                            回复/点击
                                        </th>
                                        <th class="table-update">
                                            最后更新
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                     
                     @foreach($posts as $k=>$v)
                                    <tr class="list-folder">
                                        <td class="table-state">
                                            <i title="{{$statu[$v->postcode]}}">
                                            </i>
                                        </td>
                                        <td class="table-title">
                                            <a href="/home/post/{{$v->id}}" target="_blank"  title="{{$v->title}}"
                                            tppabs="http://club.kdnet.net/dispbbs.asp?id=12447981&boardid=1">
                                               {{$v->title}}
                                            </a>
                                        </td>
                                        <td class="table-author">
                                            <a target="_blank"  href="javascript:;"
                                            tppabs="http://user.kdnet.net/index.asp?userid=14835782">
                                                {{$postusers[$v->uid]}}
                                            </a>
                                        </td>
                                        <td class="table-read">
                                            {{$v->replaycount}}/{{$v->clickcount}}
                                        </td>
                                        <td class="table-update">
                                            {{date('Y-m-d H:i:s',$v->posttime)}}|
                                            <a target="_blank" href="javascript:;"
                                            tppabs="#">
                                               {{$postusers[$v->uid]}}
                                            </a>
                                        </td>
                                    </tr>

                    @endforeach
                          
                                </tbody>
                            </table>
                        </div>
                        <div class="postlist-footer">
                             <div class="postlist-footer">
                            <div class="postlist-footer-top">
                                 <a class="newpostbtn"  href="{{url('/home/post/create')}}"
                                tppabs="http://upfile1.kdnet.net/textareaeditor/post_ubb.asp?action=new&boardid=1">
                                    <i>
                                    </i>
                                    发布新帖
                                </a>
                                <div class="postlist-page" style="margin-top:-15px;margin-right:10px;">
                                 {!!$posts->render()!!}
                                </div>
                            </div>
                   
                        </div>
                            <div class="postlist-footer-bottom">
                                
                            </div>
                        </div>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78884199";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"
                        tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78876430";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"
                        tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                </div>
                <div class="bbsRight">
                    <div class="c_spread">
                        <script type="text/javascript">
                            ac_as_id = "mm_34021018_13540158_78680059";
                            ac_format = 1;
                            ac_mode = 1;
                            ac_group_id = 1;
                            ac_server_base_url = "afpeng.alimama.com/";
                        </script>
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"
                        tppabs="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>
                    
                </div>
            
 
     @endsection