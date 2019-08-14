<!DOCTYPE html>
<html>
<head>
    <title>应用名称 - @yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <link rel="stylesheet" href="{{asset('layui/css/layui.css')}}">
    <script src="{{asset('layui/layui.js')}}"></script>

</head>
<body>
@section('sidebar')
    <body class="layui-layout-body">
    <div class="layui-layout layui-layout-admin">
        <div class="layui-header">
            <div class="layui-logo">layui 后台布局</div>
            <!-- 头部区域（可配合layui已有的水平导航） -->
            <ul class="layui-nav layui-layout-left">
                <li class="layui-nav-item"><a href="">控制台</a></li>
                <li class="layui-nav-item"><a href="">商品管理</a></li>
                <li class="layui-nav-item"><a href="">用户</a></li>
                <li class="layui-nav-item">
                    <a href="javascript:;">其它系统</a>
                    <dl class="layui-nav-child">
                        <dd><a href="">邮件管理</a></dd>
                        <dd><a href="">消息管理</a></dd>
                        <dd><a href="">授权管理</a></dd>
                    </dl>
                </li>
            </ul>
            <ul class="layui-nav layui-layout-right">
                <li class="layui-nav-item">
                    <a href="javascript:;">
                        <img src="http://t.cn/RCzsdCq" class="layui-nav-img">
                        贤心
                    </a>
                    <dl class="layui-nav-child">
                        <dd><a href="">基本资料</a></dd>
                        <dd><a href="">安全设置</a></dd>
                    </dl>
                </li>
                <li class="layui-nav-item"><a href="{{asset('layui/css/layui.css')}}">退了</a></li>
            </ul>
        </div>

        <div class="layui-side layui-bg-black">
            <div class="layui-side-scroll">
                <!-- 左侧导航区域（可配合layui已有的垂直导航） -->
                <ul class="layui-nav layui-nav-tree"  lay-filter="test">
                    <li class="layui-nav-item layui-nav-itemed">
                        <a class="" href="javascript:;">客户服务管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="">列表一</a></dd>
                            <dd><a href="crm/public/client/lists">列表二</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layui-nav-itemed">
                        <a class="" href="javascript:;">教师管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{asset('/admin/Tacher')}}">教师展示</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layui-nav-itemed">
                        <a class="" href="javascript:;">课程分类</a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{asset('/admin/Parent_Cart_Add')}}">课程父类添加</a></dd>
                            <dd><a href="{{asset('/admin/Parent_Cart_List')}}">课程分类展示</a></dd>
                            <dd><a href="{{asset('/admin/Subclass_Cart_Add')}}">课程子类添加</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item layui-nav-itemed">
                        <a class="" href="javascript:;">咨询管理</a>
                        <dl class="layui-nav-child">
                            <dd><a href="{{asset('/admin/ConsultAdd')}}">咨询添加</a></dd>
                            <dd><a href="{{asset('/admin/Consult_List')}}">咨询展示</a></dd>
                        </dl>
                    </li>
                    <li class="layui-nav-item"><a href="">云市场</a></li>
                    <li class="layui-nav-item"><a href="">发布商品</a></li>
                </ul>
            </div>
        </div>

        <div class="layui-body">
            @show
            <div class="container"> @yield('content') </div>
        </div>

        <div class="layui-footer">
            <!-- 底部固定区域 -->
        </div>
    </div>

    <script>
        //JavaScript代码区域
        layui.use('element', function(){
            var element = layui.element;

        });
    </script>
    </body>
</html>
</body>
</html>