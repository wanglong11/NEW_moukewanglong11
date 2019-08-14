<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    phpinfo();
});


//前台模块
Route::prefix('/')->group(function(){
	//前台首页
	Route::get('index','Index\IndexController@index');
	//课程列表
	Route::get('curr/currlist','Curr\CurrController@currList');
	//课程详情
	Route::get('curr/currcont','Curr\CurrController@currcont');
	//章节列表
	Route::get('curr/chapterlist','Curr\CurrController@chapterlist');
	//开始学习
	Route::get('curr/video','Curr\CurrController@video');
	//资讯列表
	Route::get('article/articlelist','Article\ArticleController@articleList');
	//资讯详情
	Route::get('article/articlecont','Article\ArticleController@articlecont');
	//讲师列表
	Route::get('teacher/teacherlist','Teacher\TeacherController@teacherList');
	//讲师详情
	Route::get('teacher/teachercont','Teacher\TeacherController@teachercont');
	//注册页面
	Route::get('register','Login\LoginController@register');
	//登录页面
	Route::get('login','Login\LoginController@login');
});

//后台模块
Route::prefix('/admin')->group(function(){
	//后台首页
	Route::get('index','Admin\AdminController@index');
	//后台登录
	Route::get('Log','Admin\LoginController@Log');
	//后台注册
	Route::get('Reg','Admin\LoginController@reg');



	Route::get('lesson','Section\SectionController@lesson');
	Route::post('lessonadd','Section\SectionController@lessonadd');
	Route::get('section','Section\SectionController@section');
	Route::post('sectionadd','Section\SectionController@sectionadd');
	Route::get('subsection','Section\SectionController@subsection');
	Route::post('subsectionadd','Section\SectionController@subsectionadd');
	Route::get('hour','Section\SectionController@hour');
	Route::post('houradd','Section\SectionController@houradd');
	Route::any('upload','Section\SectionController@upload');
	Route::any('audio','Section\SectionController@audio');
	Route::any('sectiondata','Section\SectionController@sectiondata');
	Route::any('sectiondel','Section\SectionController@sectiondel');
	Route::any('teacher_con','Section\SectionController@teacher_con');
	Route::any('teacher_img','Section\SectionController@teacher_img');
	Route::any('eqit','Section\SectionController@eqit');
});

