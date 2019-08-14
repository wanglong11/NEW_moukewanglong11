<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class TacherController extends Controller
{
    /**
     * 后台教师展示 展示是否通过审核
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/8/9 0009
     * Time: 20:29
     */
    public function index(){
        //echo 111;
      $teachInfo=\DB::table('teacher')->get();
        //dd($teachInfo);
        return view('admin/teacher',compact('teachInfo'));
    }
    /**
     * 检测教师审核通过
     */
    public function TeAudit(Request $request){
        $teacher_id=$request->post('teacher_id');
        $data=\DB::table('teacher')->where(['teacher_id'=>$teacher_id])->update(['status'=>2]);
        if($data){
            $request=[
                'code'=>1,
                'font'=>'审核通过'
            ];
            echo  json_encode($request);
        }

    }
    /**
     * 判断教师审核不通过
     */
    public function TeNoAudit(Request $request){
        $teacher_id=$request->post('teacher_id');
        $data=\DB::table('teacher')->where(['teacher_id'=>$teacher_id])->update(['status'=>1]);
        if($data){
            $request=[
                'code'=>1,
                'font'=>'该操作成功'
            ];
            echo  json_encode($request);
        }

    }
    /**
     * 教师删除
     */
    public function teacherDel(Request $request){
        $teacher_id=$request->get('teacher_id');
        $where=[
            'teacher_id'=>$teacher_id,

        ];
        $res=\DB::table('teacher')->where($where)->delete();
        if($res){
            header("Refresh:2,url=/admin/Tacher");
            die("删除成功,2秒后自动跳回页面");
        }else{

        }
    }
}
