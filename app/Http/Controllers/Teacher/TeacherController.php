<?php

namespace App\Http\Controllers\Teacher;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\TeacherModel;
use App\Model\PosTeacherModel;
use App\Model\TeacherPosModel;
use App\Model\LessonModel;
/**
 * 讲师模块类
 * class TeacherController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Teacher
 * @date 2019-08-08
 */
class TeacherController extends Controller
{
	/**
	 * [讲师列表]
	 * @param  Request $request [description]
	 * @return [type]           [description]
	 */
    public function teacherList(Request $request)
    {
        $data=TeacherModel::where(['status'=>2])->get()->toArray();
      //  dd($data);
        if(!$data){
            $code=0;
        }else{
            $code=1;
            foreach($data as $k=>$v){
                $pos_id=PosTeacherModel::where(['teacher_id'=>$v['teacher_id']])->first()['pos_id'];
                $pos_name=TeacherPosModel::where(['pos_id'=>$pos_id])->first()['pos_name'];
                $data[$k]['pos_name']=$pos_name;
            }
        }
    	//渲染视图
    	return view('teacher/teacherlist',compact('data','code'));
    }

    /**
     * [讲师详情]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function teachercont(Request $request)
    {
        $teacher_id=$request->get('teacher_id');
        //获取讲师信息
        $data=TeacherModel::where(['teacher_id'=>$teacher_id])->first()->toArray();
        $pos_id=PosTeacherModel::where(['teacher_id'=>$teacher_id])->first()['pos_id'];
        $data['pos_name']=TeacherPosModel::where(['pos_id'=>$pos_id])->first()['pos_name'];
        //获取讲师课程
        $course=LessonModel::where(['teacher_id'=>$teacher_id,'status'=>2])->get()->toArray();
        if(empty($course)){
            $code=0;
        }else{
            $code=1;
        }
    	//渲染视图
    	return view('teacher/teachercont',compact('data','course','code'));
    }
}
