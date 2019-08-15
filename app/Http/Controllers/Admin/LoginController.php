<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{
    /**
     * 后台注册 你要操作的是教师表 教师的登录注册
     */
    public function reg(){
        return view('admin.reg');
    }
    public function loginadd(Request $request){
        $data=$request->post();
        if(empty($data['name']) || empty($data['password'])){
            echo '不能为空';
        }
            $arr=[
                'name'=>$data['name'],
                'password'=>encrypt($data['password']),
                'c_time'=>time()
            ];
            $teacher_info=DB::table('teacher')->insert($arr);
            $arr= DB::table('teacher')->orderByDesc('teacher_id')->first();
           $teacher_id= $arr->teacher_id;
            session(['teacher_id'=>$teacher_id]);
            if($teacher_info){
                echo '注册成功';
                header("refresh:1;url='reglist'");
            }else{
                echo '失败';
            }
    }

    //注册详情
    public function reglist(){
        return view('admin/reglist');
    }
    public function reginfo(Request $request){
      $data=  $request->post();
        $teacher_id=session('teacher_id');
        $arr=DB::table('teacher')->where('teacher_id',$teacher_id)->first();
        $where=[
            'intro'=>$data['intro'],
            'style'=>$data['style']
        ];
        $info=DB::table('teacher')->where('teacher_id',$teacher_id)->update($where);
        if($info){
            echo '提交成功';
            header("refresh:1;url='log'");
        }else{
            echo '提交失败';
        }


    }


    /**
     * 后台 登录
     */
    public function Log(){
        return view('admin.login');
    }
    public function logininfo(Request $request){
        $data=$request->post();
//        dd($data);
        if(empty($data['name']) || empty($data['password'])){
            echo '内容需填写完整';
            header("refresh:1;url='log'");
        }
        $arr=DB::table('teacher')->where('name',$data['name'])->first();
        $password=decrypt($arr->password);
        $teacher_id= $arr->teacher_id;
        $name= $arr->name;
        //session存ID   user_id
        session(['teacher_id'=>$teacher_id,'names'=>$name]);
        if($password!=$data['password']) {
            echo '密码错误';
            header("refresh:1;url='log'");
            die;
        }
        $arr=DB::table('teacher')->where(['teacher_id'=>$teacher_id])->get();
        if($arr){
            echo '登陆成功';
            session(['teacher_id'=>$teacher_id],time()+24*60*60);
            header("refresh:1;url='index'");
        }else{
            echo '失败';
            header("refresh:1;url='log'");
        }
    }

    //退出登路
    public function out(Request $request){
        $id=$request->session()->get('teacher_id');
        $request->session()->flush('key');
        return redirect('admin/log');
    }
}
