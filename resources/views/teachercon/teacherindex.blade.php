@extends('public.app')
@section('title', 'layui后台大布局')
@section('sidebar')
    @parent
@endsection
@section('content')

<!DOCTYPE html>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>个人中心</title>
<link rel="stylesheet" type="text/css" href="/css/css.css" />
<script type="text/javascript" src="js/jquery.min.js"></script>
</head>
<body>
	<div id="pageAll">
		<div class="page ">
			<!-- 上传广告页面样式 -->
			<div class="banneradd bor">
				<div class="baTop">
					<span>个人中心</span>
				</div>
				<div class="baBody">
                    @foreach($teadata as $v)
					<div class="bbD">
						名称：<font class="input">{{$v->name}}</font>
					</div>
					<div class="bbD">
						简介：<font class="input">{{$v->intro}}</font>
                    </div>
                    <div class="bbD">
						风格：<font class="input">{{$v->style}}</font>
                    </div>
                    @if( $v->img == '')
                    <div class="bbD">
                        上传图片：
                    <form class="layui-form" action="/admin/teacher_img" method="post" enctype="multipart/form-data">
						<div class="bbDd">
							<div class="bbDImg">+</div>
                            <input type="file" name="filename" class="file" />
                            <input type="submit" value="确认上传">
                        </div>
                    </form>
                    </div>
                    @else
                    <div class="bbD">
						图片：<img src="/img/{{$v->img}}" alt="">
                    </div>
                    @endif
                    @endforeach
				</div>
			</div>

			<!-- 上传广告页面样式end -->
		</div>
	</div>
</body>
</html>

@endsection