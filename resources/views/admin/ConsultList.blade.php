@extends('public.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')
    {{--<meta http-equiv="refresh" content="2">--}}
    <div class="layui-form">
        <table class="layui-table">
            <colgroup>
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="150">
                <col width="300">
                <col width="100">
                <col width="100">
                <col>
            </colgroup>
            <thead>
            <tr>
                <th>标题ID</th>
                <th>标题名称</th>
                <th>内容</th>
                <th>是否是最热</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach($arr as $k=>$v)
                <tbody>
                <tr>
                    <td>{{$v['id']}}</td>
                    <td>{{$v['title']}}</td>
                    <td>{{$v['content']}}</td>
                    <td>
                        @if ($v['is_hot'] == 1)
                          最热标题
                        @else
                          不是最热标题
                        @endif
                    </td>
                    <td>{{ date("Y-m-d H:i:s",$v['c_time'])}}</td>
                    <td>{{ date("Y-m-d H:i:s",$v['u_time'])}}</td>
                    <td>
                        <a href="ConsultDel?id={{$v['id']}}" >删除</a>
                        <a href="/user/update/?id={{$v['id']}}">修改</a>
                    </td>

                </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <script src="{{asset('layui/layui.js')}}" charset="utf-8"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
    <script src="{{asset('js/jquery.js')}}"></script>
@endsection
