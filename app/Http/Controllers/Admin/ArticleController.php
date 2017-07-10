<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Validator;

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

    //post admin/article  添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        $input['art_time'] = time();
        $rules = [
            'art_title' => 'required',
            'art_content' => 'required',
        ];
        $message = [
            'art_title.required' => '文章名稱不能為空!',
            'art_content.required' => '文章內容不能為空!',

        ];
        $validator = Validator::make($input,$rules,$message);
        if($validator -> passes()){
            $re = Article::create($input);
            if($re){
                return redirect('admin/article');
            }
            else{
                return back() -> with('errors','數據填充失敗，請稍後再試!');
            }
        }
        else{
            return back() -> withErrors($validator);
        }
    }
}
