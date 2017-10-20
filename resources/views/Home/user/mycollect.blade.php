@extends('Layouts.userdetails')

@section('title','个人信息设置 | 我的收藏');

@section('content')
    <!--控制面板内容-->
    <!-- OnlyTitle -->
    <div title="我的收藏" class="only-title c-main">我的收藏</div>
    <!-- OnlyTitle End -->

    <!-- TABS内容 -->
    <div class="tabs-cont">

        <ul class="ccollect-title clearfix">
            <li class="ctitle">标题</li>
            <li class="ctime">收藏时间</li>
            <li class="ccontrol">操作</li>
        </ul>

        @foreach($info as $k => $v)
        <ul class="ccollect-list clearfix">
            <li class="ctitle c-main">
                [<a title="[{{$v->tagname}}]{{$v->title}}" href="{{'/home/plateslist/'.$v->platesid}}" target="_blank">{{$v->pname}}</a>]
                <a title="[{{$v->tagname}}]{{$v->title}}" href="{{'/home/post/'.$v->postid}}" target="_blank">[{{$v->tagname}}]{{$v->title}}</a>
            </li>
            <li class="ctime f11px c-sub">{{date('Y/m/d H:i:s',$v->collecttime)}}</li>
            <li class="ccontrol c-main"><a href="javascript:;" onclick="discollect({{$v->id}})">取消收藏</a></li>
        </ul>
        @endforeach
        <div class="pagination clear" >
            {!! $info->render() !!}
        </div>
    </div>

    <script src="{{asset('/home/js/log.js')}}"></script>
    <script>
        function discollect(id){
            //询问框
            layer.confirm('此操作会将该帖取消收藏,请确认操作', {
                btn: ['确认','取消']
            }, function(){
                //  通过ajax 向服务器发送一个删除请求
                $.post("{{url('/home/discollect')}}",{'id':id,"_token":"{{csrf_token()}}"},function(data){

                    if(data.status == 0){
                        layer.msg(data.msg, {icon: 6});
                        setTimeout(function(){
                            location.href = location.href;
                        },3000)
                    }else{

                        layer.msg(data.msg, {icon: 5});
                    }

                })

            });
        }
    </script>

    <div class="coll-change-box"></div>

@endsection