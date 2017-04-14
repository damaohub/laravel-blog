<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\User;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class IndexController extends CommonController
{
    public function index()
    {
        return view('admin.index');
    }

    public function info()
    {
        return view('admin.info');
    }

    //更改超级管理员密码
    public function pass()
    {
        if($input = Input::all()){
            $rules = ['password'=>'required|between:6,20|confirmed',

            ];
            $messages = ['password.required'=>'新密码不能为空',
                'password.between'=>'新密码必须6到20位之间',
                'password.confirmed'=>'确认密码和新密码不匹配',

            ];
            $validator = Validator::make($input,$rules,$messages);
            if($validator->passes()){
                $user = User::first();
                $_password = Crypt::decrypt($user->user_pass);
                if($input['password_o']==$_password){
                    $user->user_pass = Crypt::encrypt($input['password']);
                    $user->update();
                    return back()->with('errors','密码修改成功');//这个真不舒服，成功还用errors传数据。
                }else{
                    return back()->with('errors','原密码错误');//我猜这个withErrors()等价于with(errors)
                }
            }else{
                return back()->withErrors($validator);//传到页面上去了
            }

        }else{
            return view('admin.pass');
        }

    }
}
