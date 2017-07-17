<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class NavsController extends Controller
{
    //get admin/navs 全部自定義導航列表
    public function index()
    {
        $data = Navs::orderBy('nav_order' , 'asc') -> get();
       return view('admin.navs.index' , compact('data'));
    }

    //更改order的排序
    public function changeOrder()
    {
        $input = Input::all();
        $navs = Navs::find($input['nav_id']);
        $navs -> nav_order = $input['nav_order'];
        $re = $navs ->update();

        if($re){
            $data = [
                'status' => 0,
                'msg' => '自定義導航排序跟新成功!'
            ];
        }
        else{
            $data = [
                'status' => 1,
                'msg' => '自定義導航排序跟新失敗,請稍後再試!'
            ];
        }
        return $data;
    }

    //get admin/navs/create  添加自定義導航
    public function create()
    {
        return view('admin/navs/add' , compact('data'));
    }

    //post admin/navs  添加自定義導航提交
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'nav_name' => 'required',
            'nav_url' => 'required',
        ];
        $message = [
            'nav_name.required' => '自定義導航名稱不能為空!',
            'nav_url.required' => '自定義導航URL名稱不能為空!',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator -> passes()){
            $re = Navs::create($input);
            if($re){
                return redirect('admin/navs');
            }
            else{
                return back() -> with('errors','自定義導航數據填充失敗，請稍後再試!');
            }
        }
        else{
            return back() -> withErrors($validator);
        }
    }

    //get admin/navs/{category}/edit  編輯自定義導航
    public function edit($nav_id)
    {
        $field = Navs::find($nav_id);
        return view('admin/navs/edit' , compact('field'));
    }

    //put admin/navs/{category} 更新自定義導航
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $re = Navs::where('nav_id' , $nav_id) ->update($input);
        if($re){
            return redirect('admin/navs');
        }
        else{
            return back() -> with('errors','自定義導航修改失敗，請稍後再試!');
        }
    }

    //DELETE admin/category/{category}  刪除自定義導航
    public function destroy($nav_id)
    {
        $re = Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '自定義導航刪除成功',
            ];
        }
        else{
            $data = [
                'status' => 1,
                'msg' => '自定義導航刪除失敗，請稍後再試',
            ];
        }
        return $data;
    }

    //get admin/navs/{category} 顯示單個自定義導航訊息
    public function show()
    {

    }
}
