<?php

namespace App\Http\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $table = 'blog_category';//竟然要加前缀才行！？

    protected $primaryKey = 'cate_id';

    public $timestamps = false;

    public $guarded = [];//空数组，相当于 非

    public function tree()
    {
        $category = $this->orderBy('cate_order','asc')->get();

        return $data = $this->getTree($category,'cate_id','cate_pid',0);
    }

    public function getTree($data,$filed_id='id',$filed_pid='pid',$pid=0)
    {
        $arr = [];
        foreach($data as $k=>$v){
            if($v->$filed_pid==$pid){
                $data[$k]['_cate_name']=$data[$k]['cate_name'];//等价于$data[$k]->_cate_name=$data[$k]->cate_name.也许是EloquentORM模型提供的，既是对象又是数组。或者我不太理解数组和对象可以通用？后者不太可能。
                $arr[] = $data[$k];//数组复制
                foreach($data as $m=>$n){
                    if($n->$filed_pid == $v->$filed_id){
                        $data[$m]['_cate_name']='——'.$data[$m]['cate_name'];
                        $arr[] = $data[$m];
                    }
                }
            }
        }
        return $arr;
    }

}
