@extends('public.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')
<div style="padding: 15px;">
<table class="layui-table" id="demo">
        <colgroup>
          <col width="150">
          <col width="200">
          <col>
        </colgroup>
        <thead>
          <tr>
            <th>id</th>
            <th>简介</th>
            <th>标题</th>
            <th>课程名称</th>
          </tr> 
        </thead>
        <tbody>
          @foreach($arr as $v)
          <tr parent_id="{{$v['pid']}}" dir_id="{{$v['dir_id']}}">
            <td>
                <?php echo str_repeat("&nbsp;&nbsp;",$v["lever"]*2)?>
                <a href="#" class="flag">+</a>
                {{$v['dir_id']}}
            </td>
            <td>
            <?php echo str_repeat("&nbsp;&nbsp;",$v["lever"]*2)?>
                {{$v['describe']}}
            </td>
            <td>
            <?php echo str_repeat("&nbsp;&nbsp;",$v["lever"]*2)?>
                {{$v['title']}}
            </td>
            <td>
            <?php echo str_repeat("&nbsp;&nbsp;",$v["lever"]*2)?>
                {{$v['lesson_name']}}
            </td>
            <td><a href="javascript:;" class="del" dir_id="{{$v['dir_id']}}">删除</a></td>
          </tr>
          @endforeach
        </tbody>
      </table>
</div>
<script src="/layui/layui.js"></script>
<link rel="stylesheet" href="/layui/css/layui.css" media="all">
<script src="/js/jquery.js"></script>
<script>
    $(function(){
        layui.use(['layer'],function(){
            var layer=layui.layer;
            $("tbody>tr[parent_id!=0]").hide();
            //符号  隐藏展示
            $('.flag').click(function(){
                var _this=$(this);
                var flag=_this.text();
                var dir_id=_this.parents('tr').attr('dir_id');
                if(flag=='+'){
                    if($("tbody>tr[parent_id="+dir_id+"]").length>0){
                    $("tbody>tr[parent_id="+dir_id+"]").show();
                        _this.text('-');
                    }
                    // alert($("tbody>tr[parent_id="+dir_id+"]").length)
                }else{
                    trHide(dir_id);
                    _this.text('+');
                }
                function trHide(dir_id){
                    var _tr=$("tbody>tr[parent_id="+dir_id+"]");
                    _tr.hide();
                    _tr.find('td').find("a[class='flag']").text('+');
                    for(var i=0;i<_tr.length;i++){
                        var c_id=_tr.eq(i).attr('dir_id');
                        trHide(c_id);
                    }
                }
            })
            //删除
            $('.del').click(function(){
                var _this=$(this);
                var dir_id=_this.attr('dir_id');
                $.ajax({
                    url:"/admin/sectiondel",
                    data:{dir_id:dir_id},
                    success:function(msg){
                        layer.msg(msg.msg);
                        if(msg.status==200){
                            _this.parents('tr').remove();
                        }
                    }
                })
            })
        })        
    })
</script>         
@endsection