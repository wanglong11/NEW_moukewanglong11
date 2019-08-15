<?php

namespace App\Http\Controllers\Login;

use App\login\RegisterModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

/**
 * 登录模块
 * class LoginController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Login
 * $date 2019-08-08
 */
class LoginController extends Controller
{
	/**
	 * [注册页面]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
	public function register(Request $request)
	{
		//渲染视图
		return view('login/register');
	}
	/*注册执行*/
    public function regadd(Request $request){
	    $data=$request->post();
        if(empty($data['email']) || empty($data['password']) || empty($data['name']) || empty($data['pwd'])){
            echo '内容需填写完整';
            header("refresh:1;url='register'");
        }
	    $pwd=$data['pwd'];
	    if($pwd==$data['password']){
            $arr=[
                'name'=>$data['name'],
                'password'=>encrypt($data['password']),
                'email'=>$data['email'],
                'c_time'=>time()
            ];
            $register=new RegisterModel();
            $register_info=$register->insert($arr);
            echo '注册成功';
            header("refresh:1;url='login'");
        }else{
	        echo '注册失败';
        }

    }
	/**
	 * [登录页面]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function login(Request $request)
    {
    	//渲染视图
    	return view('login/login');
    }



    /*登录执行*/
    public function loginadd(Request $request){
        $data=$request->post();
        if(empty($data['email']) || empty($data['password'])){
            echo '内容需填写完整';
            header("refresh:1;url='login'");
            die;
        }
        $date=RegisterModel::where('email',$data['email'])->orwhere('name',$data['email'])->first()->toArray();
        if($date['status'] == 2){
            echo '你的账号已锁定,详情请联系客服';
        }
        if(!$date){
            echo '用户不存在';
        }else{
            $password=decrypt($date['password']);
            $userid= $date['user_id'];
            $name= $date['name'];
            //session存ID   user_id
            session(['user_id'=>$userid,'name'=>$name]);
            if($password!=$data['password']){

                if(time()-$date['err_time'] > 7200){
                   DB::table('user')->where(['user_id'=>$userid])->update(['err_num'=>1,'err_time'=>time()]);
                }else{
                    if($date['err_num'] >= 3){
                        DB::table('user')->where(['user_id'=>$userid])->update(['status'=>2]);
                        $flushtime = ($date['err_time'] + 7200) - time();
                       echo '你的账号已锁定，请'.$flushtime.'s之后重试';
                    }else{
                        DB::table('user')->where(['user_id'=>$userid])->update(['err_num'=>$date['err_num']+1,'err_time'=>time()]);
                    }
                }
                echo '密码错误';
                header("refresh:2;url='login'");
            }else{
                if($date['err_num'] >= 3 && time()-$date['err_time'] < 7200){
                    $flushtime = ($date['err_time'] + 7200) - time();
                    echo '你的账号已锁定，请'.$flushtime.'s之后重试';
                }
                DB::table('user')->where(['user_id'=>$userid])->update(['err_num'=>0,'err_time'=>null]);
                echo '登陆成功';
                header("refresh:1;url='curr/currlist'");
            }
        }
    }
//修改用户密码
    public function update(){
            return view('login.upd');
    }
    public function updadd(Request $request){
      //接所有值
      $data =  $request->all();
//      $user_id=session('user_id');
      //接受的值
      $email=$data['email'];
      $password= $data['password'];
      $pwd= $data['pwd'];
      if(empty($email) || empty($passwords) || empty($pwd)){
          echo '没有填写完整哦！！';
      }
        $userInfo=DB::table('user')->where('email',$email)->first();
        //查询数据库密码
        $passwords=decrypt($userInfo->password);
        //邮箱id
        $user_id=$userInfo->user_id;
        if($password==$passwords){
            $where=[
                'user_id'=>$user_id,
                'password'=>$pwd,
            ];
            $arr= DB::table('user')->save($where);
            if($arr){
                echo '修改成功';
                header("refresh:1;url='login'");
            }else{
                echo '修改失败';
                header("refresh:1;url='update'");
            }
        }else{
            echo '旧密码输入错误';
            header("refresh:1;url='update'");
        }
    }




    //退出登路
    public function loginout(Request $request){
        $id=$request->session()->get('u_id');
        $request->session()->flush('key');
        return redirect('index');
    }
}
