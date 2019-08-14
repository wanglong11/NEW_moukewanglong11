<?php

namespace App\Http\Controllers\Curr;

use App\Model\Collection;
use App\Model\Lesson;
use App\Model\LessonAsk;
use App\Model\LessonAskDetail;
use App\Model\LessonCate;
use App\Model\LessonData;
use App\Model\LessonDir;
use App\Model\LessonEvaluate;
use App\Model\LessonFile;
use App\Model\LessonNotice;
use App\Model\PosTeacher;
use App\Model\StudentLesson;
use App\Model\Teacher;
use App\Model\TeacherPos;
use App\Model\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 课程模块类
 * class CurrController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Curr
 * @date 2019-08-08
 */
class CurrController extends Controller
{
	/**
	 * [课程列表]
	 * @return [type] [description]
	 */
    public function currList(Request $request,$id=0)
    {
        $lesson_name = $request->lesson_name;
        //从数据库中获取左侧全部分类
        $lesson = LessonCate::where('parent_id',0)->get()->toArray();
        $arr = [];
        foreach ($lesson as $k=>$v){
            $arr[$k]['parent']=$v['cate_name'];
            $arr[$k]['data'] = LessonCate::where('parent_id',$v['cate_id'])->get()->toArray();
//            dd($arr);
        }
        //全部分类的第一个分类id，用于展示页面的右侧的默认展示该分类下的课程
        $first_id = $arr[0]['data'][0]['cate_id'];

//        dd($where);
        //根据左侧传来的课程id获取右侧的数据
        if ($id == 0){
            $num = 0;
            //搜索
            if($lesson_name){
                $rightInfo = Lesson::where('lesson_name','like',"%$lesson_name%")->where('status',1)->get()->toArray();
            }else{
                $rightInfo = Lesson::where(['status'=>1,'cate_id'=>$first_id])->get()->toArray();
            }
        }else{
            $num = $id;
            $rightInfo = Lesson::where(['status'=>1,'cate_id'=>$id])->where('lesson_name','like',"%$lesson_name%")->get()->toArray();
        }
//        dd($rightInfo);
    	//渲染模版
    	return view('curr/currlist',compact('arr','num','rightInfo'));
    }

