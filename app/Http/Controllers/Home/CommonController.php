<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Model\Navs;
use Illuminate\Support\Facades\View;

class CommonController extends Controller
{
    //先加載自定義導航到所有視圖頁面
    public function __construct()
    {
        //點擊量最高的6篇文章
        $hot = Article::orderBy('art_view' , 'desc') -> take(5) -> get();
        //最新發布文章8篇
        $new = Article::orderBy('art_time' , 'desc') -> take(8) -> get();

        $navs = Navs::all();
        View::share('navs' , $navs);
        View::share('hot' , $hot);
        View::share('new' , $new);
    }
}
