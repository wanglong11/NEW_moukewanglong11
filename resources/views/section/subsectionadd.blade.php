@extends('public.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="/layui/css/layui.css" media="all">
    </head>
    <body>
        <div class="layui-form"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
            <div class="layui-form-item">
                <label class="layui-form-label">小节名称</label>
                <div class="layui-input-block">
                    <input type="text" name="" placeholder="请输入" autocomplete="off" id="section_name" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">选择章节</label>
                <div class="layui-input-block">
                    <select lay-filter="aihao" id="dir_id" >
                        <option value="">请选择</option>
                        @foreach($dirpiddata as $v)
                            <option value="{{$v['dir_id']}}">{{$v['title']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn lesson_but" lay-submit lay-filter="*">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
            <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
        </div>
    </body>
</html>
<script src="/layui/layui.js"></script>
<script src="/js/jquery.js"></script>
<script>
layui.use('form', function(){
  var form = layui.form;
  
  //各种基于事件的操作，下面会有进一步介绍
});
</script>
<script>
    layui.use('layer', function(){
        var form = layui.form;
        var layer = layui.layer;
        $(document).on('click','.lesson_but',function(){
            section_name=$('#section_name').val()
            dir_id=$('#dir_id').val()
            data={}
            data.title=section_name
            data.dir_id=dir_id
            $.ajax({
                type:"post",
                data:data,
                url:"/admin/subsectionadd",
                success:function(msg){
                    layer.msg(msg.msg)
                }
            })
        })
    });
</script>
@endsection