<?php

namespace App\Http\Controllers\Home;


use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Links;
use App\Http\Model\Navs;

class IndexController extends CommonController
{
    public function index()
    {
        //最高推薦的6篇文章
        $pics = Article::orderBy('art_view' , 'desc') -> take(6) -> get();

        //圖文列表5篇(帶分頁效果)
        $data = Article::orderBy('art_time' , 'desc') -> paginate(5);

        //友情鏈接
        $links = Links::orderBy('link_order' , 'asc') -> get();


        return view('home.index' , compact('pics' ,'data' , 'links'));
    }

    public function cate($cate_id)
    {
        //圖文列表4篇(帶分頁效果)
        $data = Article::where('cate_id' , $cate_id) -> orderBy('art_time' , 'desc') -> paginate(4);

        //當前分類的子分類
        $submenu = Category::where('cate_pid' , $cate_id) ->get();

        $field = Category::find($cate_id);
        return view('home.list' , compact('field' , 'data' , 'submenu'));
    }

    public function article($art_id)
    {
        $field = Article::Join('category' , 'article.cate_id' , '=' ,'category.cate_id') -> where('art_id',$art_id) -> first();
        return view('home.new' , compact('field'));
    }
}
