@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>  &raquo; 网站配置管理
    </div>
    <!--面包屑导航 结束-->


    <!--搜索结果页面 列表 开始-->

        <div class="result_wrap">
            <div class="result_title">
                <h3>网站配置列表</h3>
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
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/config/create')}}"><i class="fa fa-plus"></i>添加网站配置</a>
                    <a href="{{url('admin/config')}}"><i class="fa fa-recycle"></i>网站配置列表</a>

                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <form action="{{url('admin/config/changecontent')}}" method="post">
                    {{csrf_field()}}
                <table class="list_tab am-table">
                    <tr>

                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>配置项标题</th>
                        <th>配置项名称</th>
                        <th>配置项内容</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>

                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v->conf_id}})" name="ord[]" value="{{$v->conf_order}}">
                        </td>
                        <td class="tc">{{$v->conf_id}}</td>
                        <td>
                            {{$v->conf_title}}
                        </td>

                        <td>
                            {{$v->conf_name}}
                        </td>

                        <td style="max-width:200px;">
                            {!!$v->_html!!}
                            <input type="hidden" name="conf_id[]" value="{{$v->conf_id}}">
                        </td>
                        <td>
                            <a href="{{url('admin/config/'.$v->conf_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="deleConfs({{$v->conf_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach

                </table>
                <div class="btn_group">
                    <input type="submit" value="提交">
                    <input type="button" class="back" onclick="history.go(-1)" value="返回" >
                </div>
                </form>
            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

<script>
        function changeOrder(obj,conf_id){
            var conf_order = $(obj).val();
            $.post('{{url('admin/config/changeOrder')}}',{'_token':'{{csrf_token()}}','conf_id':conf_id,'conf_order':conf_order},function(data){
                if(data.status == 0){
                    layer.msg(data.msg,{icon:1});
                }else{
                    layer.msg(data.msg,{icon:2});
                }


            });
        }


    function deleConfs(conf_id){
        layer.confirm('您确定要删除这个分类吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/config')}}/"+conf_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
                if(data.status==0){

                    layer.msg(data.msg,{icon:2});
                }else{
                    layer.msg(data.msg,{icon:1});
                }
                location.href = location.href;
            });


        }, function(){
//            layer.msg('取消了', {
//                time: 2000, //2s后自动关闭
//                btn: ['明白了', '知道了']
//            });
        });
    }

</script>

@endsection