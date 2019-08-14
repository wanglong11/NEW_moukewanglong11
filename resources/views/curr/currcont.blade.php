@extends('layouts.layouts')

@section('title','课程内容')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<div class="course_img"><img src="{{asset('img')}}/{{$detailInfo['lesson_img']}}" width="500"></div>
    <div class="coursetitle">
   		<a class="state">更新中</a>
    	<h2 class="courseh2">{{$detailInfo['lesson_name']}}</h2>
        <p class="courstime">总课时：<span class="course_tt">{{$detailInfo['class_hour']}}课时</span></p>
		<p class="courstime">课程时长：<span class="course_tt">{{$detailInfo['class_time']}}分</span></p>
        <p class="courstime">学习人数：<span class="course_tt">{{$detailInfo['student_count']}}人</span></p>
		<p class="courstime">讲师：{{$teacherInfo['name']}}</p>
		<p class="courstime">课程评价：<img width="71" height="14" src="{{asset('images/evaluate5.png')}}}">&nbsp;&nbsp;<span class="hidden-sm hidden-xs">5.0分（10人评价）</span></p>
        <!--<p><a class="state end">完结</a></p>-->      
        <span class="coursebtn">
            <a class="btnlink" href="/curr/chapterlist/{{$detailInfo['lesson_id']}}">加入学习</a>
            <a class="codol fx" href="javascript:void(0);" onClick="$('#bds').toggle();">分享课程</a>
            {{--<a class="codol sc" href="#">收藏课程</a>--}}
            @if($isCollection == 1)
                <a class="codol sc" style="background-position: 0px -1800px;" lesson_id="{{$detailInfo['lesson_id']}}" href="javascript:;">取消收藏</a>
            @else
                <a class="codol sc" style="background-position: 1px -5px;" lesson_id="{{$detailInfo['lesson_id']}}" href="javascript:;">收藏课程</a>
            @endif
        </span>
		<div style="clear:both;"></div>
		<div id="bds">
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
    <div class="clearh"></div>
</div>

<div class="clearh"></div>
<div class="coursetext">
	<h3 class="leftit">课程简介</h3>
    <p class="coutex">{{$detailInfo['lesson_intro']}}</p>
	<div class="clearh"></div>
	<h3 class="leftit">课程目录</h3>
    <dl class="mulu">
    @foreach($lessondir as $k=>$v)
    	<dt><a href="/curr/chapterlist/{{$detailInfo['lesson_id']}}" class="graylink">第{{$k+1}}章&nbsp;&nbsp;{{$v['title']}}</a></dt>
        <dd>{{$v['describe']}}</dd>
    @endforeach
    </dl>
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
    <h3 class="righttit">课程公告</h3>
    <div class="gonggao">
	<div class="clearh"></div>
     @foreach($noticeInfo as $k=>$v)
        <p>{{$v['content']}}<br/>
        <span class="gonggao_time">{{date("Y-m-d H:i",$v['c_time'])}}</span>
        </p>
        <div class="clearh"></div>
    @endforeach
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
        // style="background-position: 0px -1800px;"取消收藏
        // background-position: 1px -5px;
        $('.sc').click(function () {
            var _this = $(this);
            var lesson_id = _this.attr('lesson_id');
            var text = _this.text();
           if(text == '收藏课程'){
               $.get(
                   "/curr/collect/"+lesson_id,
                   function (res) {
                       if (res == 1){
                          alert('收藏成功');
                           history.go(0);
                       }else{
                           alert('收藏失败');
                           history.go(0);
                       }
                   }
               );
           }else if (text == '取消收藏') {
               $.get(
                   "/curr/nocollect/"+lesson_id,
                   function (res) {
                       if (res == 1){
                          alert('取消收藏成功');
                           history.go(0);
                       }else{
                           alert('取消收藏失败');
                           history.go(0);
                       }
                   }
               );
           }


        })
    })
</script>

@endsection