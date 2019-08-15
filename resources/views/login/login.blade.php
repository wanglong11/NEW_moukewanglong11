@extends('layouts.layouts')

@section('title','登录')

@section('content')

    <link rel="stylesheet" href="{{asset('css/course.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
    <script src="{{asset('js/jquery.tabs.js')}}"></script>
    <script src="{{asset('js/mine.js')}}"></script>

    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="login">
        <h2>登录</h2>
         <form action="loginadd" method="post" style="width:600px" >
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">帐号</label>
                    <input type="text" name="email" id="email">
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
            <div class="loginbtn">
                <label><input type="checkbox"  checked="checked"> <span class="jzmm">记住密码</span> </label>&nbsp;&nbsp;
                <button type="submit" class="uploadbtn ub1">登录</button>

            </div>
            <div class="loginbtn lb">
                <a href="{{url('register')}}" class="link-muted">还没有账号？立即免费注册</a>
                <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>
                <a href="{{url('update')}}" class="link-muted" id="on">找回密码</a>
            </div>
        </form>
        <div class="hezuologo">
            <span class="hezuo">使用合作网站账号登录</span>
            <div class="hezuoimg">
                <img src="images/hezuoqq.png" class="hzqq" title="QQ" width="40" height="40"/>
                <a href="https://api.weibo.com/oauth2/authorize?client_id=3376413357&response_type=code&redirect_uri=http://www.laravel11.com/callback">
                        <img src="images/hezuowb.png" class="hzwb" title="微博" width="40" height="40"/>
                </a>
            </div>

        </div>
    </div>
    <!-- InstanceEndEditable -->



    <div class="clearh"></div>
    <script src="/js/jquery-1.8.0.min.js"></script>

@endsection