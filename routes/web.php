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
	//后台教师管理
	Route::get('Tacher','Admin\TacherController@index');
	//后台教师审核通过
	Route::post('TacherAudit','Admin\TacherController@TeAudit');
	//后台教师不通过
	Route::post('TacherNoAudit','Admin\TacherController@TeNoAudit');
	//教师删除
	Route::get('teacherDel','Admin\TacherController@teacherDel');
	//课程分类添加父类parent_id
	Route::get('Parent_Cart_Add','Admin\CartController@Parent_Cart_Add');
	//课程父类添加执行
	Route::post('Parent_Cart_Add_Do','Admin\CartController@Parent_Cart_Add_Do');
	//课程分类父类展示
	Route::get('Parent_Cart_List','Admin\CartController@Parent_Cart_List');
	//课程子类添加
	Route::get('Subclass_Cart_Add','Admin\CartController@Subclass_Cart_Add');
	//课程子类添加执行
	Route::post('Subclass_Cart_Do','Admin\CartController@Subclass_Cart_Do');
     //课程分类展示删除
	Route::post('CateDel','Admin\CartController@CateDel');
	//咨询
    Route::get('ConsultAdd','Admin\ConsultController@Consult_Add');
    //咨询 添加入库
    Route::post('ConsultDO','Admin\ConsultController@ConsultDO');
    //咨询展示
    Route::get('Consult_List','Admin\ConsultController@Consult_List');
    //咨询删除 ConsultDel
    Route::get('ConsultDel','Admin\ConsultController@ConsultDel');
});

