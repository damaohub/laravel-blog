<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;


class CategoryController extends CommonController
{
    //get. admin/category 全部分类列表
    public function index ()
    {
        $category = (new Category)->tree();
        return view('admin.category.index')->with('data',$category);
    }



    //post.admin/category //添加分类提交
    public function store()
    {
        $input = Input::except('_token');//文档上说except参数值能接受一个数组，这意思里面的—_token是数组的键.这是原生php的吗？//这是原生的
        $rule =[
            'cate_name'=>'required'
        ];
        $message =[
            'cate_name.required'=>'分类名不能为空！'
        ];
        $validator = Validator::make($input,$rule,$message);

        if($validator->passes()){
            $re = Category::create($input);
            if($re){
                return redirect('admin/category');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试');
            }

        }else{
            return back()->withErrors($validator);
        }

    }

    //get.admin/category/create //添加分类
    public function create()
    {
        $datas = Category::where('cate_pid',0)->get();
        return view('admin.category.add',compact('datas'));
    }

    //get.admin/category/{category}
    public function show()
    {

    }

    //delete.admin/category/{category}
    public function destroy($cate_id)
    {
        $re = Category::where('cate_id',$cate_id)->delete();
        Category::where('cate_pid',$cate_id)->update(['cate_pid'=>0]);//父级分类删除后子分类的处理，变成顶级分类.注意update的参数
        if($re){
            $data=[
              'status'=>0,
                'msg'=>'分类删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'分类删除失败，请稍后再试'
            ];
        }
    }

    //put.admin/category/{category}//提交修改
    public function update($cate_id)
    {
        $input = Input::except('_token','_method');
        $re = Category::where('cate_id',$cate_id)->update($input);
        if($re){
            return redirect('admin/category');
        }else{
            return back()->with('errors','分类信息提交失败，请稍后再试');
        }

    }

    //get.admin/category/{category}/edit
    public function edit($cate_id)
    {
        $field = Category::find($cate_id);
        $datas = Category::where('cate_pid',0)->get();
        return view('admin.category.edit',compact('field','datas'));
    }


    public function changeOrder()
    {
        $input = Input::all();
        $cate = Category::find($input['cate_id']);
        $cate->cate_order = $input['cate_order'];
        $re = $cate->update();
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

}

