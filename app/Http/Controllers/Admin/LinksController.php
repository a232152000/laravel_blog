<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class LinksController extends Controller
{
    //get admin/links 全部友情鏈結列表
    public function index()
    {
        $data = Links::orderBy('link_order' , 'asc') -> get();
       return view('admin.links.index' , compact('data'));
    }

    //更改order的排序
    public function changeOrder()
    {
        $input = Input::all();
        $links = Links::find($input['link_id']);
        $links -> link_order = $input['link_order'];
        $re = $links ->update();

        if($re){
            $data = [
                'status' => 0,
                'msg' => '友情鏈結排序跟新成功!'
            ];
        }
        else{
            $data = [
                'status' => 1,
                'msg' => '友情鏈結排序跟新失敗,請稍後再試!'
            ];
        }
        return $data;
    }

    //get admin/links/{category} 顯示單個友情鏈結訊息
    public function show()
    {

    }
}
