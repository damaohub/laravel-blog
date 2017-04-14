@extends('layouts.home')
@section('content')



    <div class="row">

            <div class="panel panel-default">
                <div class="panel-body">

                    @foreach($arts as $k=>$v)
                        <div class="j-togList indexList col-sm-6 col-md-4 col-lg-3">
                    <div class="tog1  thumbnail">
                <a class="tog2" href="{{url('a/'.$v->art_id)}}"><img class=" tog3 lazy" src="{{$v->art_thumb?url($v->art_thumb):'holder.js/100x62?auto=yes&random=yes&size=8&text='.$v->art_title.''}}" alt="{{$v->art_title}}" title="{{$v->art_title}}"></a>
                    <div class="tog4 caption">
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
    <div class="text-center">{!!$arts->render()!!}</div>

@endsection

