@extends('layouts.layouts')

@section('title','验证邮箱')

@section('content')

    <link rel="stylesheet" href="{{asset('css/course.css')}}"/>
    <link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
    <script src="{{asset('js/jquery.tabs.js')}}"></script>
    <script src="{{asset('js/mine.js')}}"></script>

    <!-- InstanceBeginEditable name="EditRegion1" -->
    <div class="login">
        <h2>验证邮箱</h2>
        <form action="{{url('updadd')}}" method="post" style="width:600px">
            <div>
                <p class="formrow">
                    <label class="control-label"  for="register_email">邮箱</label>
                    <input type="text" name="email"  id="email" >
                </p>
                <span class="text-danger">请输入Email</span>
            </div>
            <div>
                <p class="formrow">
                    <button type="button"  id="dateBtn1" class="uploadbtn ub1">获取验证码</button>
                    <input type="text" name="code"  id="usercode" >
                </p>
            </div>
            <div class="loginbtn">&nbsp;
                <button type="submit"  class="uploadbtn ub1">确定</button>
            </div>
        </form>
        <input type="hidden" id="_token" name="_token" value="<?php echo csrf_token(); ?>">
    </div>
    <!-- InstanceEndEditable -->

    <div class="clearh"></div>
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script>
        $('.ub1').click(function(){
            $email=$('#email').val();
            $code=$('#code').val();
            $.ajax({
                url:"{{url('updadd')}}",
                data:'{email:email,code:code}',
                type:'post',
                success:function(msg){
                  console.log(msg)
                }
            })
        })
    </script>
    <script>
        $(function(){
            //60秒倒计时
                $(document).on('click','#dateBtn1',function () {
                    var email = $('#email').val();
                    var _token = $("#_token").val();
                    $.post(
                        "{{url('code')}}",
                        {email:email,_token:_token},
                        function (res) {
                            if (res){
                                alert('发送成功');
                            } else{
                                alert('发送失败');
                            }
                        }
                    )
                })
            })
    </script>

@endsection
