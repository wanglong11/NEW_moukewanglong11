@extends('layouts.layouts')

@section('title','章节列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/register-login.css')}}"/>
<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>
{{--<script src="{{asset('js/jquery.js')}}"></script>--}}
<script type="text/javascript">

$(function(){

	$('.demo2').Tabs({
		event:'click'
	});
	$('.demo3').Tabs({
		event:'click'
	});
});
</script>

<!-- InstanceBeginEditable name="EditRegion1" -->


<div class="coursecont">
<div class="coursepic1">
   <div class="coursetitle1">
       <input type="hidden" name="lesson_id" value="{{$detailInfo['lesson_id']}}">
    	<h2 class="courseh21">{{$detailInfo['lesson_name']}}</h2>
		<div  style="margin-top:-40px;margin-right:25px;float:right;">
		<div class="bdsharebuttonbox">
			<a title="分享到QQ空间" href="#" class="bds_qzone" data-cmd="qzone"></a>
			<a title="分享到新浪微博" href="#" class="bds_tsina" data-cmd="tsina"></a>
			<a title="分享到腾讯微博" href="#" class="bds_tqq" data-cmd="tqq"></a>
			<a title="分享到人人网" href="#" class="bds_renren" data-cmd="renren"></a>
			<a title="分享到微信" href="#" class="bds_weixin" data-cmd="weixin"></a>
			<a href="#" class="bds_more" data-cmd="more"></a>
			<a class="bds_count" data-cmd="count"></a>
		</div>
        <script>
		window._bd_share_config={"common":{"bdSnsKey":{},"bdText":"","bdMini":"2","bdMiniList":false,"bdPic":"","bdStyle":"0","bdSize":"24"},"share":{},"image":{"viewList":["qzone","tsina","tqq","renren","weixin"],"viewText":"分享到：","viewSize":"24"}};with(document)0[(getElementsByTagName('head')[0]||body).appendChild(createElement('script')).src='http://bdimg.share.baidu.com/static/api/js/share.js?v=89860593.js?cdnversion='+~(-new Date()/36e5)];
		</script>
		</div>
   </div>
   <div class="course_img1">
	   <img src="{{asset('img')}}/{{$detailInfo['lesson_img']}}" height="140">
   </div>
   <div class="course_xq">
       <span class="courstime1"><p>课时<br/><span class="coursxq_num">{{$detailInfo['class_hour']}}课时</span></p></span>
	   <span class="courstime1"><p>学习人数<br/><span class="coursxq_num">{{$detailInfo['student_count']}}人</span></p></span>
	   <span class="courstime1"><p style="border:none;">课程时长<br/><span class="coursxq_num">{{$detailInfo['class_time']}}分</span></p></span>
   </div>
   <div class="course_xq2">
      <a class="course_learn" href="{{asset('audio/audio.mp4')}}">开始学习</a>
   </div> 
    <div class="clearh"></div>
</div>

