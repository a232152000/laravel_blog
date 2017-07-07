<?php

namespace App\Http\Controllers\Admin;

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
        $data = [];
        return view('admin.article.add' , compact('data'));
    }
}
