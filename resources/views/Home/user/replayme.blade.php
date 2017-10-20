@extends('Layouts.userdetails')

@section('title','个人信息设置 | 回复我的');

@section('content')

        <div title="回复我的" class="only-title c-main">回复我的&nbsp;&nbsp;</div>

        <div class="space10"></div>

        <!-- 列表内容 -->
        <div class="tabs-cont">
            <div>

            @foreach($info as $k => $v)
                <div class="myfollowact-box clearfix">
                    <div class="followuser-pic">
                        <a target="_blank" title="{{$v->username}}" href="javascript:;">
                            <span></span>
                            <img width="40" height="40" src="{{$v->userface}}" onerror="this.src = duf_40_40;">
                        </a>
                    </div>
                    <div class="followuser-act">
                        <div class="relist clearfix">
                            <span class="c-main"><a  href="javascript:;">{{$v->username}}</a></span>
                            <span>
								<a target="_blank" href="{{'/home/post/'.$v->postid}}">{{$v->content}}</a>
                            </span>
                            <div class="f12px time">
                                {{date('Y/d/d H:i:s',$v->time)}}&nbsp;&nbsp;&nbsp;来自
                                <span class="c-main">
                                    <a target="_blank" href="{{'/home/plateslist/'.$v->platesid}}">{{$v->pname}}</a>
                                </span>
                            </div>
                        </div>
                        <div class="c-sub bbstitle">
                            <span class="f12px">
                                [<a target="_blank" href="{{'/home/plateslist/'.$v->platesid}}">{{$v->pname}}</a>]
                            </span> <a target="_blank" href="{{'/home/post/'.$v->postid}}">{{$v->title}}</a>
                            {{--<span class="stat c-alarm f10px">91/14066</span>--}}
                        </div>

                    </div>
                </div>
            @endforeach
                <div class="pagination clear" >
                    {!! $info->render() !!}
                </div>

            </div>
        <!-- TABS内容 End -->
        </div>
    <!--我的文集、我的跟帖、我在中途岛 End-->

@endsection