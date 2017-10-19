@extends('Layouts.userdetails')

@section('title','个人信息设置 | 我的主贴');

@section('content')

    <div title="我的主贴" class="only-title c-main">我的主帖</div>

    <div class="space10"></div>
    <div class="banner"></div>
    <!-- TABS内容 -->
    <div class="tabs-cont">
        <div class="myfollowact-box noline clearfix">
            <div class="followuser-act">
                @foreach($info as $k => $v)
                <div class="act-cont clearfix">
                    <div class="w-title bbs">
                        <span class="time">&nbsp;
                            {{date('Y/m/d H:i:s',$v->posttime)}}&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                            <a href="javascript:;" onclick="delpost({{$v->id}})" style="color:red;">删除</a>&nbsp;
                        </span>
                        <span class="f12px">
                            [<a href="/home/post/show/".{{$v->id}} target="_blank">{{$v->pname}}</a>]
                        </span>
                        <a href="/home/post/show/".{{$v->id}} target="_blank">[{{$v->tagname}}]{{$v->title}}</a>
                    </div>
                </div>
                @endforeach

                <div class="pagination clear" >
                        {!! $info->render() !!}
                </div>

            </div>
        </div>
    </div>
    <!--我的文集、我的跟帖、我在中途岛 End-->
    <script>
        function delpost(id){
            //询问框
            layer.confirm('此操作会将该帖放入回收站,请确认操作', {
                btn: ['确认','取消']
            }, function(){
                //  通过ajax 向服务器发送一个删除请求
                $.post("{{url('/home/delpost')}}",{'id':id,"_token":"{{csrf_token()}}"},function(data){

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

    <script src="{{asset('/home/js/log.js')}}"></script>


@endsection