@extends('layouts.layouts')

@section('title','资讯详情')

@section('content')

<link rel="stylesheet" href="{{asset('css/article.css')}}">
<script src="{{asset('js/mine.js')}}"></script>

<!-- InstanceBeginEditable name="EditRegion1" -->
<div class="coursecont">
<div class="coursepic">
	<h3 class="righttit">全部资讯</h3>
    <div class="clearh"></div>
    <span class="bread">
    <a class="ask_link" href="/article/articlelist">全部资讯</a>/{{$newsDetail['title']}}
    </span>
    
</div>
<div class="clearh"></div>
<div class="coursetext">
	<span class="articletitle">
        <h2>{{$newsDetail['title']}}</h2>
        <p class="gray">{{date("Y-m-d",$newsDetail['c_time'])}}</p>
    </span>
    <p class="coutex">{{$newsDetail['content']}}</p>
	<div class="clearh" style="height:30px;"></div>
	{{--<span class="pagejump">--}}
    	{{--<a class="pagebtn lpage" title="上一篇" href="#">上一篇</a>--}}
        {{--<a class="pagebtn npage" title="下一篇" href="#">下一篇</a>--}}
    {{--</span>--}}
    
</div>

<div class="courightext">
<div class="ctext">
    <div class="cr1">
    <h3 class="righttit">热门资讯</h3>
    <div class="gonggao">
	<ul class="hotask">
        @foreach($hot as $v)
        	<li><a class="ask_link" href="/article/articlecont/{{$v['id']}}"><strong>●</strong>{{$v['title']}}?</a></li>
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
        <a href="/curr/currcont/{{$v['lesson_id']}}"  target="_blank"><img src="{{asset('img')}}/{{$v['lesson_img']}}" height="60" title="财经法规与财经职业道德"></a>
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