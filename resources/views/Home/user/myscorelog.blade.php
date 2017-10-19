@extends('Layouts.userdetails')

@section('title','个人信息设置 | 回复我的');

@section('content')

    <div class="tabs-cont">
        <!-- sunny modify 20130902 积分 begin -->
        <!-- tab = 7 会员开通 -->

        <div class="control-order">
            <div class="order-title fB">积分日志：</div>
            <div class="order-title">
                <span style="font-style: normal;">当前积分：{{$details->score}}分 </span>
            </div>

            <table cellspacing="0" cellpadding="0" class="underline">
                <tbody>
                <tr>
                    <th>积分</th>
                    <th>描述</th>
                    <th>时间</th>
                </tr>
                @foreach($info as $k=>$v)
                    <tr>
                        <td class="f11px">{{$v->scorelog}}</td>

                        <td class="f11px">{{$v->handle}}</td>

                        <td class="f11px">{{date('Y/m/d H:i:s',$v->time)}}</td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            <div class="pagination clear" >
                {!! $info->render() !!}
            </div>

        </div>

        <!-- tab=3 积分充值生成订单 -->

    </div>

@endsection