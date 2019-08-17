<?php

namespace App\Http\Controllers\Login;

use App\login\RegisterModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;
use PHPMailer\PHPMailer\PHPMailer;
use Illuminate\Support\Facades\Cache;
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
           // echo '内容需填写完整';
            //header("refresh:1;url='register'");
            header("Refresh:2,url=register");
            die("内容需填写完整");
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
        //dd($data);
        if(empty($data['email']) || empty($data['password'])){
            echo '内容需填写完整';
            header("refresh:1;url='login'");
            die;
        }
        $date=RegisterModel::where('email',$data['email'])->orwhere('name',$data['email'])->first();
        //dd($date);
        if($date==''){
            echo "该用户名或者密码不正确，请重新输入";die;
        }
        if($date->status == 2){
            echo '你的账号已锁定,详情请联系客服';die;
        }
        if(!$date){
            echo '用户不存在';die;
        }else{
            $password=decrypt($date->password);

            //dd($password);
            $userid= $date->user_id;
            //dd($userid);
            $name= $date->name;
            //session存ID   user_id
            //dd($date->password);
            session(['user_id'=>$userid,'name'=>$name]);
            if($password!=$data['password']){

                if(time()-$date->err_time > 7200){
                   DB::table('user')->where(['user_id'=>$userid])->update(['err_num'=>1,'err_time'=>time()]);
                }else{
                    if($date->err_num >= 3){
                        DB::table('user')->where(['user_id'=>$userid])->update(['status'=>2]);
                        $flushtime = ($date->err_time + 7200) - time();
                       echo '你的账号已锁定，请'.$flushtime.'s之后重试';die;
                    }else{
                        DB::table('user')->where(['user_id'=>$userid])->update(['err_num'=>$date->err_num+1,'err_time'=>time()]);
                    }
                }
                echo '密码不对';
                header("refresh:2;url='login'");
            }else{
                if($date->err_num >= 3 && time()-$date->err_time < 7200){
                    $flushtime = ($date->err_time + 7200) - time();
                    echo '你的账号已锁定，请'.$flushtime.'s之后重试';die;
                }
                DB::table('user')->where(['user_id'=>$userid])->update(['err_num'=>0,'err_time'=>null]);
                echo '登陆成功';
                header("refresh:1;url='curr/currlist'");
            }
        }
    }
//通过邮箱验证
    public function update(){
        return view('login.upd');
    }
    public function updadd(Request $request){
      //接所有值
        $code =  $request->code;
        $email =  $request->email;
        $codes= cache('code');
        $arr=DB::table('user')->where(['email'=>$email])->first();
        if($arr==''){
            echo "<script>alert('此用户不存在');</script>";
        }
        $user_id=$arr->user_id;
//        var_dump($code,$codes);die;
        session(['user_id'=>$user_id]);
      if($code != $codes){
          echo "<script>alert('验证码错误');</script>";
      }else{
          echo "<script>alert('验证成功');location.href='updlist'</script>";
      }
    }
    //修改密码
    public function updlist(){
        return view('login.updlist');
    }
    //执行
    public function upds(Request $request){
        $password=$request->password;
        $pwd=$request->pwd;
        if($pwd==$password){
            $user_id=session('user_id');
            $where=[
                'password'=>encrypt($password),
                'u_time'=>time()
            ];
            $arr=DB::table('user')->where([ 'user_id'=>$user_id])->update($where);
            if($arr){
                echo "<script>alert('修改成功');location.href='login'</script>";
            }
        }else{
            echo "<script>alert('修改失败');</script>";
        }
    }

    public function code(){
        $email = \request()->email;
        $rand=rand(100000,999999);
        if($email){
            Mail::send('login.emailcode',['code'=>$rand],function($message)use($email) {
                //设置主题
                $message->subject("邮箱忘记密码验证码");
                //设置接收方
                $message->to($email);
            });
            cache(['code'=>$rand],60*5);
            return 1;
        }else{
            return 2;
        }
    }

    //退出登路
    public function loginout(Request $request){
        $id=$request->session()->get('u_id');
        $request->session()->flush('key');
        return redirect('index');
    }
}
