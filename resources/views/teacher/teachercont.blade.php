@extends('layouts.layouts')

@section('title','讲师详情')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic tecti">
	<div class="teaimg">
    <img src="{{asset($data['img'])}}" width="150">
    </div>
    <div class="teachtext">
    	<h3>{{$data['name']}}&nbsp;&nbsp;<strong>{{$data['pos_name']}}</strong></h3>
        <h4>个人简介</h4>
        <p>{{$data['intro']}}</p>
        <h4>授课风格</h4>
        <p>{{$data['style']}}</p>
    </div>
    <div class="clearh"></div>
</div>

<div class="clearh"></div>

<div class="tcourselist">
<h3 class="righttit" style="padding-left:50px;">在教课程</h3>
<ul class="tcourseul">
	@if($code==0)
		<h3 style="color:blue">暂无课程...</h3>
	@elseif($code==1)
		@foreach($course as $k=>$v)
		<li>
			<span class="courseimg tcourseimg"><a href="/curr/currcont" target="_blank"><img width="230" src="{{asset($v['lesson_img'])}}"></a></span>
			<span class="tcoursetext">
			   <h4><a href="/curr/currcont" target="_blank" class="teatt">{{$v['lesson_name']}}</a><a class="state">更新中</a></h4>
			   <p class="teadec">{{$v['lesson_intro']}}</p>
			   <p class="courselabel clock">{{$v['class_hour']}}课时 {{$v['class_time']}}分钟<span class="courselabel student">{{$v['student_count']}}人学习</span><span class="courselabel pingjia">评价：<img width="71" height="14" src="images/evaluate.png" data-bd-imgshare-binded="1"></span></p>
		   </span>
		   <div style="height:0" class="clearh"></div>
		</li>
		@endforeach
	@endif
{{--	<li>--}}
{{--	     <span class="courseimg tcourseimg"><a href="coursecont.html" target="_blank"><img width="230" src="images/c8.jpg"></a></span>--}}
{{--	     <span class="tcoursetext">--}}
{{--	        <h4><a href="coursecont.html" target="_blank" class="teatt">会计从业资格会计基础会计从业资格会计基础会计础</a><a class="state end">已完结</a></h4>--}}
{{--	        <p class="teadec">会计从业资格会计基础会计从业资格会计基础会计础会计从业资格会计基础会计从业资格会计基础会计础会计从业资格会计基础会计从业资格会计基础会计础</p>--}}
{{--	        <p class="courselabel clock">30课时 600分钟<span class="courselabel student">2555人学习</span><span class="courselabel pingjia">评价：<img width="71" height="14" src="images/evaluate.png" data-bd-imgshare-binded="1"></span></p>--}}
{{--	     </span>--}}
{{--	     <div style="height:0" class="clearh"></div>--}}
{{--	</li>--}}
<div class="clearh"></div>
</ul>
</div>




<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection