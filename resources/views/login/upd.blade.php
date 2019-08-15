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
        <form action="{{url('updadd')}}" method="post" style="width:600px">
            <div>
                <p class="formrow">
                    <label class="control-label" id="email" for="register_email">邮箱</label>
                    <input type="text" name="email" >
                </p>
                <span class="text-danger">请输入Email</span>
            </div>
            <div>
                <p class="formrow">
                    <button type="submit" name="email" id="dateBtn1" class="uploadbtn ub1">获取验证码</button>
                    <input type="text" name="email" id="usercode" >
                </p>
            </div>
            <div class="loginbtn">&nbsp;
                <button type="submit" class="uploadbtn ub1">确定</button>
            </div>
        </form>

    </div>
    <!-- InstanceEndEditable -->

    <div class="clearh"></div>
    <script src="./js/jquery-3.1.1.min.js"></script>
    <script>
        $(function(){
            //60秒倒计时
            $("#dateBtn1").on("click",function(){
                var _this=$(this);
                if(!$(this).hasClass("on")){
                    var data={};
                    data.tel=$("#email").val();
                    $.ajax({
                        type:"post",
                        data:data,
                        url:"code",
                        dataType:"json",
                        success:function(msg){
                            if(msg.code==1){
                                layer.msg(msg.msg);
                            }else{
                                layer.msg(msg.msg);
                            }
                        }
                    });
                    $.leftTime(60,function(d){
                        if(d.status){
                            _this.addClass("on");
                            _this.html((d.s=="00"?"60":d.s)+"秒后重新获取");
                        }else{
                            _this.removeClass("on");
                            _this.html("获取验证码");
                        }
                    });
                }
            });
        });
    </script>
@endsection
