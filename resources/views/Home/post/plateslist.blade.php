@extends('Layouts.home') @section('title','列表') 
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
                                    <a href="{{url('/home/plateslist/'.$v->id)}}">
                                        {{$v->pname}}
                                    </a>
                                    @endforeach
                                    
                                </div>
                                <div class="bbsshortcut-list" id="bbsshortcut-list">
                                      @foreach($plates as $k=>$v)
                                    <a href="{{url('/home/list/$v->id')}}">
                                        {{$v->pname}}
                                    </a>
                                    @endforeach
                                                  
                                </div>
                                {{--<a class="bbsshortcut-morebtn" id="bbsshortcut-morebtn">--}}
                                    {{--<span>--}}
                                        {{--更多--}}
                                    {{--</span>--}}
                                    {{--<i class="fa fa-caret-down">--}}
                                    {{--</i>--}}
                                {{--</a>--}}
                            </div>
                            <div class="postlist-header-top">
                                <a class="newpostbtn"   href="{{url('/home/post/create')}}">发布新帖</a>
                                {{--<p>--}}
                                    {{--<em>--}}
                                        {{--版主：--}}
                                    {{--</em>--}}
                                    {{--<a target="_blank" href="../user.kdnet.net/index.asp-username=值班编辑19"--}}
                                    {{--tppabs="http://user.kdnet.net/index.asp?username=%D6%B5%B0%E0%B1%E0%BC%AD19">--}}
                                        {{--值班编辑19--}}
                                    {{--</a>--}}
                                    {{--<em>--}}
                                        {{--主持：--}}
                                    {{--</em>--}}
                                    {{--<a href="../user.kdnet.net/index.asp-username=二猫" tppabs="http://user.kdnet.net/index.asp?username=%B6%FE%C3%A8"--}}
                                    {{--target="_blank">--}}
                                        {{--二猫--}}
                                    {{--</a>--}}
                                    {{--<em>--}}
                                        {{--在线：--}}
                                    {{--</em>--}}
                                    {{--<a href="../user.kdnet.net/index.asp-userid=257144" tppabs="http://user.kdnet.net/index.asp?userid=257144"--}}
                                    {{--target="_blank">--}}
                                        {{--值班编辑26--}}
                                    {{--</a>--}}
                                    {{--<a href="javascript:;">--}}
                                        {{--值班编辑02--}}
                                    {{--</a>--}}
                                {{--</p>--}}
                                <a class="frbtn reloadbtn" onclick="javascript:location.href=location.href;">刷新</a>
                                {{--<a class="frbtn" href="list.asp-boardid=13.htm" tppabs="http://club.kdnet.net/list.asp?boardid=13">--}}
                                    {{--站务专区--}}
                                {{--</a>--}}
                            </div>
                            <div class="postfilter">
                                <div class="postfilter-nav">
                                    <a href="javascript:;">精华</a>
                                    <a href="javascript:;">原创</a>
                                    <a href="javascript:;">热帖</a>
                                    <a href="javascript:;">百姓家史</a>
                                </div>
                                <div class="postfilter-order">
                                    <a class="postfilter-order-btn" id="postfilter-order-btn">
                                        <span>按最新主帖排序</span>
                                        <i class="fa fa-caret-down">
                                        </i>
                                    </a>
                                    <div class="postfilter-order-list">
                                        <a href="list.asp-boardid=1&date=desc.htm">
                                            按最后更新排序
                                        </a>
                                        <a href="list.asp-boardid=1&atti=desc.htm" class="active">
                                            按最新主帖排序
                                        </a>
                                    </div>
                                </div>
                            </div>
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
                                        <td class="table-state bbs">
                                            <i title="{{$statu[$v->postcode]}}">
                                            </i>
                                        </td>
                                        <td class="table-title">
                                            <a href="/home/post/{{$v->id}}" target="_blank"  title="{{$v->title}}">
                                               {{$v->title}}
                                            </a>
                                        </td>
                                        <td class="table-author">
                                            <a target="_blank"  href="javascript:;">
                                                {{$v->username}}
                                            </a>
                                        </td>
                                        <td class="table-read">
                                            {{$v->replaycount}}/{{$v->clickcount}}
                                        </td>
                                        <td class="table-update">
                                              {{date('Y-m-d H:i:s',$v->posttime)}}　|　
                                            <a  href="javascript:;">
                                               {{$v->username}}
                                            </a>
                                        </td>
                                    </tr>

                    @endforeach
                          
                                </tbody>
                            </table>
                        </div>
                        <div class="postlist-footer">
                            <div class="postlist-footer-top">
                                <a class="newpostbtn"   href="{{url('/home/post/create')}}">发布新帖</a>
                                <div class="pagination" style="margin-top:-15px;margin-right:10px;">
                                 {!!$posts->render()!!}
                                </div>
                            </div>
                   
                        </div>
                    </div>
                    <div class="c_spread">

                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"></script>
                    </div>
                    <div class="c_spread">
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}"></script>
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
                        <script type="text/javascript" src="{{asset('/home/js/k.js')}}">
                        </script>
                    </div>

  
      @endsection