<div class="clearh"></div>
<div class="coursetext">
	<div class="box demo2" style="position:relative">
			<ul class="tab_menu">
				<li class="current course1">章节</li>
				<li class="course1">评价</li>
				<li class="course1">问答</li>
                <li class="course1">资料区</li>
			</ul>
			<div class="tab_box">
				<div>
					<dl class="mulu noo">
                        @foreach($lessondir as $k=>$v)
					<div>
                        <dt class="mulu_title"><span class="mulu_img"></span>第{{$k+1}}章&nbsp;&nbsp;{{$v['title']}}
						<span class="mulu_zd">+</span></dt>
						<div class="mulu_con">
                            @foreach($arr as $kk=>$vv)
                                @foreach($vv as $kkk=>$vvv)
                                    @if($v['dir_id'] == $vvv['pid'])
							            <dd class="smalltitle"><strong>第{{$kkk+1}}节&nbsp;&nbsp;{{$vvv['title']}}</strong></dd>
                                            @if(isset($vvv['data']))
                                            @foreach($vvv['data'] as $key=>$val)
                                                <a href="{{asset('audio')}}/{{$val['src']}}"><dd><strong class="cataloglink">课时{{$key+1}}：{{$val['title']}}</strong><i class="fini fn"></i></dd></a>
                                            @endforeach
                                            @endif
                                    @endif
                                @endforeach
                            @endforeach
						</div>
					</div>
                        @endforeach
                   </dl>                   
				</div>
				<div class="hide">
					<div>
                    <div id="star">
                        <span class="startitle">请打分</span>
                        <ul>
                            <li><a href="javascript:;">1</a></li>
                            <li><a href="javascript:;">2</a></li>
                            <li><a href="javascript:;">3</a></li>
                            <li><a href="javascript:;">4</a></li>
                            <li><a href="javascript:;">5</a></li>
                        </ul>
                        <span class="fen"></span>
                        <p></p>
	                  </div>
                    <div class="c_eform">                      
                        <textarea rows="7" class="pingjia_con pingjia" onblur="if (this.value =='') this.value='评价详细内容';this.className='pingjia_con'" onclick="if (this.value=='评价详细内容') this.value='';this.className='pingjia_con_on'">评价详细内容</textarea>
                       <a href="javascript:;" class="fombtn form1">发布评论</a>
                       <div class="clearh"></div>
                    </div>
					<ul class="evalucourse">
                        @foreach($evluates as $k=>$v)
                    	<li>
                        	<span class="pephead"><img src="{{asset('img')}}/{{$v['img']}}" width="50" title="{{$v['name']}}">
                            <p class="pepname">{{$v['name']}}</p>
                            </span>
                            <span class="pepcont"><p>{{$v['content']}}</p>
                            <p class="peptime pswer">{{date("Y-m-d",$v['c_time'])}}</p></span>
                        </li>
                        @endforeach
                    </ul>
				</div>
				</div>
                <div class="hide">
					<div>
                     <h3 class="pingjia">提问题</h3>
                    <div class="c_eform">
                        <input type="text" class="pingjia_con " id="biaoti" value="请输入问题标题" onblur="if (this.value =='') this.value='请输入问题标题';this.className='pingjia_con'" onclick="if (this.value=='请输入问题标题') this.value='';this.className='pingjia_con_on'"/><br/>
                        <textarea rows="7" class="pingjia_con " id="neirong" onblur="if (this.value =='') this.value='请输入问题的详细内容';this.className='pingjia_con'" onclick="if (this.value=='请输入问题的详细内容') this.value='';this.className='pingjia_con_on'">请输入问题的详细内容</textarea>
                       <a href="javascript:;" class="fombtn form2" >发布</a>
                       <div class="clearh"></div>
                    </div>
					<ul class="evalucourse">
                        @foreach($asks as $k=>$v)
                    	<li>
                        	<span class="pephead"><img src="{{asset('img')}}/{{$v['img']}}" width="50" title="{{$v['name']}}">
                            <p class="pepname">{{$v['name']}}</p>
                            </span>
                            <span class="pepcont">
                            <p><a href="javascript:;" class="peptitle title" ask_id="{{$v['ask_id']}}">{{$v['title']}}</a></p>

                                <div style="display: none;background-color: #00A8FF">详细内容：<br/>
                                    <span class="detail"></span>
                                </div>

                                <br />

                                <div id="huida" style="display: none">
                                    <p>
                                        <textarea cols="25" rows="5"></textarea>
                                        <input class="huida" type="button" ask_id="{{$v['ask_id']}}" user_id="{{$v['user_id']}}" value="回答">
                                    </p>
                                </div>

                                <br />

                                <div style="background-color: #00FFFF;display: none" id="checkAsk">
                                    全部回答
                                  <span>

                                  </span>
                                </div>
                            <p class="peptime pswer">
                                <span class="pepask">查看回答(<strong>
                                        <a class="bluelink bluelinks" ask_id="{{$v['ask_id']}}" user_id="{{$v['user_id']}}" href="javaScript:;">{{$v['reply_num']}}</a>
                                    </strong>)&nbsp;&nbsp;&nbsp;&nbsp;浏览(<strong>
                                        {{$v['look_num']}}
                                    </strong>)
                                </span>
                                {{date("Y-m-d",$v['c_time'])}}
                            </p>

                            </span>
                        </li>
                        @endforeach
                    </ul>
                    
				</div>
				</div>
				<div class="hide">
					<div>
					<ul class="notelist" >
                        @foreach($lessonDatas as $k=>$v)
       <li>
	   <p class="mbm mem_not"><a href="{{asset('audio')}}/{{$v['src']}}" class="peptitle">{{$v['data_name']}}</a></p>
       		<p class="gray"><b class="coclass">课时：<a href="{{asset('audio')}}/{{$v['src']}}" target="_blank">{{$detailInfo['lesson_name']}}</a></b><b class="cotime">上传时间：<b class="coclass" >{{date("Y-m-d",$v['c_time'])}}</b></b></p>
            
       </li>  
                        @endforeach
  </ul>
                    
				</div>
				</div>
				
			</div>
		</div>
   
