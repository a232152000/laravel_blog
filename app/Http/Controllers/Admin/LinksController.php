<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

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

    //get admin/links/create  添加友情鏈結
    public function create()
    {
        return view('admin/links/add' , compact('data'));
    }

    //post admin/links  添加友情鏈結提交
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'link_name' => 'required',
            'link_url' => 'required',
        ];
        $message = [
            'link_name.required' => '友情鏈結名稱不能為空!',
            'link_url.required' => '友情鏈結URL名稱不能為空!',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator -> passes()){
            $re = Links::create($input);
            if($re){
                return redirect('admin/links');
            }
            else{
                return back() -> with('errors','友情鏈結數據填充失敗，請稍後再試!');
            }
        }
        else{
            return back() -> withErrors($validator);
        }
    }

    //get admin/links/{category}/edit  編輯友情鏈結
    public function edit($link_id)
    {
        $field = Links::find($link_id);
        return view('admin/links/edit' , compact('field'));
    }

    //put admin/links/{category} 更新友情鏈結
    public function update($link_id)
    {
        $input = Input::except('_token','_method');
        $re = Links::where('link_id' , $link_id) ->update($input);
        if($re){
            return redirect('admin/links');
        }
        else{
            return back() -> with('errors','友情鏈結修改失敗，請稍後再試!');
        }
    }

    //DELETE admin/category/{category}  刪除友情鏈結
    public function destroy($link_id)
    {
        $re = Links::where('link_id',$link_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '友情鏈結刪除成功',
            ];
        }
        else{
            $data = [
                'status' => 1,
                'msg' => '友情鏈結刪除失敗，請稍後再試',
            ];
        }
        return $data;
    }

    //get admin/links/{category} 顯示單個友情鏈結訊息
    public function show()
    {

    }
}
