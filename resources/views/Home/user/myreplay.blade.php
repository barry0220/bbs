@extends('Layouts.userdetails')

@section('title','个人信息设置 | 我的回复');

@section('content')

    <div title="我的回复" class="only-title c-main">我的回复</div>
    <div class="tabs-cont">
        <div class="myfollowact-box noline clearfix">
            <div class="followuser-act">

                @foreach($info as $K => $v)
                <div class="title-list clearfix">
                    <div class="icon"></div>
                    <div class="title-cont c-main">
                        [<a href="/home/plateslist/".{{$v->platesid}} target="_blank"><span class="f12px">{{$v->pname}}</span></a>]
                        <a title="{{$v->title}}" href="/home/post/show/".{{$v->postid}} target="_blank">{{$v->title}}</a>
                    </div>
                    <div class="title-num c-alarm f10px"></div>
                    <div class="time c-sub">{{date('Y/m/d H:i:s',$v->posttime)}}</div>
                    <div class="author c-sub">
                        <a href="javascript:;" target="_blank">楼主:{{$v->username}}</a>
                    </div>
                    <div id="replylist02" class="replylist-box">
                        <ul class="reply-list c-sub">
                            <li>
                                <a title="{{$v->content}}" href="/home/post/show/".{{$v->postid}}target="_blank">{{$v->content}}</a>
                                &nbsp;&nbsp;&nbsp;{{date('Y/d/d H:i:s',$v->time)}}
                            </li>
                        </ul>
                    </div>
                </div>
                @endforeach

                <div class="pagination clear" >
                    {!! $info->render() !!}
                </div>
            </div>
            <script src="{{asset('/home/js/log.js')}}">
            </script>
        </div>
    </div>


@endsection