    /**
     * [课程内容]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function currcont(Request $request,$lesson_id)
    {
        //  Lesson  Lesson_dir
        //调用方法
        $info = $this->_info($lesson_id);
        list($detailInfo,$teacherInfo,$lessondir) = $info;

        //根据讲师id获取定位
        $pos_name = $this->_posById($teacherInfo['teacher_id']);

        //相关课程
        $randLesson = $this->_randLesson();

        //课程公告
        $noticeInfo = LessonNotice::where(['lesson_id'=>$lesson_id])->get()->toArray();

        //查看该用户是否收藏该课程
        $user_id = 1;
        $isCollection = Collection::where(['user_id'=>$user_id,'lesson_id'=>$lesson_id,'status'=>1])->first();

        if ($isCollection){
            $isCollection = 1;
        }else{
            $isCollection = 2;
        }
//        var_dump($teacherInfo,$noticeInfo);
    	//渲染模版
    	return view('curr/currcont',compact('detailInfo','lessondir','teacherInfo','noticeInfo','pos_name','randLesson','isCollection'));
    }


   private function _aaa($lessonDir,$dir_id){
        static $arr = [];
        foreach ($lessonDir as $k=>$v){
            if($v['pid'] == $dir_id){
                foreach ($lessonDir as $kk=>$vv){
                    if ($v['dir_id'] == $vv['pid']){
                        $vv['src'] = LessonFile::where(['dir_id'=>$vv['dir_id']])->select('src')->first()['src'];
                        $v['data'][] = $vv;
                    }
                }
//                var_dump($v);
                $arr[$v['pid']][] = $v;
            }
        }
      return $arr;
    }

//    private function _aaa($lessonDir,$dir_id){
//        $tree = [];
//        foreach ($lessonDir as $k=>$v){
//            if ($v['pid'] == $dir_id){
//                $v['son'] = $this->_aaa($lessonDir,$v['dir_id']);
//                if ($v['son'] == null){
//                    unset($v['son']);
//                }
//                $tree[] = $v;
//            }
//        }
//        dd($tree);
////        return $tree;
//    }

    /**
     * [章节列表]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function chapterlist(Request $request,$lesson_id)
    {
        //调用方法
        $info = $this->_info($lesson_id);
        list($detailInfo,$teacherInfo,$lessondir) = $info;

        $lessonDir = LessonDir::get()->toArray();
        foreach ($lessondir as $k=>$v){
            $arr = $this->_aaa($lessonDir,$v['dir_id']);
        }
//        var_dump($arr);die;
//
        //根据讲师id获取定位
        $pos_name = $this->_posById($teacherInfo['teacher_id']);

        //获取该课程的最新学员
            //查询当前课程、讲师的学员
        $student = StudentLesson::where(['lesson_id'=>$lesson_id,'teacher_id'=>$teacherInfo['teacher_id']])->get()->toArray();
            //查询学员的信息
        $studentInfo = User::where('status',1)->get()->toArray();
        $student_info = [];
        foreach ($student as $k=>$v){
            foreach ($studentInfo as $kk=>$vv){
                if($v['user_id'] == $vv['user_id']){
                    $student_info[] = $vv;
                }
            }
        }

        //相关课程
        $randLesson = $this->_randLesson();

        //获取评论
        $evluate = LessonEvaluate::where(['lesson_id'=>$lesson_id])->orderBy('c_time','desc')->limit(3)->get()->toArray();
        $evluates=[];
        foreach ($evluate as $k=>$v) {
            foreach ($studentInfo as $kk=>$vv){
                if($v['user_id'] == $vv['user_id']){
                    $evluates[$k]['name'] = $vv['name'];
                    $evluates[$k]['img'] = $vv['img'];
                    $evluates[$k]['content'] = $v['content'];
                    $evluates[$k]['c_time'] = $v['c_time'];
                }
            }
        }
        //获取回答
        $ask = LessonAsk::where(['lesson_id'=>$lesson_id])->orderBy('c_time','desc')->limit(3)->get()->toArray();
        $asks=[];
        foreach ($ask as $k=>$v) {
            foreach ($studentInfo as $kk=>$vv){
                if($v['user_id'] == $vv['user_id']){
                    $asks[$k]['name'] = $vv['name'];
                    $asks[$k]['img'] = $vv['img'];
                    $asks[$k]['content'] = $v['content'];
                    $asks[$k]['c_time'] = $v['c_time'];
                    $asks[$k]['look_num'] = $v['look_num'];
                    $asks[$k]['reply_num'] = $v['reply_num'];
                }
            }
        }


        //获取该课程下的资料
        $lessonData = LessonData::get()->toArray();
        $lessonDatas = [];
        foreach($lessondir as $k=>$v){
            foreach ($lessonData as $kk=>$vv){
                if($v['dir_id'] == $vv['dir_id']){
                    $lessonDatas[] = $vv;
                }
            }
        }
//        dd($asks);
//        //根据章节id获取章节下的小节和课时


////die;
    	//渲染模版
        //
    	return view('curr/chapterlist',compact('arr','detailInfo','teacherInfo','lessondir','pos_name','student_info','randLesson','evluates','asks','lessonDatas'));
    }


    /**
     * [开始学习]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function video(Request $request)
    {
        //渲染模版
        return view('curr/video');
    }

    /**
     * 获取上面的数据 【加入学习上面的】 该课程的讲师
     */
    private function _info($lesson_id)
    {
        //获取上面的数据 【加入学习上面的】
        $detailInfo = Lesson::where(['status'=>1,'lesson_id'=>$lesson_id])->first();
        $detailInfo = json_decode(json_encode($detailInfo),true);

        if(empty($detailInfo)){
            echo "<script>alert('该课程暂不存在');location.href='".$_SERVER['HTTP_REFERER']."'</script>";
        }

        //获取该课程的讲师
        $teacherInfo =Teacher::where(['teacher_id'=>$detailInfo['teacher_id']])->first();
        $teacherInfo = json_decode(json_encode($teacherInfo),true);

        //获取课程目录的内容
        $lessondir = LessonDir::where(['lesson_id'=>$lesson_id])->get()->toArray();

        return [$detailInfo,$teacherInfo,$lessondir];


    }

    /**
     * 收藏课程
     * @param $lesson_id
     * @return int
     */
    public function collect($lesson_id)
    {

        //获取当前用户id
        $user_id = 1;
        $res = Collection::insert(['lesson_id'=>$lesson_id,'user_id'=>$user_id,'c_time'=>time()]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * 取消收藏课程
     * @param $lesson_id
     * @return int
     */
    public function nocollect($lesson_id)
    {

        //获取当前用户id
        $user_id = 1;
        $res = Collection::where(['user_id'=>$user_id,'lesson_id'=>$lesson_id])->update(['status'=>2]);
        if($res){
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * 评论
     * @param $lesson_id
     * @return int
     */
    public function evaluate($lesson_id)
    {
        $user_id = 1;
        $data = \request()->post();
        $data['user_id'] = $user_id;
        $data['lesson_id'] = $lesson_id;
        $data['c_time'] = time();
        $res = LessonEvaluate::insert($data);
        if ($res){
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * 问答
     * @param $lesson_id
     * @return int
     */
    public function ask($lesson_id)
    {
        $user_id = 1;
        $data = \request()->post();
        $data['user_id'] = $user_id;
        $data['lesson_id'] = $lesson_id;
        $data['c_time'] = time();
        $res = LessonAsk::insert($data);
        if ($res){
            return 1;
        }else{
            return 2;
        }
    }

    /**
     * 根据章节id获取章节下的小节和课时
     */
    private function _getInfoBydirId($lessonAllDir,$dir_id){

    }

    /**
     * 根据讲师id获取定位
     * @param $teacher_id
     * @return mixed
     */
    private function _posById($teacher_id){
        $posteacher = PosTeacher::where('teacher_id',$teacher_id)->first();

        $posteacher = json_decode(json_encode($posteacher),true);

        $posname = TeacherPos::where('pos_id',$posteacher['pos_id'])->first('pos_name');

        $posname = json_decode(json_encode($posname),true);

        return $posname['pos_name'];

    }

    /**
     * 相关课程随机获取六条
     * @return mixed
     */
    private function _randLesson(){
        $info = Lesson::inRandomOrder()->take(3)->get()->toArray();
        return $info;
    }
}
