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
        <form class="layui-form" action="/admin/lessonadd" method="post" enctype="multipart/form-data"> <!-- 提示：如果你不想用form，你可以换成div等任何一个普通元素 -->
            <div class="layui-form-item">
                <label class="layui-form-label">课程名称</label>
                <div class="layui-input-block"> 
                    <input type="text" placeholder="请输入" name="lesson_name" autocomplete="off" id="lesson_name" class="layui-input">
                </div>
            </div>
            <div class="layui-form-item">
                <label class="layui-form-label">课程分类</label>
                <div class="layui-input-block">
                    <select lay-filter="aihao" id="cate_id" name="cate_id">
                        <option value="0">请选择</option>
                        @foreach($cateinfo as $v)
                            <option value="{{$v['cate_id']}}"><?php echo str_repeat("&nbsp;&nbsp;",$v["lever"]*2)?>{{$v['cate_name']}}</option>
                        @endforeach
                    </select>
                </div>
            </div>
            <div class="layui-form-item">
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;点击上传视频封面：
                <button type="button" class="layui-btn" id="test1">
                    <input type="file" name="filename" id="filename">
                </button>
            </div>
          <!-- <form action="/admin/upload" method="post" enctype="multipart/form-data">
                <input type="file" name="filename">
                <input type="submit" value="ss"> 
          </form> -->
            <div class="layui-form-item layui-form-text">
                <label class="layui-form-label">课程简介</label>
                <div class="layui-input-block">
                    <textarea placeholder="请输入内容" name="lesson_intro" id="lesson_intro"  class="layui-textarea"></textarea>
                </div>
            </div>
            <div class="layui-form-item">
                <div class="layui-input-block">
                    <button class="layui-btn lesson_but" lay-submit lay-filter="*">立即提交</button>
                    <button type="reset" class="layui-btn layui-btn-primary">重置</button>
                </div>
            </div>
            <!-- 更多表单结构排版请移步文档左侧【页面元素-表单】一项阅览 -->
</form>
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
<!-- <script>
     layui.use(['layer','upload'], function(){
        var form = layui.form;
        var upload = layui.upload; 

        $(document).on('click','.lesson_but',function(){
            // lesson_name=$('#lesson_name').val()
            // cate_id=$('#cate_id').val()
            // lesson_intro=$('#lesson_intro').val()
            // filename=$('#filename').val()
            // alert(filename)
            // data={}
            // data.filename=filename
            // data.lesson_name=lesson_name
            // data.cate_id=cate_id
            // data.lesson_intro=lesson_intro
            $.ajax({
                type:"post",
                data:data,
                url:"/admin/lessonadd",
                success:function(msg){
                    $('#video1').html(msg)
                }
            })

        })
      
        // upload.render({
        //     elem: '#test1' //绑定元素
        //     ,url: "/admin/upload" //上传接口
        //     ,multiple: true
        //     ,number:1
        //     ,done: function(res){
                
               
        //     }
        // });

    });
</script> -->
@endsection