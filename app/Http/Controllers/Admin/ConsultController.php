<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ConsultController extends Controller
{
    /**
     * Created by PhpStorm.
     * User: 杜甫
     * Date: 2019/8/13 0013
     * Time: 16:31
     */
    /**
     *后台咨询添加页面
     */
    public function Consult_Add(){
        return view('admin/News');
    }

    /**
     * @param Request $request
     * 后台添加
     */
    public function  ConsultDO(Request $request){
        $date=$request->all();
       // dd($date);
        //将信息入库
        $data=[
            'title'=>$date['title'],
            'content'=>$date['content'],
           // 'is_hot'=>$date['is_hot'],
            'c_time'=>time()
        ];
        $arr=\DB::table('news')->insertGetId($data);
        if($arr){
            header("Refresh:2,url=/admin/Consult_List");
            die("添加成功,2秒后自动跳到展示页面");
        }else{

        }
    }
    /**
     * 咨询展示
     */
    public function Consult_List(){
        $arr=\DB::table('news')->where(['is_del'=>1])->get()->map(function ($value) {
            return (array)$value;
        })->toArray();
        return view('admin/ConsultList',compact('arr'));
    }
    /**
     * 咨询删除
     */
    public function ConsultDel(Request $request){
        $id=$request->get('id');
        //修改状态
        $date=\DB::table('news')->where(['id'=>$id])->update(['is_del'=>2]);
        if($date){
            header("Refresh:2,url=/admin/Consult_List");
            die("删除成功,2秒后自动跳到展示页面");
        }else{

        }
    }

}
