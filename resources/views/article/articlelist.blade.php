@extends('layouts.layouts')

@section('title','资讯列表')

@section('content')

<link rel="stylesheet" href="{{asset('css/article.css')}}">
<link rel="stylesheet" href="{{asset('css/page.css')}}">
<script src="{{asset('js/mine.js')}}"></script>


<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<h3 class="righttit">全部资讯</h3>
    <div class="clearh"></div>
    <span class="bread nob">
        <a class="fombtn cur" href="/article/articlelist">全部资讯</a>
        {{--<a class="fombtn" href="articlelist.html">热门资讯</a>--}}
        {{--<a class="fombtn" href="articlelist.html">考试指导</a>--}}
        {{--<a class="fombtn" href="articlelist.html">精彩活动</a>--}}
    </span>
    
</div>
<div class="clearh"></div>
<div class="coursetext">
    @foreach($news as $k=>$v)
	<div class="articlelist">
    	<h3><a class="artlink" href="/article/articlecont/{{$v['id']}}">{{$v['title']}}?</a></h3>
        <p>{{$v['content']}}</p>
        <p class="artilabel">
            @if($v['is_hot'] == 1)
                <span class="ask_label">热门资讯</span>
            @endif
        <b class="labtime">{{date("Y-m-d",$v['c_time'])}}</b>
        </p>
        <div class="clearh"></div>
    </div>
    @endforeach

	<div class="clearh" style="height:20px;"></div>
	<span class="pagejump">
    	<p class="userpager-list">

            {{$news->links()}}
       	   {{--<a href="#" class="page-number">首页</a>--}}
           {{--<a href="#" class="page-number">上一页</a>--}}
           {{--<a href="#" class="page-number">1</a>--}}
           {{--<a href="#" class="page-number pageractive">2</a>--}}
           {{--<a href="#" class="page-number">3</a>--}}
            {{--<a href="#" class="page-number">...</a>--}}
            {{--<a href="#" class="page-number">10</a>--}}
           {{--<a href="#" class="page-number">下一页</a>--}}
           {{--<a href="#" class="page-number">末页</a>--}}
        </p>
    </span>
    <div class="clearh" style="height:10px;"></div>
</div>

<div class="courightext">
<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">热门资讯</h3>
    <div class="gonggao">
	<ul class="hotask">
        @foreach($hot as $k=>$v)
        	<li><a class="ask_link" href="/article/articlecont/{{$v['id']}}"><strong>●</strong>{{$v['title']}}</a></li>
        @endforeach
        </ul>
    </div>
    </div>
</div>

<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">推荐课程</h3>
    <div class="teacher">
        @foreach($lesson as $v)
    <div class="teapic">
        <a href="/curr/currcont/{{$v['lesson_id']}}"  target="_blank"><img src="{{asset('img')}}/{{$v['lesson_img']}}" height="60" title="{{$v['lesson_name']}}"></a>
        <h3 class="courh3"><a href="/curr/currcont/{{$v['lesson_id']}}" class="ask_link" target="_blank">{{$v['lesson_name']}}</a></h3>
    </div>
        @endforeach
    <div class="clearh"></div>
    </div>
    </div>
</div>
   
</div>



<div class="clearh"></div>
</div>
<!-- InstanceEndEditable -->


<div class="clearh"></div>

@endsection