<?php

namespace App\Http\Controllers\Login;

use App\login\RegisterModel;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
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


    /**邮箱发送验证码 */
    public function code()
    {
        $code = rand('123456','789999');
        //实例化PHPMailer核心类
        $mail = new PHPMailer;
        //是否启用smtp的debug进行调试 开发环境建议开启 生产环境注释掉即可 默认关闭debug调试模式
        $mail->SMTPDebug = 0;

        //使用smtp鉴权方式发送邮件
        $mail->isSMTP();

        //smtp需要鉴权 这个必须是true
        $mail->SMTPAuth = true;

        //链接qq域名邮箱的服务器地址
        $mail->Host = 'smtp.163.com';//163邮箱：smtp.163.com

        //设置使用ssl加密方式登录鉴权
        $mail->SMTPSecure = 'ssl';//163邮箱就注释

        //设置ssl连接smtp服务器的远程服务器端口号，以前的默认是25，但是现在新的好像已经不可用了 可选465或587
        $mail->Port = 465;//163邮箱：25

        //设置smtp的helo消息头 这个可有可无 内容任意
        // $mail->Helo = 'Hello smtp.qq.com Server';

        //设置发件人的主机域 可有可无 默认为localhost 内容任意，建议使用你的域名
        //$mail->Hostname = 'http://localhost/';

        //设置发送的邮件的编码 可选GB2312 我喜欢utf-8 据说utf8在某些客户端收信下会乱码
        $mail->CharSet = 'UTF-8';

        //设置发件人姓名（昵称） 任意内容，显示在收件人邮件的发件人邮箱地址前的发件人姓名
        $mail->FromName = '美妮';

        //smtp登录的账号 这里填入字符串格式的qq号即可
        $mail->Username = '16605305425@163.com';

        //smtp登录的密码 使用生成的授权码（就刚才叫你保存的最新的授权码）
        $mail->Password = 'admin123456';//163邮箱也有授权码 进入163邮箱帐号获取

        //设置发件人邮箱地址 这里填入上述提到的“发件人邮箱”
        $mail->From = '16605305425@163.com';

        //邮件正文是否为html编码 注意此处是一个方法 不再是属性 true或false
        $mail->isHTML(true);
        //设置收件人邮箱地址 该方法有两个参数 第一个参数为收件人邮箱地址 第二参数为给该地址设置的昵称 不同的邮箱系统会自动进行处理变动 这里第二个参数的意义不大
        $mail->addAddress("2207688601@qq.com");

        //添加多个收件人 则多次调用方法即可
        // $mail->addAddress('xxx@163.com','爱代码，爱生活世界');

        //添加该邮件的主题
        $mail->Subject = '验证成功';

        //添加邮件正文 上方将isHTML设置成了true，则可以是完整的html字符串 如：使用file_get_contents函数读取本地的html文件
        $mail->Body = "验证码为:'$code',五分钟内有效";

        //为该邮件添加附件 该方法也有两个参数 第一个参数为附件存放的目录（相对目录、或绝对目录均可） 第二参数为在邮件附件中该附件的名称
        // $mail->addAttachment('./d.jpg','mm.jpg');
        //同样该方法可以多次调用 上传多个附件
        // $mail->addAttachment('./Jlib-1.1.0.js','Jlib.js');

        $status = $mail->send();
        cache(['code'=>$code],60*5);
        //简单的判断与提示信息
        if ($status) {
            return 1;
        } else {
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
