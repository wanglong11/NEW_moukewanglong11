<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="register" >
    <h2>登录</h2>
    <form action="{{url('admin/logininfo')}}" method="post">
        <div>
            <p class="formrow"><label class="control-label" for="register_email">用户名</label>
                <input type="text" name="name"></p>
            <span class="text-danger">该怎么称呼你？ 中、英文均可</span>
        </div>
        <div>
            <p class="formrow"><label class="control-label" for="register_email">密码</label>
                <input type="password" name='password'></p>
            <span class="text-danger">5-20位英文、数字、符号，区分大小写</span>
        </div>
        <div class="loginbtn reg">
            <a href="{{url('admin/reg')}}">注册</a>
            <button type="submit" class="uploadbtn ub1">登录</button>
        </div>

    </form>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>