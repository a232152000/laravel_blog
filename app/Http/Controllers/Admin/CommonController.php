<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    public function upload()
    {
        $file = Input::file('Filedata');
        if($file -> isValid()){
            $entension = $file -> getClientOriginalExtension();  //上船文件的副檔名
            //將其放置在app目錄下的storage目錄下的uploads目錄中，且需要更改的話
            //這裡app_path()就是app文件夾所在的路徑，$newName 可以是你通過某種算法獲得的文件名稱，主要是不能重複產生衝突即可
            $newName = date('YmdHis').mt_rand(100,999).'.'.$entension;
            $path = $file -> move(base_path().'\uploads',$newName);
            $filePath = 'uploads/'.$newName;
            return $filePath;
        }
    }
}
