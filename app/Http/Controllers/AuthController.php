<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Socialite;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    /**
     * 微博授权页面
     */

    public function callback(Request $request)
    {
        set_time_limit(0);
        $code = $request->code;
    dd($code);
        $url = "https://api.weibo.com/oauth2/access_token?client_id=2869939600&client_secret=
    c184ecb5b03226f897c767a467f187d8&grant_type=authorization_code&redirect_urihttp://http://www.11.com/callback&code=".$code;
        $data = $this->curl($url);
//        dd($data);


        //获取微博登陆用户的信息
        $userInfo=json_decode($data,true);
        $token = $userInfo['access_token'];
        $uid = $userInfo['uid'];
//        dd($userInfo);
        $urla="https://api.weibo.com/2/users/show.json?access_token=$token&uid=$uid";
//        dd($urla);
//        $uu = $this->curl($urla);
        $uu = file_get_contents($urla);
//        dd($uu);
        $user = json_decode($uu,true);
        $user_name = $user['screen_name'];
        $data = [
            'name'=>$user_name,
            'c_time'=>time()
        ];
        $res = DB::table('user')->insert($data);
//        dd($res);
        if($res){
            echo "<script>alert('登陆成功');location.href='/index'</script>";
        }else{
            echo "<script>alert('登录失败，请重新登陆');location.href='/login'</script>";
        }

//        dd($user);
    }

    protected function curl($url)
    {
        //curl初始化
        $curl = curl_init();
        //设置抓取的url
        curl_setopt($curl, CURLOPT_URL, $url);
        //设置头文件的信息作为数据流输出
        curl_setopt($curl, CURLOPT_HEADER, 0);
        //设置获取的信息以文件流的形式返回，而不是直接输出。
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($curl,CURLOPT_SSL_VERIFYPEER,FALSE);
        curl_setopt($curl,CURLOPT_SSL_VERIFYHOST,FALSE);
        //设置post方式提交
        curl_setopt($curl, CURLOPT_POST, 1);
        //执行命令
        $data = curl_exec($curl);
        //关闭URL请求
        curl_close($curl);
        //显示获得的数据
        return $data;
    }

}
