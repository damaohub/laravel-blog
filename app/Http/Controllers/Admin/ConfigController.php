<?php

namespace App\Http\Controllers\Admin;

use App\Http\Model\Config;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Validator;

class ConfigController extends Controller
{
    //get. admin/config 全部配置列表
    public function index ()
    {
       $data =Config::orderby('conf_order','asc')->get();
        foreach($data as $k=>$v){
            switch($v->field_type){
                case 'input':
                    //添加一个_html字段
                    //把需要提交的字段名称conf_content变成数组，可以避免提交时的覆盖问题
                    $data[$k]->_html='<input style="width:90%;text-align:left;" type="text" name="conf_content[]" value="'.$v->conf_content.'">';
                    break;
                case 'textarea':
                    $data[$k]->_html='<textarea style="width:90%;" name="conf_content[]">'.$v->conf_content.'</textarea>';
                    break;
                case 'radio':
                     $arr = explode(',',$v->field_value);
                     $str='';
                     foreach($arr as $m=>$n){
                         $inArr = explode('|',$n);
                         $c= $v->conf_content==$inArr[0]?'checked':'';
                         $str.='<label><input type="radio" name="conf_content[]" value="'.$inArr[0].'"'.$c.'>'.$inArr[1].'</label>';

                     }
                    $data[$k]->_html = $str;
                    break;
            }
        }
        return view('admin.config.index',compact('data'));
    }

    //排序
    public function changeOrder()
    {
        $input = Input::all();
        $link = Config::find($input['conf_id']);
        $link->conf_order = $input['conf_order'];
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
    
    //提交配置项
    public function changeContent()
    {
        $input = (Input::all());

        foreach($input['conf_id'] as $k=>$v){
            Config::where('conf_id',$v)->update(['conf_content'=>$input['conf_content'][$k]]);
        }
        $this->putFile();
        return back()->with('errors','配置项更改成功');
    }

    public function putFile()
    {
        //注意pluck参数顺序，两个参数时后边是键名
        //后边all()方法竟然还能净化输出，框架底层的东西。
        $config = Config::pluck('conf_content','conf_name')->all();
        //$path = base_path().'\config\web.php';
        $path = config_path().'\web.php';
        $str = '<?php return '.var_export($config,true).';';
       file_put_contents($path,$str);
       // echo var_export($config,TRUE);
    }

    //get.admin/config/create //添加网站配置
    public function create()
    {
        $datas = [];
        return view('admin.config.add',compact('datas'));
    }

    //post.admin/config //添加网站配置提交
    public function store()
    {
        $input = Input::except('_token');//文档上说except参数值能接受一个数组，这意思里面的—_token是数组的键.这是原生php的吗？//这是原生的
        $rule =[
            'conf_name'=>'required',
            'conf_title'=>'required'
        ];
        $message =[
            'conf_name.required'=>'配置项名不能为空！',
            'conf_title.required'=>'配置项标题不能为空！'
        ];
        $validator = Validator::make($input,$rule,$message);

        if($validator->passes()){
            $re = Config::create($input);
            if($re){
                return redirect('admin/config');
            }else{
                return back()->with('errors','数据填充失败，请稍后重试');
            }

        }else{
            return back()->withErrors($validator);
        }

    }

    //get.admin/config/{config}/edit //修改页面
    public function edit($conf_id)
    {
        $field = Config::find($conf_id);
        return view('admin.config.edit',compact('field'));
    }

    //put.admin/config/{config}//提交修改
    public function update($conf_id)
    {
        $input = Input::except('_token','_method');
        $re = Config::where('conf_id',$conf_id)->update($input);
        if($re){
            $this->putFile();
            return redirect('admin/config');
        }else{
            return back()->with('errors','配置项提交失败，请稍后再试');
        }

    }

    //delete.admin/config/{config}  //删除网站配置
    public function destroy($conf_id)
    {
        $re = Config::where('conf_id',$conf_id)->delete();
        if($re){
            $this->putFile();
            $data=[
                'status'=>0,
                'msg'=>'配置项删除成功'
            ];
        }else{
            $data=[
                'status'=>1,
                'msg'=>'配置项删除失败，请稍后再试'
            ];
        }
    }


}