</div>

<div class="courightext">
<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">授课讲师</h3>
    <div class="teacher">
    <div class="teapic ppi">
    <a href="teacher.html" target="_blank"><img src="{{asset('img')}}/{{$teacherInfo['img']}}" width="80" class="teapicy" title="{{$teacherInfo['name']}}"></a>
     <h3 class="tname"><a href="teacher.html" class="peptitle" target="_blank">{{$teacherInfo['name']}}</a><p style="font-size:14px;color:#666">{{$pos_name}}</p></h3>
    </div>
    <div class="clearh"></div>
        <p>{{$teacherInfo['intro']}}</p>
    </div>
    </div>
</div>

<div class="ctext">
    <div class="cr1">
    <h3 class="righttit" onclick="reglog_open();">最新学员</h3>
        <div class="teacher zxxy">
        <ul class="stuul">
            @foreach($student_info as $k=>$v)
            <li><img src="{{asset('img')}}/{{$v['img']}}" width="60" title="{{$v['name']}}"><p class="stuname">{{$v['name']}}</p></li>
            @endforeach
        </ul>
        <div class="clearh"></div>
        </div>
    </div>
</div>

<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">相关课程</h3>
    <div class="teacher">
        @foreach($randLesson as $k=>$v)
            <div class="teapic">
                <a href="/curr/currcont/{{$v['lesson_id']}}"  target="_blank"><img src="{{asset('img')}}/{{$v['lesson_img']}}" height="60" title="{{$v['lesson_name']}}"></a>
                <h3 class="courh3"><a href="/curr/currcont/{{$v['lesson_id']}}" class="peptitle" target="_blank">{{$v['lesson_name']}}</a></h3>
            </div>
        @endforeach
    <div class="clearh"></div>
    </div>
    </div>
</div>
   
</div>

<div id="reglog">
<span class="close"  onclick="reglog_close();">×</span>
<div class="loginbox">
    <div class="demo3 rlog">
			<ul class="tab_menu rlog">
				<li class="current">登录</li>
				<li>注册</li>
			</ul>
			<div class="tab_box">
				<div>
                <form class="loginform pop">
                <div>
                    <p class="formrow">
                    <label class="control-label pop" for="register_email">帐号</label>
                    <input type="text" class="popinput">
                    </p>
                    <span class="text-danger">请输入Email地址 / 用户昵称</span>
                </div>
                
                <div>
                    <p class="formrow">
                    <label class="control-label pop" for="register_email">密码</label>
                    <input type="password" class="popinput">
                    </p>
                    <p class="help-block"><span class="text-danger">密码错误</span></p>
                </div>
                <div class="clearh"></div>
                <div class="popbtn">
                    <label><input type="checkbox" checked="checked"> <span class="jzmm">记住密码</span> </label>&nbsp;&nbsp;
                    <button type="submit" class="uploadbtn ub1">登录</button>
                    
                </div>
                <div class="popbtn lb">
                   <a href="#" class="link-muted">还没有账号？立即免费注册</a>
                   <span>&nbsp;&nbsp;|&nbsp;&nbsp;</span>   
                   <a href="forgetpassword.html" class="link-muted">找回密码</a>
                </div>
              
                        
                        <div class="popbtn hezuologo">
                        <span class="hezuo z1">使用合作网站账号登录</span>
                        <div class="hezuoimg z1">
                        <img src="images/hezuoqq.png" class="hzqq" title="QQ" width="40" height="40">
                        <img src="images/hezuowb.png" class="hzwb" title="微博" width="40" height="40">
                        </div>
                        </div>
                </form>
				</div>
				<div class="hide">
					<div>
					<form class="loginform pop">
                     <div>
                        <p class="formrow">
                        <label class="control-label pop" for="register_email">邮箱地址</label>
                        <input type="text" class="popinput">
                        </p>
                        <span class="text-danger">请输入Email地址 / 用户昵称</span>
                    </div>
                	<div>
                        <p class="formrow">
                        <label class="control-label pop" for="register_email">昵称</label>
                        <input type="text" class="popinput">
                        </p>
                        <span class="text-danger">请输入Email地址 / 用户昵称</span>
                    </div>
                    <div>
                        <p class="formrow">
                        <label class="control-label pop" for="register_email">密码</label>
                        <input type="password" class="popinput">
                        </p>
                        <p class="help-block"><span class="text-danger">密码错误</span></p>
                    </div>
                    <div>
                        <p class="formrow">
                        <label class="control-label pop" for="register_email">确认密码</label>
                        <input type="password" class="popinput">
                        </p>
                        <p class="help-block"><span class="text-danger">密码错误</span></p>
                    </div>
                    
                    
                    <button type="submit" class="uploadbtn ub1">注册</button>
                   
                    
                
                </form>
                    
				</div>
				</div>
				
			</div>
		</div>
   
    </div>
