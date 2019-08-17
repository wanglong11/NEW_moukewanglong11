@extends('layouts.layouts')

@section('title','修改密码')

@section('content')

    <link rel="stylesheet" href="{{asset('css/course.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
    <script src="{{asset('js/jquery.tabs.js')}}"></script>
    <script src="{{asset('js/mine.js')}}"></script>

    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="login">
        <h2>修改密码</h2>
        <form action="{{url('upds')}}" method="post" style="width:600px">
            <div>
                <p class="formrow">
                    <label class="control-label"  for="register_email">新密码</label>
                    <input type="password" name="password"  >
                </p>
                <span class="text-danger">请输入新密码</span>
            </div>
            <div>
                <p class="formrow">
                    <label class="control-label"  for="register_email">确认密码</label>
                    <input type="password" name="pwd"   >
                </p>
                <span class="text-danger">请确认密码</span>
            </div>
            <div class="loginbtn">&nbsp;
                <button type="submit"  class="uploadbtn ub1">修改</button>
            </div>
        </form>

    </div>
    <!-- InstanceEndEditable -->

    <div class="clearh"></div>
    <script src="./js/jquery-3.1.1.min.js"></script>



@endsection
