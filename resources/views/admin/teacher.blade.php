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
                <th>讲师ID</th>
                <th>讲师名称</th>
                <th>讲师介绍</th>
                <th>风格</th>
                <th>状态</th>
                <th>添加时间</th>
                <th>修改时间</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach($teachInfo as $k=>$v)
                <tbody>
                <tr teacher_id="{{$v->teacher_id}}">
                    <td id="teacher_id">{{$v->teacher_id}} </td>
                    <td>{{$v->name}}</td>
                    <td>{{$v->intro}}</td>
                    <td>{{$v->style}}</td>
                    <td>
                        @if ($v->status == 1)
                            <button type="button" class="layui-btn layui-btn-radius but" >审核中</button>
                        @else
                            <button type="button" class="layui-btn layui-btn-normal layui-btn-radius" >通过审核</button>
                        @endif
                            <button type="button" class="layui-btn layui-btn-danger but1">不同过审核</button>
                    </td>
                    <td>{{ date("Y-m-d H:i:s",$v->c_time)}}</td>
                    <td>{{ date("Y-m-d H:i:s",$v->u_time)}}</td>
                    <td>
                        <a href="teacherDel?teacher_id={{$v->teacher_id}}" >删除</a>
                        <a href="/user/update/{{$v->teacher_id}}">修改</a>
                    </td>

                </tr>
                </tbody>
            @endforeach
        </table>
    </div>

    <script src="{{asset('layui/layui.js')}}" charset="utf-8"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
    <script src="{{asset('js/jquery.js')}}"></script>
    <script>
        $(function(){
             //alert(1111);
            //点击通过审核
           $('.but').click(function(){
               //alert(11);
               var _this=$(this);
               var teacher_id=_this.parents('tr').attr('teacher_id');
              // console.log(teacher_id);
//                //点击提交审核
                $.ajax({
                    url :'TacherAudit',
                    data:{teacher_id:teacher_id},
                    method:'post',
                    dataType:'json',
                    success:function(res){
                        //alert(1111);
                        console.log(res);
                        if(res.code=='1'){
                            alert(res.font);
                            location.href='http://www.11.com/admin/Tacher';
                        }
                    }
                })


                return false;


           })
         //点击不通过审核
            $('.but1').click(function(){
                //alert(11);
                var _this=$(this);
                var teacher_id=_this.parents('tr').attr('teacher_id');
                // console.log(teacher_id);
//                //点击提交审核
                $.ajax({
                    url :'TacherNoAudit',
                    data:{teacher_id:teacher_id},
                    method:'post',
                    dataType:'json',
                    success:function(res){
                        //alert(1111);
                        console.log(res);
                        if(res.code=='1'){
                            alert(res.font);
                            location.href='http://www.11.com/admin/Tacher';
                        }
                    }
                })


                return false;


            })

        })
    </script>
@endsection
