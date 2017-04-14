<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;

class CommonController extends Controller
{
    //图片上传
    public function upload()
    {
        $file = Input::file('Filedata');//这里因不是get方式提交的数据，所以不能用get(),用file().用all()输出的数据是Filedate这组数据
       if($file->isValid()){
          $realPath = $file->getRealPath();//临时文件的后缀all
           $entension = $file->getClientOriginalExtension();//获取文件名后缀
           $newname = date('YmdHis').mt_rand(100,999).'.'.$entension;
           $path = $file->move(base_path().'/uploads',$newname);
           $filepath = 'uploads/'.$newname;
           return $filepath;
       }
    }
}
