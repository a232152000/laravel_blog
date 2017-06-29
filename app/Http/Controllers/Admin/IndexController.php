<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Validator;
use App\Http\Model\User;
use Illuminate\Support\Facades\Crypt;
class IndexController extends CommonController
{
  //後台介面
  public function index(){
    return view('admin.index');
  }
  //後台中間子視圖
  public function info(){
    return view('admin.info');
  }

  //更改管理員密碼
  public function pass(){
    if($input = Input::all()){
        $rules = [
          'password' => 'required|between:6,20|confirmed',
        ];

        $message = [
          'password.required' => '請輸入新密碼!',
          'password.between' => '新密碼必須在6~20位數之間!',
          'password.confirmed' => '新密碼與確認密碼不一致!',
        ];

        $validator = Validator::make($input,$rules,$message);
        if($validator -> passes()){
            $user = User::first();
            $_password = Crypt::decrypt($user -> user_pass);

            if($input['password_o'] == $_password){
                $user -> user_pass = Crypt::encrypt($input['password']);
                $user -> update();
                return redirect('admin/info');
            }
            else{
                return back() -> with('errors','原密碼錯誤!');
            }
        }
        else{
            return back() -> withErrors($validator);
        }
    }
    else{
        return view('admin.pass');
    }
  }

}
