@extends('layouts.layouts')

@section('title','讲师列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont" style="background: none repeat scroll 0 0 #fff;border-radius: 3px;box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);" >
    <h3 class="righttit" style="padding-left:50px;">优秀讲师</h3>
	@if($code==0)
		<h3 style="color:blue">暂无讲师数据...</h3>
	@elseif($code==1)
		@foreach($data as $k=>$v)
		<div class="coursepic tecti">
			<div class="teaimg">
			<a href="/teacher/teachercont?teacher_id={{$v['teacher_id']}}" target="_blank">
				{{--<img src="{{asset($v['img'])}}" width="150">--}}
				<img src="{{asset('img')}}/{{$v['img']}}"  width="150">
			</a>
			</div>
			<div class="teachtext">
				<h3><a href="/teacher/teachercont?teacher_id={{$v['teacher_id']}}" target="_blank" class="teatt">{{$v['name']}}</a>&nbsp;&nbsp;<strong>{{$v['pos_name']}}</strong></h3>
				<h4>个人简介</h4>
				<p>{{$v['intro']}}</p>
				<h4>授课风格</h4>
				<p>{{$v['style']}}</p>
			</div>
			<div class="clearh"></div>
		</div>
		@endforeach
	@endif
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection