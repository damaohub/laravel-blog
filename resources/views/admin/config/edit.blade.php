@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a> &raquo;网站配置管理
    </div>
    <!--面包屑导航 结束-->

	<!--结果集标题与导航组件 开始-->
	<div class="result_wrap">
        <div class="result_title">
            <h3>编辑配置项</h3>
            @if(count($errors)>0)
                <div class="mark">
                    @if(is_object($errors))
                    @foreach($errors->all() as $error)<!--这里当errors为字符串时，遍历会出错。因为传来的$error类型不确定-->
                    <p>{{$error}}</p>
                    @endforeach
                    @else
                        <p>{{$errors}}</p>
                    @endif
                </div>
            @endif
        </div>
        <div class="result_content">
            <div class="short_wrap">
                <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加配置项</a>
                <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>配置项列表</a>
            </div>
        </div>
    </div>
    <!--结果集标题与导航组件 结束-->
    
    <div class="result_wrap">
        <form action="{{url('admin/config/'.$field->conf_id)}}" method="post">
            <input type="hidden" name="_method" value="put"> <!--模拟input提交-->
            {{csrf_field()}}
            <table class="add_tab">
                <tbody>
                <tr>
                    <th><i class="require">*</i>配置标题：</th>
                    <td>
                        <input type="text" name="conf_title" value="{{$field->conf_title}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置标题必填</span>

                    </td>
                </tr>
                <tr>
                    <th><i class="require">*</i>配置名称：</th>
                    <td>
                        <input type="text" name="conf_name" value="{{$field->conf_name}}">
                        <span><i class="fa fa-exclamation-circle yellow"></i>配置名称必填</span>

                    </td>
                </tr>
                <tr>
                    <th>类型：</th>
                    <td class="j-radio">
                        <label><input class="sm" @if($field->field_type=='radio') checked @endif  type="radio" name="field_type" type="radio" name="field_type" value="radio">radio </label>
                        <label><input  class="sm" type="radio" @if($field->field_type=='input') checked @endif name="field_type" value="input">input</label>
                        <label><input id="" class="sm" @if($field->field_type=='textarea') checked @endif  type="radio" name="field_type" value="textarea">textarea</label>

                    </td>
                </tr>
                <tr class="field_value">
                    <th>类型值：</th>
                    <td>
                        <input type="text" class="lg" name="field_value" value="{{$field->conf_value}}">
                        <p><i class="fa fa-exclamation-circle yellow"></i>类型只有在radio时才有该选项</p>
                    </td>
                </tr>
                <tr>
                    <th>排序：</th>
                    <td>
                        <input class="sm" type="text" name="conf_order" value="{{$field->conf_order}}">
                    </td>
                </tr>
                <tr>
                    <th>配置描述：</th>
                    <td>
                        <textarea name="conf_tips">{{$field->conf_tips}}</textarea>
                    </td>
                </tr>


                <tr>
                    <th></th>
                    <td>
                        <input type="submit" value="提交">
                        <input type="button" class="back" onclick="history.go(-1)" value="返回">
                    </td>
                </tr>
                </tbody>
            </table>
        </form>
    </div>
<script>
//有bug 啊！
    $(function(){

        $(".j-radio label input").on('click',function(){
            if($(this).is(':checked')){
                if($(this).val()=='radio'){
                    $(".field_value").show();
               }else {
                   $(".field_value").hide();
                }
           }

        }).click()
    })

</script>
@endsection