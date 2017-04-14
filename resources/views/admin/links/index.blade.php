@extends('layouts.admin')
@section('content')
    <!--面包屑导航 开始-->
    <div class="crumb_warp">
        <!--<i class="fa fa-bell"></i> 欢迎使用登陆网站后台，建站的首选工具。-->
        <i class="fa fa-home"></i> <a href="{{url('admin/info')}}">首页</a>  &raquo; 友情链接管理
    </div>
    <!--面包屑导航 结束-->



    <!--搜索结果页面 列表 开始-->
    <form action="#" method="post">
        <div class="result_wrap">
            <div class="result_title">
                <h3>友情链接列表</h3>
             </div>
            <!--快捷导航 开始-->
            <div class="result_content">
                <div class="short_wrap">
                    <a href="{{url('admin/links/create')}}"><i class="fa fa-plus"></i>添加友情链接</a>
                    <a href="{{url('admin/links')}}"><i class="fa fa-recycle"></i>友情链接列表</a>

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
                        <th>友情链接名称</th>
                        <th>友情链接描述</th>
                        <th>链接地址</th>
                        <th>操作</th>
                    </tr>
                    @foreach($data as $v)
                    <tr>

                        <td class="tc">
                            <input type="text" onchange="changeOrder(this,{{$v->id}})" name="ord[]" value="{{$v->link_order}}">
                        </td>
                        <td class="tc">{{$v->id}}</td>
                        <td>
                            <a href="#">{{$v->link_name}}</a>
                        </td>
                        <td style="max-width:200px;"><a href="#">{{$v->link_desc}}</a></td>
                        <td><a href="#">{{$v->link_url}}</a></td>
                        <td>
                            <a href="{{url('admin/links/'.$v->id.'/edit')}}">修改</a>
                            <a href="javascript:;" onclick="deleLinks({{$v->id}})">删除</a>
                        </td>
                    </tr>
                    @endforeach

                </table>

            </div>
        </div>
    </form>
    <!--搜索结果页面 列表 结束-->

<script>
        function changeOrder(obj,link_id){
            var link_order = $(obj).val();
            $.post('{{url('admin/links/changeOrder')}}',{'_token':'{{csrf_token()}}','id':link_id,'link_order':link_order},function(data){
                if(data.status == 0){
                    layer.msg(data.msg,{icon:1});
                }else{
                    layer.msg(data.msg,{icon:2});
                }


            });
        }


    function deleLinks(link_id){
        layer.confirm('您确定要删除这个分类吗？', {
            btn: ['确定','取消'] //按钮
        }, function(){
            $.post("{{url('admin/links')}}/"+link_id,{'_method':'delete','_token':'{{csrf_token()}}'},function(data){
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