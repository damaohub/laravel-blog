<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class NavsController extends Controller
{
    //get. admin/navs 全部分类列表
    public function index ()
    {
        $data =Navs::orderby('nav_order','asc')->get();
        return view('admin.navs.index',compact('data'));
    }
    //排序
    public function changeOrder()
    {
        $input = Input::all();
        $link = Navs::find($input['nav_id']);
        $link->nav_order = $input['nav_order'];
        $re = $link->update();
        if($re){
            $data = [
                'status'=>0,
                'msg'=>'更新成功'
            ];
        }else{
            $data = [
                'status'=>1,
                'msg'=>'更新失败'
            ];
        }
        return $data;
        //dd($input);

    }

    //get.admin/navs/create //添加友链
    public function create()
    {
        $datas = [];
        return view('admin.navs.add',compact('datas'));
    }

    //post.admin/navs //添加友链提交
    public function store()
    {
        $input = Input::except('_token');//文档上说except参数值能接受一个数组，这意思里面的—_token是数组的键.这是原生php的吗？//这是原生的
        $rule =[
            'nav_name'=>'required',
            'nav_url'=>'required'
        ];
        $message =[
            'nav_name.required'=>'导航项名不能为空！',
            'nav_url.required'=>'导航项url不能为空！'
        ];
        $validator = Validator::make($input,$rule,$message);

        if($validator->passes()){
            $re = Navs::create($input);
            if($re){
                return redirect('admin/navs');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试');
            }

        }else{
            return back()->withErrors($validator);
        }

    }

    //get.admin/navs/{navs}/edit //修改页面
    public function edit($nav_id)
    {
        $field = Navs::find($nav_id);
        return view('admin.navs.edit',compact('field'));
    }

    //put.admin/navs/{navs}//提交修改
    public function update($nav_id)
    {
        $input = Input::except('_token','_method');
        $re = Navs::where('nav_id',$nav_id)->update($input);
        if($re){
            return redirect('admin/navs');
        }else{
            return back()->with('errors','导航项提交失败，请稍后再试');
        }

    }

    //delete.admin/navs/{navs}  //删除自定义导航
    public function destroy($nav_id)
    {
        $re = Navs::where('nav_id',$nav_id)->delete();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'导航项删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'导航项删除失败，请稍后再试'
            ];
        }
    }
}
