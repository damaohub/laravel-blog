<div class="col-sm-12 col-md-3">
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">最新文章</h3>
        </div>
        <div class="panel-body">


            @foreach($lasts as $k=>$v)
                <div class="media side-meida">
                    <div class="media-left media-top">
                        <a href="{{url('a/'.$v->art_id)}}">
                            <img class="media-object img-circle" src="{{$v->art_thumb?url($v->art_thumb):'holder.js/100x62?auto=yes&random=yes&size=5&text='.$v->art_title.''}}" alt="{{$v->art_title}}" title="{{$v->art_title}}">
                        </a>
                    </div>
                    <div class="media-body">
                        <h4 class="media-heading"><a href="{{url('a/'.$v->art_id)}}">{{$v->art_title}}</a></h4>
                        <small><i class="fa fa-clock-o"></i>{{date('m-d',$v->art_time)}}</small>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">分类</h3>
        </div>
        <div class="panel-body">
            <div class="list-group">
                @foreach($cates as $k=>$v)
                    <a href="{{url('cate/'.$v->cate_id)}}" class="list-group-item">
                        <span class="badge">{{\App\Http\Model\Article::where('cate_id','=',$v->cate_id)->count()}}</span>
                        {{$v->cate_name}}
                    </a>
                @endforeach
            </div>
        </div>
    </div>
    <div class="panel panel-default">
        <div class="panel-heading">
            <h3 class="panel-title">标签云</h3>
        </div>
        <div class="panel-body">

            <div class="tags">
                @foreach($tags as $k=>$v)
                    <a href="" class="btn btn-info" data-toggle="tooltip" data-placement="top" title="{{'此标签下有'.\App\Http\Model\Article::where('art_tag','=',$v)->count().'篇文章'}}">{{$v}}</a>
                @endforeach
            </div>
        </div>
    </div>
</div>