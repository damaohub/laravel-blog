<?php

namespace App\Http\Controllers\Home;

use App\Http\Model\Article;
use App\Http\Model\Category;
use App\Http\Model\Navs;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;

class IndexController extends Controller
{
    public function index()
    {
        $arts  = Article::paginate(12);
        return view('home.index',compact('arts'));
    }

//自己想的那种异步渲染分页貌似不能实现 fail.问题是异步传入到页码之后不知道怎么渲染出分页器和内容。
    public function pageNum()
    {
       $input = Input::except('_token');
        $currentPage = $input['page'];
        Paginator::currentPageResolver(function() use ($currentPage){
            return $currentPage;
        });

    }

//a/{aid} 文章详情页
    public function art($aid)
    {
        $field = Article::findOrFail($aid);

        return view('home.art',compact('field'));
    }
//文章索引页
    public function arts()
    {
        $allArts = Article::paginate(15);
        return view('home.lists',compact('allArts'));
    }

    public function tag()
    {
        return view('home.tag',compact());
    }

    public function cate($cate_id)
    {
        $data = Article::where('cate_id','=',$cate_id)->orderBy('art_time','desc')->paginate(4);
        $field =  Category::findOrFail($cate_id);
        return view('home.cate',compact('field','data'));
    }
}
