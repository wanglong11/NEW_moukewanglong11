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
    Route::post('regadd','Login\LoginController@regadd');
	//登录页面
    Route::get('login','Login\LoginController@login');
    Route::post('loginadd','Login\LoginController@loginadd');

    // 用户授权后新浪微博回调的页面
//    Route::get('weibo', 'AuthController@weibo');
// 引导用户到新浪微博的登录授权页面
    Route::get('callback', 'AuthController@callback');


    //修改密码
    Route::any('updadd','Login\LoginController@updadd');
    Route::get('update','Login\LoginController@update');
    //退出
    Route::any('loginout','Login\LoginController@loginout');
});
//后台模块
Route::prefix('/admin')->group(function(){
	//后台首页
	Route::get('index','Admin\AdminController@index');
	//后台登录
    Route::get('log','Admin\LoginController@Log');
    Route::post('logininfo','Admin\LoginController@Logininfo');
    //退出
    Route::get('out','Admin\LoginController@out');
    //后台注册
	Route::get('reg','Admin\LoginController@reg');
    Route::post('loginadd','Admin\LoginController@Loginadd');
    //注册信息
    Route::get('reglist','Admin\LoginController@reglist');
    Route::post('reginfo','Admin\LoginController@reginfo');
});

