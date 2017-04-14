@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>  &raquo; 自定义导航管理
    </div>
    <!--面包屑导航 结束-->



    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>自定义导航列表</h3>
             </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/navs/create')}}"><i class="fa fa-plus"></i>添加自定义导航</a>
                    <a href="{{url('admin/navs')}}"><i class="fa fa-recycle"></i>自定义导航列表</a>

                </div>
            </div>
            <!--快捷导航 结束-->
        </div>

        <div class="result_wrap">
            <div class="result_content">
                <table class="list_tab am-table">
                    <tr>

                        <th class="tc">排序</th>
                        <th class="tc">ID</th>
                        <th>自定义导航名称</th>
                        <th>自定义导航描述</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>

                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v->nav_id}})" name="ord[]" value="{{$v->nav_order}}">
                        </td>
                        <td class="tc">{{$v->nav_id}}</td>
                        <td>
                            <a href="#">{{$v->nav_name}}</a>
                        </td>
                        <td style="max-width:200px;"><a href="#">{{$v->nav_alias}}</a></td>
                        <td><a href="#">{{$v->nav_url}}</a></td>
                        <td>
                            <a href="{{url('admin/navs/'.$v->nav_id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="deleNavs({{$v->nav_id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

<script>
        function changeOrder(obj,nav_id){
            var nav_order = $(obj).val();
            $.post('{{url('admin/navs/changeOrder')}}',{'_token':'{{csrf_token()}}','nav_id':nav_id,'nav_order':nav_order},function(data){
                if(data.status == 0){
                    layer.msg(data.msg,{icon:1});
                }else{
                    layer.msg(data.msg,{icon:2});
                }


            });
        }


    function deleNavs(nav_id){
        layer.confirm('您确定要删除这个分类吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/navs')}}/"+nav_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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