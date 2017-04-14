<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Article;
use App\Http\Model\Category;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ArticleController extends Controller
{
    //get. admin/article 全部文章列表
    public function index ()
    {
        $data = Article::orderBy('art_id','desc')->paginate(3);
        return view('admin.article.index',compact('data'));
    }

    //get.admin/article/create //添加文章
    public function create()
    {
        $datas = (new Category)->tree();
        return view('admin.article.add',compact('datas'));
    }


    //post.admin/article //添加文章提交
    public function store()
    {
        $input = Input::except('_token');
        $input['art_time']=time();
        $re = Article::create($input);

        $rule =[
            'art_title'=>'required',
            'art_content'=>'required'
        ];
        $message =[
            'art_title.required'=>'文章标题不能为空！',
            'art_content.required'=>'文章内容不能为空！'

        ];
        $validator = Validator::make($input,$rule,$message);

        if($validator->passes()){
            if($re){
                return redirect('admin/article');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试');
            }

        }else{
            return back()->withErrors($validator);
        }
    }


    //get.admin/article/{article}/edit 修改文章
    public function edit($art_id)
    {
        $field = Article::find($art_id);
        $datas = (new Category)->tree();
        return view('admin.article.edit',compact('field','datas'));
    }

    //put.admin/article/{article}//提交修改
    public function update($art_id)
    {
        $input = Input::except('_token','_method');
        $re = Article::where('art_id',$art_id)->update($input);
        if($re){
            return redirect('admin/article');
        }else{
            return back()->with('errors','文章提交失败，请稍后再试');
        }

    }

    //delete.admin/article/{article}
    public function destroy($art_id)
    {
        $re = Article::where('art_id',$art_id)->delete();

        if($re){
            $data=[
                'status'=>0,
                'msg'=>'文章删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'文章删除失败，请稍后再试'
            ];
        }
    }

}