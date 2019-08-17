<?php

namespace App\Http\Controllers\Course;

use App\Model\Collection;
use App\Model\Lesson;
use App\Model\StudentLesson;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MycourseController extends Controller
{
    //个人中心首页
    public function index()
    {
        //查询当前登陆的用户信息
        $user_id = session('user_id');
        $userInfo = \App\Model\User::where('user_id',$user_id)->select('user_id','name','img')->first();

        //查询当前用户收藏的课程
        $coll = Collection::where(['user_id'=>$user_id,'status'=>1])->select('lesson_id')->get()->toArray();
        $lessonInfo = $this->_getLessonById($coll);

        //查询当前用户学习的课程
        $studentLesson = StudentLesson::where('user_id',$user_id)->select('lesson_id')->get()->toArray();
        $lessonInfos = $this->_getLessonById($studentLesson);
//        var_dump($lessonInfos);
        return view('course.courseindex',compact('userInfo','lessonInfo','lessonInfos'));
    }

    //根据课程id查询课程
    private function _getLessonById($data){
        $lessonInfos = [];
        foreach ($data as $k=>$v){
            $lessonInfos[] = Lesson::where(['lesson_id'=>$v['lesson_id'],'status'=>1])->select('lesson_id','lesson_name')->limit(1)->first();
        }
        return $lessonInfos;
    }
}
