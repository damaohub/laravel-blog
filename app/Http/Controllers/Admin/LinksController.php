<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Links;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class LinksController extends Controller
{
    //get. admin/links 全部分类列表
    public function index ()
    {
        $data =Links::orderby('link_order','asc')->get();
        return view('admin.links.index',compact('data'));
    }

    public function changeOrder()
    {
        $input = Input::all();
        $link = Links::find($input['id']);
        $link->link_order = $input['link_order'];
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

    //get.admin/links/create //添加友链
    public function create()
    {
        $datas = [];
        return view('admin.links.add',compact('datas'));
    }

    //post.admin/links //添加友链提交
    public function store()
    {
        $input = Input::except('_token');//文档上说except参数值能接受一个数组，这意思里面的—_token是数组的键.这是原生php的吗？//这是原生的
        $rule =[
            'link_name'=>'required',
            'link_url'=>'required'
        ];
        $message =[
            'link_name.required'=>'友情链接名不能为空！',
            'link_url.required'=>'友情url不能为空！'
        ];
        $validator = Validator::make($input,$rule,$message);

        if($validator->passes()){
            $re = Links::create($input);
            if($re){
                return redirect('admin/links');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试');
            }

        }else{
            return back()->withErrors($validator);
        }

    }

    //get.admin/links/{links}/edit  //修改页面
    public function edit($link_id)
    {
        $field = Links::find($link_id);
        return view('admin.links.edit',compact('field'));
    }

    //put.admin/links/{links}//提交修改
    public function update($link_id)
    {
        $input = Input::except('_token','_method');
        $re = Links::where('id',$link_id)->update($input);
        if($re){
            return redirect('admin/links');
        }else{
            return back()->with('errors','友情链接提交失败，请稍后再试');
        }

    }

    //delete.admin/links/{links}  //删除友链
    public function destroy($link_id)
    {
        $re = Links::where('id',$link_id)->delete();
        if($re){
            $data=[
                'status'=>0,
                'msg'=>'友情链接删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'友情链接删除失败，请稍后再试'
            ];
        }
    }

}
