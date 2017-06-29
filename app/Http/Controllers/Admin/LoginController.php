<?php

namespace App\Http\Controllers\Admin;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Crypt;
use App\Http\Model\User;
require_once '/resources/org/code/Code.class.php';

class LoginController extends CommonController
{
    public function login(){
      if($input = Input::all()){
          session_start();   // 使用原生session手動寫入
          $code = new \Code;
          $_code = $code -> get();

          if($input['code'] != $_code){
            return back() -> with('msg', '驗證碼錯誤');
          }
          $user = User::first();
          if($user -> user_name != $input['user_name'] || Crypt::decrypt($user -> user_pass) != $input['user_pass']){
            return back() -> with('msg', '帳號或密碼錯誤');
          }
          session(['user' => $user]);
          session()->save(); // 使用原生session手動寫入
          return redirect('admin/index');
      }
      else{
          return view('admin.login');
      }
    }

    public function quit(){
      session(['user' => NULL]);
      return redirect('admin/login');
    }

    public function code(){
      session_start();   // 使用原生session手動寫入
      $code = new \Code;
      $code -> make();
      session()->save(); // 使用原生session手動寫入
    }

}
