@extends('public.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')
    <div style="padding:30px">
        <form class="layui-form" action="Subclass_Cart_Do" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <h3>课程子类添加</h3>
            <div class="layui-form-item" style="width:500px; hight:200px">
                <label class="layui-form-label" >课程子类名称</label>
                <div class="layui-input-block">
                    <input type="text" name="cart_name" required  lay-verify="required" placeholder="课程子类名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">请选择父类</label>
                <div class="layui-input-block">
                    <select name="interest" lay-filter="aihao">
                        @foreach($arr as $k=>$v)
                        <option value="{{$v['cate_id']}}">{{$v['cate_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item" >
                <div class="layui-input-block" >
                    <button class="layui-btn" lay-submit lay-filter="formDemo">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
        </form>

        <script>
            //Demo
            layui.use('form', function(){
                var form = layui.form;

//
            });
        </script>
    </div>
    <script src="{{asset('layui/layui.js')}}" charset="utf-8"></script>
    <!-- 注意：如果你直接复制所有代码到本地，上述js路径需要改成你本地的 -->
    <script src="{{asset('js/jquery.js')}}"></script>
@endsection