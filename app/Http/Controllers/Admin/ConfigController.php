<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Validator;

class ConfigController extends Controller
{
    //get admin/config 全部配置項列表
    public function index()
    {
        dd('全部配置項列表');
        $data = Config::orderBy('conf_order' , 'asc') -> get();
       return view('admin.config.index' , compact('data'));
    }

    //更改order的排序
    public function changeOrder()
    {
        $input = Input::all();
        $config = Config::find($input['conf_id']);
        $config -> conf_order = $input['conf_order'];
        $re = $config ->update();

        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置項排序跟新成功!'
            ];
        }
        else{
            $data = [
                'status' => 1,
                'msg' => '配置項排序跟新失敗,請稍後再試!'
            ];
        }
        return $data;
    }

    //get admin/config/create  添加配置項
    public function create()
    {
        return view('admin/config/add' , compact('data'));
    }

    //post admin/config  添加配置項提交
    public function store()
    {
        $input = Input::except('_token');

        $rules = [
            'conf_name' => 'required',
            'conf_url' => 'required',
        ];
        $message = [
            'conf_name.required' => '配置項名稱不能為空!',
            'conf_url.required' => '配置項URL名稱不能為空!',
        ];

        $validator = Validator::make($input,$rules,$message);

        if($validator -> passes()){
            $re = Config::create($input);
            if($re){
                return redirect('admin/config');
            }
            else{
                return back() -> with('errors','配置項數據填充失敗，請稍後再試!');
            }
        }
        else{
            return back() -> withErrors($validator);
        }
    }

    //get admin/config/{category}/edit  編輯配置項
    public function edit($conf_id)
    {
        $field = Config::find($conf_id);
        return view('admin/config/edit' , compact('field'));
    }

    //put admin/config/{category} 更新配置項
    public function update($conf_id)
    {
        $input = Input::except('_token','_method');
        $re = Config::where('conf_id' , $conf_id) ->update($input);
        if($re){
            return redirect('admin/config');
        }
        else{
            return back() -> with('errors','配置項修改失敗，請稍後再試!');
        }
    }

    //DELETE admin/category/{category}  刪除配置項
    public function destroy($conf_id)
    {
        $re = Config::where('conf_id',$conf_id)->delete();
        if($re){
            $data = [
                'status' => 0,
                'msg' => '配置項刪除成功',
            ];
        }
        else{
            $data = [
                'status' => 1,
                'msg' => '配置項刪除失敗，請稍後再試',
            ];
        }
        return $data;
    }

    //get admin/config/{category} 顯示單個配置項訊息
    public function show()
    {

    }
}
