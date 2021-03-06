<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LoginController extends CommonController{
    public function login()
    {
        if($input = Input::all()){

            $rules = ['captcha' => 'required|captcha'];
            //dd($input['code']);
            $validator = Validator::make([$input['code']], $rules);
            if ($validator->fails())
            {
                echo '<p style="color: #ff0000;">Incorrect!</p>';
            }
            else
            {
                echo '<p style="color: #00ff30;">Matched :)</p>';
            }

//            if(strtoupper($input['code'])!=$_code){
//                return back()->with('errormsg','验证码错误');
//
//            }

            $user = User::first();
            if($user->user_name != $input['user_name']||Crypt::decrypt($user->user_pass) != $input['user_pass']){
                return back()->with('errormsg','用户名或者密码错误');
            }
            session(['user'=>$user]);
            return redirect()->route('index');

        }else{

            return view('admin.login');
        }


    }

    public function quit()
    {
        session(['user'=>null]);
        return redirect('admin/login');
    }

    public function code()
    {

       return captcha();
    }

//    public function getcode()
//    {
//        $code = new \Code;
//        $_code = $code->get();
//        /*  在Code类中get方法使用原生php的session.但是在laravel中对session进行了自己封装，所以会报错。解决办法，简单点，在入口文件（index.php）中把原生session打开。在以后引用第三方库的时候要注意。问题是写不进去啊！！解决：权限问题*/
//    }



}
