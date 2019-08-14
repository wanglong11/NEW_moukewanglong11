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
            </colgroup>
            <thead>
            <tr>
                <th>ID</th>
                <th>课程名称</th>
                <th>操作</th>
            </tr>
            </thead>
            @foreach($str as $k=>$v)
                <tbody>
                <tr  cate_id="{{$v['cate_id']}}">
                    <td>{{$v['cate_id']}}</td>
                    <td id="teacher_id">{{str_repeat('------------------' , $v['lev']) . $v['cate_name'] }} </td>
                    <td>
                        <a href="" class="but">删除</a>
                        <a href="" class="but1">修改</a>
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
                var cate_id=_this.parents('tr').attr('cate_id');
                // console.log(cate_id);
//                //点击删除
                $.ajax({
                    url :'CateDel',
                    data:{cate_id:cate_id},
                    method:'post',
                    dataType:'json',
                    success:function(res){
                        //alert(1111);
                        //console.log(res);
                        if(res.code=='0'){
                            alert(res.font);
                            location.href='http://www.11.com/admin/Parent_Cart_List';
                        }else{
                            alert(res.font);
                        }

                    }
                })


                return false;


            })
//            //点击不通过审核
//            $('.but1').click(function(){
//                //alert(11);
//                var _this=$(this);
//                var teacher_id=_this.parents('tr').attr('teacher_id');
//                // console.log(teacher_id);
////                //点击提交审核
//                $.ajax({
//                    url :'TacherNoAudit',
//                    data:{teacher_id:teacher_id},
//                    method:'post',
//                    dataType:'json',
//                    success:function(res){
//                        //alert(1111);
//                        console.log(res);
//                        if(res.code=='1'){
//                            alert(res.font);
//                            location.href='http://www.11.com/admin/Tacher';
//                        }
//                    }
//                })
//
//
//                return false;
//
//
//            })

        })
    </script>
@endsection
