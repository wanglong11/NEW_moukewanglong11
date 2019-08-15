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
        <form action="{{url('update')}}" method="post" style="width:600px">
            <div>
                <input type="hidden" name="user_id" value="{{$user_id}}">
                <p class="formrow">
                    <label class="control-label" id="email" for="register_email">邮箱</label>
                    <input type="text" name="email" >
                </p>
                <span class="text-danger">请输入Email</span>
            </div>
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">密码</label>
                    <input type="password" name="password">
                </p>
                <p class="help-block"><span class="text-danger">修改密码</span></p>
            </div>
            <div>
                <p class="formrow">
                    <label class="control-label" for="register_email">确认密码</label>
                    <input type="password" name="pwd">
                </p>
                <p class="help-block"><span class="text-danger">确认密码</span></p>
            </div>
            <div class="loginbtn">
                <button type="submit" class="uploadbtn ub1">修改密码</button>
            </div>

        </form>

    </div>
    <!-- InstanceEndEditable -->

    <div class="clearh"></div>
    <script src="./js/jquery-3.1.1.min.js"></script>
@endsection
