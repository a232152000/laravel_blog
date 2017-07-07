<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

class ArticleController extends CommonController
{
    //全部文章列表
    public function index()
    {
        echo 123;
    }

    //get admin/article/create  添加文章
    public function create()
    {
        $data = (new Category) -> tree();
        return view('admin.article.add' , compact('data'));
    }
}
