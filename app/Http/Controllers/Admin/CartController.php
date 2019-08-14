<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    /**
     *后台课程父类添加
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/8/10 0010
     * Time: 11:26
     */
    public function Parent_Cart_Add(){
        return view('admin/ParentAdd');
    }
    /**
     * 课程父类添加执行
     */
    public function Parent_Cart_Add_Do(Request $request){
        $data=$request->all();
        //dd($data);
        $cate_name=$data['cart_name'];
        $arr=\DB::table('lesson_cate')->insertGetId(['cate_name'=>$cate_name,'parent_id'=>0]);
        if($arr){
            header("Refresh:2,url=/admin/Parent_Cart_List");
            die("添加成功,2秒后自动跳到展示页面");
        }else{

        }

    }
    /*
     * 课程展示分类展示
     */
    public function Parent_Cart_List(){
        $arr=\DB::table('lesson_cate')->get()->map(function ($value) {
            return (array)$value;
        })->toArray();
        $str=$this->getSubTree($arr);
        return view('admin/subclassList',compact('str'));
    }
    /**
     * 获取子类
     */
    function getSubTree($data , $id = 0 , $lev = 0) {
        static $son = array();
        foreach($data as $key => $value) {
            if($value['parent_id'] == $id) {
                $value['lev'] = $lev;
                $son[] = $value;
                $this->getSubTree($data , $value['cate_id'] , $lev+1);
            }
        }

        return $son;
    }
    /**
     * 子类添加
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/8/10 0010
     * Time: 14:09
     */
    public function Subclass_Cart_Add(){
        $arr=\DB::table('lesson_cate')->where(['parent_id'=>0])->get()->map(function ($value) {
            return (array)$value;
        })->toArray();
       return view('admin/subclassAdd',compact('arr'));

    }
    /**
     * 子类添加执行
     */
    public function Subclass_Cart_Do(Request$request){
        $data=$request->all();
        $arr=\DB::table('lesson_cate')->insertGetId(['cate_name'=>$data['cart_name'],'parent_id'=>$data['interest']]);
        if($arr){
            header("Refresh:2,url=/admin/Parent_Cart_List");
            die("添加成功,2秒后自动跳到展示页面");
        }else{

        }
    }
    /**
     * 课程子类删除
     */
    public function CateDel(Request$request){
        $cate_id=$request->post('cate_id');
        //根据传递过来的cate_id判断有没有子类  有的不让删除  没有就删除
        $where=[
            'parent_id'=>$cate_id,
        ];
        $arr=\DB::table('lesson_cate')->where($where)->first();
        //dd($arr);
         if($arr==''){
             $data=\DB::table('lesson_cate')->where(['cate_id'=>$cate_id])->delete();
             if($data){
                 $request=[
                     'code'=>0,
                     'font'=>'删除成功'
                 ];
                return   json_encode($request);
             }


         }else{
             $request=[
                 'code'=>1,
                 'font'=>'该父类下面不能删除'
             ];
             return  json_encode($request);
        }


    }
}
