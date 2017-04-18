@extends('layouts.home')
@section('title',$field->cate_name.'-')

@section('content')

    <div class="row">
        <div class="panel panel-default">
        <div class="panel-body">
        @foreach($data as $k=>$v)
            <div class="j-togList mediaList">
                <div class="tog1  media">
                    <a class="tog2 media-left" href="{{url('a/'.$v->art_id)}}"><img class=" tog3 lazy" src="{{$v->art_thumb?url($v->art_thumb):'holder.js/100x62?auto=yes&random=yes&size=8&text='.$v->art_title.''}}" alt="{{$v->art_title}}" title="{{$v->art_title}}"></a>
                    <div class="tog4 media-body">
                        <h4>
                            <a href="{{url('a/'.$v->art_id)}}">{{$v->art_title}}</a></h4>
                        <p>{{str_limit($v->art_description,96)}}</p>
                    </div>
                </div>
            </div>
        @endforeach
        </div>
        </div>
    </div>
    <div class="text-center">{!!$data->render()!!}</div>
@endsection

