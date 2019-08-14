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

// Route::get('/', function () {
    // return view('welcome');
// });

//前台模块
Route::prefix('/')->group(function(){
	//前台首页
	Route::get('index','Index\IndexController@index');
	//课程列表
	Route::any('curr/currlist/{id?}','Curr\CurrController@currList');
	//收藏课程
    Route::any('curr/collect/{id}','Curr\CurrController@collect');
    //取消收藏
    Route::any('curr/nocollect/{id}','Curr\CurrController@nocollect');
    //评价
    Route::any('curr/evaluate/{id}','Curr\CurrController@evaluate');
    //问答
    Route::any('curr/ask/{id}','Curr\CurrController@ask');

    //课程详情
	Route::get('curr/currcont/{id}','Curr\CurrController@currcont');
	//章节列表
	Route::get('curr/chapterlist/{id}','Curr\CurrController@chapterlist');
	//开始学习
	Route::get('curr/video','Curr\CurrController@video');
	//资讯列表
	Route::get('article/articlelist','Article\ArticleController@articleList');
	//资讯详情
	Route::get('article/articlecont/{id}','Article\ArticleController@articlecont');
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
});

