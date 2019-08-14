<?php

namespace App\Http\Controllers\Section;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Redis;
use Storage;

class SectionController extends Controller
{
    public function lesson(Request $request){
        // session_start();
        // $session_id=session_id();
        // Redis::set('session:teacher_id',$session_id);
        // // echo $session_id;exit;
        //  session_id($session_id);
        // $_SESSION['teacher_id']=1;

        // session(['teacher_id'=>11]);
        // echo $_SESSION['teacher_id'];exit;
        // $request->session()->put('key1','value1',time()+100);
        // echo $request->session()->get('key1');exit;  
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $catedata=DB::Table('lesson_cate')->get();
        $data=json_decode(json_encode($catedata),true);
        // print_R($data);exit;
        $cateinfo=$this->getcateInfo($data);
        // print_R($cateinfo);exit;
        return view('section.lessonadd',['cateinfo'=>$cateinfo]);
    }
    //递归
    public function getcateInfo($data,$parent_id=0,$lever=1){
        static $info=[];
        foreach($data as $v){
            if($v['parent_id']==$parent_id){
                $v['lever']=$lever;
                $info[]=$v;
                $this->getCateInfo($data,$v['cate_id'],$v['lever']+1);
            }
        }
        return $info;
    }
    public function lessonadd(Request $request){
        // $session=Redis::get('session:teacher_id');
        // session_id($session);
        // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $data=$request->input();
        $file=$this->upload($request,'filename');
        $sectiondata=DB::Table('lesson')->where('lesson_name',$data['lesson_name'])->first();
        if(empty($sectiondata)){
            $data['teacher_id']=$teacher_id;
            $data['class_hour']=0;
            $data['class_time']=0;
            $data['student_count']=0;
            $data['c_time']=time();
            $data['u_time']=time();
            $data['lesson_img']=$file;
            // print_R($data);
            // echo $teacher_id;exit;
            $res=DB::Table('lesson')->insert($data);
            if($res){
                echo '课程添加成功，请添加文章';
                header('Refresh:1,url=/admin/section');
            }
        }else{
            return [
                'msg'=>'课程，章节，小节或课时名称已存在',
            ];
        }
    }
    public function section(Request $request){
        // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $lessondata=DB::Table('lesson')->where('teacher_id',$teacher_id)->get();
        $data=json_decode(json_encode($lessondata),true);
        // print_R($data);exit;
        return view('section.sectionadd',['lessondata'=>$data]);
    }
    public function sectionadd(Request $request){
        // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $data=$request->input();
        $sectiondata=DB::Table('lesson_dir')->where('title',$data['title'])->first();
        if(empty($sectiondata)){
            $data['c_time']=time();
            $data['u_time']=time();
            $data['parent_id']=0;
            $data['teacher_id']=$teacher_id;
            $res=DB::Table('lesson_dir')->insert($data);
            if($res){
                return [
                    'msg'=>'添加成功',
                ];
            }
        }else{
            return [
                'msg'=>'课程，章节，小节或课时名称已存在',
            ];
        }
    }
    public function subsection(Request $request){
        // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $lessondata=DB::Table('lesson')->where('teacher_id',$teacher_id)->get();
        $lesson_id=[];
        foreach($lessondata as $v){
            array_push($lesson_id,$v->lesson_id);
        }
        $dirpiddata=DB::Table('lesson_dir')->whereIn('lesson_id',$lesson_id)->where('parent_id',0)->get();
        $data=json_decode(json_encode($dirpiddata),true);
        return view('section.subsectionadd',['dirpiddata'=>$data]);
    }
    public function subsectionadd(Request $request){
                // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $data=$request->input();
        // print_R($data['dir_id']);exit;
        $sectiondata=DB::Table('lesson_dir')->where('title',$data['title'])->first();
        if(empty($sectiondata)){
            $data['c_time']=time();
            $data['u_time']=time();
            $data['parent_id']=$data['dir_id'];
            $data['teacher_id']=$teacher_id;
            unset($data['dir_id']);
            // print_R($data);exit;
            $res=DB::Table('lesson_dir')->insert($data);
            if($res){
                return [
                    'msg'=>'添加成功',
                ];
            }
        }else{
            return [
                'msg'=>'课程，章节，小节或课时名称已存在',
            ];
        }
    }
    public function hour(Request $request){
                // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $subdata=DB::Table('lesson_dir')->where('parent_id',0)->get();
        $dirpid=[];
        foreach($subdata as $v){
            array_push($dirpid,$v->dir_id);
        }
        // print_R($dirpid);exit;
        $hour_iddata=DB::Table('lesson_dir')->where('lesson_id',null)->where('describe',null)->get();
        // print_R($hour_iddata);exit;
        $hour_id=[];
        foreach($hour_iddata as $v){
            if(in_array($v->parent_id,$dirpid)){
                array_push($hour_id,$v->dir_id);
            }
        }
        // print_R($hour_id);exit;
        $dirhourdata=DB::Table('lesson_dir')->whereIn('dir_id',$hour_id)->get();
        $data=json_decode(json_encode($dirhourdata),true);
        return view('section.houradd',['hourdata'=>$data]);
    }
    public function houradd(Request $request){
                // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $data=$request->input();
        // print_R($data);exit;
        $sectiondata=DB::Table('lesson_dir')->where('title',$data['title'])->first();
        if(empty($sectiondata)){
            $data['c_time']=time();
            $data['u_time']=time();
            $data['parent_id']=$data['dir_id'];
            $data['teacher_id']=$teacher_id;
            unset($data['dir_id']);
            // print_R($data);exit;
            $res=DB::Table('lesson_dir')->insert($data);
            $da=DB::Table('lesson_dir')->orderBy('dir_id','desc')->first();
            // echo $dir_id;exit;
            $file=$this->audio($request,'audio');
            // echo $file;exit;
            $arr=[
                'dir_id'=>$da->dir_id,
                'src'=>$file,
                'data_name'=>$da->title,
                'c_time'=>time()
            ];
            $res=DB::Table('lesson_data')->insert($arr);
            if($res){
                echo '课时添加成功';
                header('Refresh:1,url=/admin/sectiondata');
                
            }
        }else{
            return [
                'msg'=>'课程，章节，小节或课时名称已存在',
            ];
        }
    }
    public function upload(Request $request){
        if ($request->isMethod('POST')) { //判断是否是POST上传，应该不会有人用get吧，恩，不会的
 
    		//在源生的php代码中是使用$_FILE来查看上传文件的属性
    		//但是在laravel里面有更好的封装好的方法，就是下面这个
    		//显示的属性更多
    		$fileCharater = $request->file('filename');
            // print_R($fileCharater);exit;
    		if ($fileCharater->isValid()) { //括号里面的是必须加的哦
    			//如果括号里面的不加上的话，下面的方法也无法调用的
 
    			//获取文件的扩展名 
    			$ext = $fileCharater->getClientOriginalExtension();
 
    			//获取文件的绝对路径
                $path = $fileCharater->getRealPath();
 
    			//定义文件名
    			$filename = date('Y-m-d-h-i-s').'.'.$ext;
                
    			//存储文件。disk里面的public。总的来说，就是调用disk模块里的public配置
    			Storage::disk('img')->put($filename, file_get_contents($path));
    		}
        } 
        return $filename;
    }
    public function audio(Request $request){

        if ($request->hasFile('audio')) {

            $file = $request->file('audio'); // 获取上传的文件
            
            // 获取文件相关信息

            $originalName = $file->getClientOriginalName(); // 文件原名
            // echo $originalName;exit;
            $realPath = $file->getRealPath(); //临时文件的绝对路径
            
            Storage::disk('audio')->put($originalName, file_get_contents($realPath)); // 文件名称 ， 内容
            return $originalName;
            // return response(['message' => '上传成功', 'url' => '/uploads/audio/'.$originalName], 201);

        } else {
            // return response(['message' => '请重新上传'], 400);
            echo 1;
        }
    }
    public function getcateson2($data,$parent_id=0,$lever=1){
        static $info=[];
        foreach($data as $v){
            if($v['parent_id']==$parent_id){
                $v['lever']=$lever;
                $info[]=$v;
                $this->getcateson2($data,$v['dir_id'],$v['lever']+1);
            }
        }
        return $info;
    }
    //章节课时查询
    public function sectiondata(){
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $data=DB::Table('lesson_dir')->where('teacher_id',$teacher_id)->get();
        $data=json_decode(json_encode($data),true);
        $arr=$this->getcateson2($data);
        // print_R($arr);exit;
        foreach($arr as $k=>$v){
            $lesson_name=DB::Table('lesson')->where('lesson_id',$v['lesson_id'])->where('teacher_id',$teacher_id)->first();
            $lesson_name=json_decode(json_encode($lesson_name),true)['lesson_name'];
            $arr[$k]['lesson_name']=$lesson_name;
        }
        // print_R($arr);exit;
        return view('section.sectiondata',['arr'=>$arr]);
    }
    //删除
    public function sectiondel(Request $request){
        $dir_id=$request->input('dir_id');
        //子类
        $where=[
            'parent_id'=>$dir_id
        ];
        $count=DB::table('lesson_dir')->where($where)->count();
        // echo $count;exit;
        if($count>0){
            return [
                'status'=>403,
                'msg'=>'此分类下有子类,不能删除'
            ];
        }
        //商品
        $gwhere=[
            'dir_id'=>$dir_id
        ];
        $count=DB::table('lesson_data')->where($gwhere)->count();
        // echo $count;exit;
        if($count>0){
            return [
                'status'=>403,
                'msg'=>'此分类下有商品,不能删除'
            ];
        }
        //删除
        $res=DB::table('lesson_dir')->where($gwhere)->delete();
        if($res){
            return [
                'status'=>200,
                'msg'=>'删除成功'
            ];
        }else{
            return [
                'status'=>404,
                'msg'=>'删除失败'
            ];
        }
    }
    //进入个人中心
    public function teacher_con(){
                // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $teadata=DB::Table('teacher')->where('teacher_id',$teacher_id)->get();
        return view('teachercon.teacherindex',['teadata'=>$teadata]);
    }
    public function teacher_img(Request $request){
                // session_start();
        // $teacher_id=$_SESSION['teacher_id'];
        $teacher_id=session('teacher_id');
        if(empty($teacher_id)){
            return redirect('admin/Log');
        }
        $data=$request->input();
        $file=$this->upload($request,'filename');
        // echo $file;
        DB::table('teacher')->where('teacher_id',$teacher_id)->update(['img'=>$file]);
        header('Refresh:0,url=/admin/teacher_con');
    }
    public function eqit(){
        session('teacher_id',null);
        return redirect('login');
    }
}
