<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 后台模块类
 * class AdminController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Admin
 * @date 2019-08-08
 */
class AdminController extends Controller
{
	/**
	 * [后台主页]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function index(Request $request)
    {
//		session(['teacher_id'=>1]);
    	// echo 111;
		//渲染视图
		$teacher_id=session('teacher_id');
//		 echo $teacher_id;exit;
        if(empty($teacher_id)){
           return redirect('admin/Log');
        }
    	return view('admin/index');
    }
}
