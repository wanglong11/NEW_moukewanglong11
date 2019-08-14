@extends('public.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')
    <div style="padding:30px">
        <form class="layui-form" action="ConsultDO" method="post" enctype="multipart/form-data">
            {{csrf_field()}}
            <h3>咨询添加</h3>
            <div class="layui-form-item" style="width:500px; hight:200px">
                <label class="layui-form-label" >标题名称</label>
                <div class="layui-input-block">
                    <input type="text" name="title" required  lay-verify="required" placeholder="标题名称" autocomplete="off" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label" >内容</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" class="layui-textarea" style = "width:500px;" name="content"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">单选框</label>
                <div class="layui-input-block">
                    <input type="radio" name="is_hot" value="1" title="最热" checked="">
                    {{--<input type="radio" name="sex" value="女" title="女">--}}
                    {{--<input type="radio" name="sex" value="禁" title="禁用" disabled="">--}}
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