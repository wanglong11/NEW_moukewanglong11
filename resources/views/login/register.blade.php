@extends('layouts.layouts')

@section('title','注册')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="register" >
<h2>注册</h2>
<form action="{{url('/regadd')}}" method="post">
    <div>
    <p class="formrow"><label class="control-label" for="register_email">邮箱地址</label>
    <input type="text" name="email"></p>
    <span class="text-danger">请输入邮箱地址</span>
    </div>
    <div>
    <p class="formrow"><label class="control-label" for="register_email">昵称</label>
    <input type="text" name="name"></p>
    <span class="text-danger">该怎么称呼你？ 中、英文均可，最长14个英文或7个汉字</span>
    </div>
    <div>
    <p class="formrow"><label class="control-label" for="register_email">密码</label>
    <input type="password" name='password'></p>
    <span class="text-danger">5-20位英文、数字、符号，区分大小写</span>
    </div>
    <div>
    <p class="formrow"><label class="control-label" for="register_email">确认密码</label>
    <input type="password" name="pwd"></p>
    <span class="text-danger">再输入一次密码</span>
    </div>
    <div class="loginbtn reg">
    <button type="submit" class="uploadbtn ub1">注册</button>
    </div>

</form>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection