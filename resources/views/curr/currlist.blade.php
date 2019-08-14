@extends('layouts.layouts')

@section('title','课程列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/course.css')}}"/>
<script src="{{asset('js/jquery.tabs.js')}}"></script>
<script src="{{asset('js/mine.js')}}"></script>
<script src="{{asset('js/jquery.js')}}"></script>
<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
    <div class="courseleft">
	<span class="select">
        <form action="/curr/currlist" method="post">
            <input type="text" placeholder="请输入关键字" name="lesson_name" class="pingjia_con"/>
            <input type="submit" class="sellink" style="width: 60px;">
            {{--<a href="javascript:;" class="sellink"></a>--}}
        </form>
    </span>
    <ul class="courseul">
    <li class="curr" style="border-radius:3px 3px 0 0;background:#fb5e55;"><h3 style="color:#fff;"><a href="javascript:;" class="whitea">全部课程</a></h3>
     @foreach($arr as $k=>$v)
        <li>
        <h4>{{$v['parent']}}</h4> {{--class="course_curr"--}}
            <ul class="sortul">
            @foreach($v['data'] as $kk=>$vv)
                @if($num == 0)
                    @if($k == $num && $kk == $num)
                        <li class="course_curr check" cate_id="{{$vv['cate_id']}}"><a href="/curr/currlist/{{$vv['cate_id']}}">{{$vv['cate_name']}}</a></li>
                    @else
                        <li class="check" cate_id="{{$vv['cate_id']}}"><a href="/curr/currlist/{{$vv['cate_id']}}">{{$vv['cate_name']}}</a></li>
                    @endif
                @else
                    @if($vv['cate_id'] == $num)
                        <li class="course_curr check" cate_id="{{$vv['cate_id']}}"><a href="/curr/currlist/{{$vv['cate_id']}}">{{$vv['cate_name']}}</a></li>
                    @else
                        <li class="check" cate_id="{{$vv['cate_id']}}"><a href="/curr/currlist/{{$vv['cate_id']}}">{{$vv['cate_name']}}</a></li>
                    @endif
                @endif

            @endforeach
            </ul>
        <div class="clearh"></div>
        </li>
     @endforeach
    </ul>
    <div style="height:20px;border-radius:0 0 5px 5px; background:#fff;box-shadow:0 2px 4px rgba(0, 0, 0, 0.1)"></div>
    </div>
    <div class="courseright">
        <div class="clearh"></div>
      <ul class="courseulr">
       @foreach($rightInfo as $k=>$v)
        <li>
        	<div class="courselist">
            <a href="/curr/currcont/{{$v['lesson_id']}}" target="_blank"><img style="border-radius:3px 3px 0 0;" width="240" src="{{asset('img')}}/{{$v['lesson_img']}}" title="{{$v['lesson_name']}}"></a>
            <p class="courTit"><a href="/curr/currcont/{{$v['lesson_id']}}" target="_blank">{{$v['lesson_name']}}</a></p>
            <div class="gray">
            <span>{{$v['class_hour']}}课时 {{$v['class_time']}}分钟</span>
            <span class="sp1">{{$v['student_count']}}人学习</span>
            <div style="clear:both"></div>
            </div>
            </div>
       </li>
      @endforeach
    </ul>
    </div>
    <div class="clearh"></div>
</div>
</div>
<!-- InstanceEndEditable -->

<div class="clearh"></div>

<script>
    $(function () {
        $('.check').click(function () {
           var _this = $(this);
           $('.check').removeClass('course_curr');
           _this.addClass('course_curr');
        });
    })
</script>
@endsection