</div>


<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

<script>
    $(function () {
        //评价
        $('.form1').click(function () {

            var score = $('.fen').text();
            score = score.substr(score,1);
            if (score == ''){
                alert('还未进行打分');return;
            }
            var content = $('.pingjia_con').val();
            if (content == ''){
                alert('请输入评价内容');return;
            }

            var lesson_id = $("[name=lesson_id]").val();
            // alert(content);return;
            $.post(
                "/curr/evaluate/"+lesson_id,
                {score:score,content:content},
                function (res) {
                    if (res == 1){
                        alert('评论成功');
                    }else{
                        alert('评论失败');
                    }
                }
            );
        });
        //回答
        $('.form2').click(function () {
            var title = $('#biaoti').val();
            if (title == ''){
                alert('请输入标题');return;
            }
            var content = $('#neirong').val();
            if (content == ''){
                alert('请输入提问的内容');return;
            }
            var lesson_id = $("[name=lesson_id]").val();
            // alert(title);
            // alert(content);
            // alert(lesson_id);return;
            $.post(
                "/curr/ask/"+lesson_id,
                {title:title,content:content},
                function (res) {
                    if (res == 1){
                        alert('发布成功');
                        history.go(0);
                    }else{
                        alert('发布失败');
                        history.go(0);
                    }
                }
            );

        });
        //提问详情
        $('.title').click(function () {
            var _this = $(this);
            var ask_id = _this.attr('ask_id');
            // alert(_this.parent('p').next('div').children('span').text());
            $.post(
                "/curr/askdetail/"+ask_id,
                function (res) {
                   if (res ==''){
                       _this.parent('p').next('div').children('span').text('无');
                       _this.parent('p').next('div').show();
                       $('#huida').show();
                   } else{
                       _this.parent('p').next('div').children('span').text(res);
                       _this.parent('p').next('div').show();
                       $('#huida').show();
                   }
                }
            );

        });
        //详情回答
        $('.huida').click(function () {
            var _this = $(this);
            var user_id = _this.attr('user_id');
            var ask_id = _this.attr('ask_id');
            var content = _this.prev('textarea').val();
            $.post(
                "/curr/detailask",
                {user_id:user_id,ask_id:ask_id,content:content},
                function (res) {
                    if (res == 1){
                        alert('回答成功');
                        history.go(0);
                    } else{
                        alert('回答失败');
                    }
                }
            );
        });
        //查看回答
        $('.bluelinks').click(function () {
            var _this = $(this);
            var user_id = _this.attr('user_id');
            var ask_id = _this.attr('ask_id');
            $.post(
                "/curr/checkask",
                {user_id:user_id,ask_id:ask_id},
                function (res) {
                    // console.log(res);
                    if (res == ''){
                        alert('暂无回答');
                    } else{
                        for (var i = 0; i < res.length; i++) {
                            $('#checkAsk').children('span').append(" " +
                                "<p class=\"peptime pswer\">\n" +
                                "    <span class=\"pepask\">\n" +
                                "      "+res[i].content+"\n" +
                                "    </span>\n" +
                                "      "+res[i].c_time+"\n" +
                                "</p>");
                        }
                        $('#huida').show();
                        $('#checkAsk').show();
                    }
                }
            );
        });
    })
</script>

@endsection