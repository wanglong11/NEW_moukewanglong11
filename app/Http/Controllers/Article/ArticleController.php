<?php

namespace App\Http\Controllers\Article;

use App\Model\Lesson;
use App\Model\News;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
/**
 * 资讯模块类
 * class ArticleController
 * @author   <[<gaojianbo>]>
 * @package  App\Http\Controllers\Article
 * @date 2019-08-08
 */
class ArticleController extends Controller
{
	/**
	 * [资讯列表]
	 * @return [type] [description]
	 */
    public function articleList(Request $request)
    {

        //查询全部咨询
        $news = News::where(['is_del'=>1])->paginate(2);

        //热门咨讯
        $hot = $this->_articleDetail(2);

        //推荐课程
        $lesson = $this->_randLesson(2);

//        dd($lesson);
    	//渲染视图
    	return view('article/articlelist',compact('news','hot','lesson'));
    }

    /**
     * [资讯详情]
     * @param  Request $request [description]
     * @return [type]           [description]
     */
    public function articlecont(Request $request,$id)
    {
        $newsDetail = News::where(['id'=>$id,'is_del'=>1])->first()->toArray();
        if (!$newsDetail){
            echo "<script>alert('该咨询不存在');location.href-='/article/articlelist'</script>";
        }

        //热门咨讯
        $hot = $this->_articleDetail(6);
//        dd($newsDetail);

        //推荐课程
        $lesson = $this->_randLesson(3);

        //渲染视图
    	return view('article/articlecont',compact('newsDetail','hot','lesson'));
    }

    /**
     * 随机获取热点咨讯
     * @param $num
     * @return mixed
     */
    private function _articleDetail($num){
//        $newshot = News::where(['is_del'=>1,'is_hot'=>1])->limit($num)->get()->toArray();
        $info = News::where(['is_del'=>1,'is_hot'=>1])->inRandomOrder()->take($num)->get()->toArray();
        return $info;
    }

    /**
     * 相关课程随机获取六条
     * @return mixed
     */
    private function _randLesson($num){
        $info = Lesson::inRandomOrder()->take($num)->get()->toArray();
        return $info;
    }
}
