<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'category';
    protected $primaryKey = 'cate_id';
    public $timestamps = false;

    public function tree()
    {
        $category = $this -> all();
        return $this -> getTree($category,'cate_name','cate_pid','cate_id',0);
    }

    public function getTree($data,$field_name,$field_pid,$field_id,$pid)
    {
        $arr = array();
        foreach ($data as $k => $v){
            if($v->$field_pid == $pid){
                $data[$k]["_".$field_name] =$data[$k][$field_name];
                $arr[] = $data[$k];
            }
            foreach ($data as $m => $n){
                if($n->$field_pid == $v->$field_id){
                    $data[$m]["_".$field_name] ='├─ '.$data[$m][$field_name];
                    $arr[] = $data[$m];
                }
            }
        }
        return $arr;
    }
}
