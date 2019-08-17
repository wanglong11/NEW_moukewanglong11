@extends('layouts.layouts')

@section('title','登录')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>
{{--<script src="{{asset('js/jquery-1.8.0.min.js')}}"></script>--}}
<script src="https://cdn.dingxiang-inc.com/ctu-group/captcha-ui/index.js"></script>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="login" >
<h2>登录</h2>
<form method="post"  action="/loginadd" style="width:600px">
<div>
    <p class="formrow">
    <label class="control-label" for="register_email">帐号</label>
    <input type="text" name="email">
    </p>
    <span class="text-danger">请输入Email地址 / 用户昵称</span>
</div>
<div>
    <p class="formrow">
    <label class="control-label" for="register_email">密码</label>
    <input type="password" name="password">
    </p>
    <p class="help-block"><span class="text-danger">密码错误</span></p>
</div>
    <div>
    <p class="formrow">
        <label class="control-label" for="register_email">安全验证</label>
    <div style="float: left;position:absolute;top:400px;left:300px;" class="text-danger" id="demo-oneclick">
        </div>
</div>
<div class="loginbtn">
	<label><input type="checkbox"  checked="checked"> <span class="jzmm">记住密码</span> </label>&nbsp;&nbsp;
    <button type="submit" class="uploadbtn ub1">登录</button>
    
</div>
<div class="loginbtn lb">
   <a href="register" class="link-muted">还没有账号？立即免费注册</a>
   <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>   
   <a href="update" class="link-muted">找回密码</a>
</div>
</form>
<div class="hezuologo">
    <span class="hezuo">使用合作网站账号登录</span>
    <div class="hezuoimg">
    <img src="images/hezuoqq.png" class="hzqq" title="QQ" width="40" height="40"/>

        <a href="{{url('https://api.weibo.com/oauth2/authorize?client_id=2869939600&response_type=code&redirect_uri=http://www.11.com/callback')}}">
            <img src="images/hezuowb.png" class="hzwb" title="微博" width="40" height="40"/>
        </a>


        <a href="{{url('https://api.weibo.com/oauth2/authorize?client_id=3376413357&response_type=code&redirect_uri=http://www.laravel11.com/callback')}}">
            <img src="images/hezuowb.png" class="hzwb" title="微博" width="40" height="40"/>
        </a>


    <link rel="stylesheet" href="{{asset('css/course.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
    <script src="{{asset('js/jquery.tabs.js')}}"></script>
    <script src="{{asset('js/mine.js')}}"></script>

    <!-- InstanceBeginEditable name="EditRegion1" -->
        </div>

    </div>
    <!-- InstanceEndEditable -->


    <div class="clearh"></div>

</div>
<!-- 注册js部分 -->
<script type="text/javascript">
    //开启自动加载函数
    $(function() {
        //引入layer美化提示信息

            var check = '';
            //安全验证
            var myCodecheck = _dx.Captcha(document.getElementById('demo-oneclick'), {
                appId: '9ce41efd20078399fb0c31bfd23aad92',
                style: 'oneclick',
                // language:'en',
                width: 300,
                success: function (token) {
                    check = token;
                }

            })
        })
//    if (check == '') {    验证安全验证
//        layer.msg('请完成验证');
//        return false;
//    }


    </script>
@endsection