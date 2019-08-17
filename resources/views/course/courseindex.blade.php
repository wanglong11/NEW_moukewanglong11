@extends('layouts.layouts')

@section('title','个人中心')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<link rel="stylesheet" href="{{asset('css/member.css')}}"/>
<link rel="stylesheet" href="{{asset('css/tab.css')}}" media="screen">
<script src="{{asset('js/mine.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<script src="js/jquery.tabs.js"></script>
<script type="text/javascript">
    $(function(){
        $('.demo2').Tabs({
            event:'click'
        });
    });
</script>

<div class="clearh"></div>
<div class="membertab">
    <div class="memblist">
        <div class="membhead">
            <div style="text-align:center;"><img src="images/0-0.JPG" width="80" ></div>
            <div style="width:220px;text-align:center;">
                <p class="membUpdate mine">{{$userInfo['name']}}</p>
                <p class="membUpdate mine"><a href="mysetting.html">修改信息</a>&nbsp;|&nbsp;<a href="myrepassword.html">修改密码</a></p>
                <div class="clearh"></div>
            </div>
        </div>
        <div class="memb">

            <ul>
                <li class="currnav"><a class="mb1" href="mycourse.html">我的课程</a></li>
                <li><a class="mb3" href="myask.html">我的问答</a></li>
                <li><a class="mb4" href="mynote.html">我的笔记</a></li>
                <li><a class="mb12" href="myhomework.html">我的作业</a></li>
                <li><a class="mb2" href="training_list.html" target="_blank">我的题库</a></li>
            </ul>

        </div>


    </div>


    <div class="membcont">
        <h3 class="mem-h3">我的课程</h3>
        <div class="box demo2" style="width:820px;">
            <ul class="tab_menu" style="margin-left:30px;">
                <li class="current">学习的课程</li>
                <li>收藏</li>
            </ul>
            <div class="tab_box">
                <div>
                    <ul class="memb_course">
                        @foreach($lessonInfos as $k=>$v)
                        <li>
                            <div class="courseli">
                                <a href="/curr/currcont/{{$v['lesson_id']}}" target="_blank"><img width="230" src="images/c8.jpg"></a>
                                <p class="memb_courname"><a href="/curr/currcont/{{$v['lesson_id']}}" class="blacklink">{{$v['lesson_name']}}</a></p>
                                <div class="mpp">
                                    <div class="lv" style="width:20%;"></div>
                                </div>
                                <p class="goon"><a href="/curr/currcont/{{$v['lesson_id']}}"><span>继续学习</span></a></p>
                            </div>
                        </li>
                        @endforeach

                        <div style="height:10px;" class="clearfix"></div>
                    </ul>

                </div>

                <div class="hide">
                    <div>
                        <ul class="memb_course">
                            @foreach($lessonInfo as $k=>$v)
                            <li>
                                <div class="courseli mysc">
                                    <a href="/curr/currcont/{{$v['lesson_id']}}" target="_blank"><img width="230" src="images/c8.jpg" class="mm"></a>
                                    <p class="memb_courname"><a href="/curr/currcont/{{$v['lesson_id']}}" class="blacklink">{{$v['lesson_name']}}</a></p>
                                    <div class="mpp">
                                        <div class="lv" style="width:20%;"></div>
                                    </div>
                                    <p class="goon"><a href="/curr/currcont/{{$v['lesson_id']}}"><span>继续学习</span></a>
                                    <a href="javascript:;" class="nocollect" lesson_id="{{$v['lesson_id']}}" ><span>移除收藏</span></a></p>
                                </div>
                            </li>
                            @endforeach
                            <div class="clearfix" style="height:10px;"></div>
                        </ul>
                    </div>
                </div>

            </div>
        </div>
    </div>


    <div class="clearh"></div>
</div>

<script>
    $(function () {
       $('.nocollect').click(function () {
           var _this = $(this);
           var lesson_id = _this.attr('lesson_id');
           $.get(
               "/curr/nocollect/"+lesson_id,
               function (res) {
                   if (res == 1){
                       alert('移除收藏成功');
                       history.go(0);
                   }else{
                       alert('移除收藏失败');
                       history.go(0);
                   }
               }
           );
        })
    });
</script>

<div class="clearh"></div>

@endsection