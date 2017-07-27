<?php

namespace App\Http\Controllers\Home;


use App\Http\Model\Article;
use App\Http\Model\Links;
use App\Http\Model\Navs;

class IndexController extends CommonController
{
    public function index()
    {
        //最高推薦的6篇文章
        $pics = Article::orderBy('art_view' , 'desc') -> take(6) -> get();

        //點擊量最高的6篇文章
        $hot = Article::orderBy('art_view' , 'desc') -> take(5) -> get();

        //圖文列表5篇(帶分頁效果)
        $data = Article::orderBy('art_time' , 'desc') -> paginate(5);

        //最新發布文章8篇
        $new = Article::orderBy('art_time' , 'desc') -> take(8) -> get();

        //友情鏈接
        $links = Links::orderBy('link_order' , 'asc') -> get();


        return view('home.index' , compact('hot' , 'pics' ,'data' , 'new' , 'links'));
    }

    public function cate()
    {
        return view('home.list');
    }

    public function article()
    {
        return view('home.new');
    }
}
