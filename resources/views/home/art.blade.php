@extends('layouts.home')
@section('title',$field->art_title.'-')
@section('pageDesc','')
@section('main')
    <div class="panel panel-default panel-article">
        <div class="panel-body alticle">
            <h1 class="text-center">{{$field->art_title}}</h1>
            <ul class="list-inline text-center article-mate">
                <li><i class="fa fa-user-o"></i>{{$field->art_editor}}<li>
                <li><i class="fa fa-clock-o"></i>{{date('Y-m-d',$field->art_time)}}<li>
                <li><i class="fa fa-tags"></i>{{$field->art_tag}}<li>
            </ul>
            {!!$field->art_content!!}
        </div>
    </div>



@endsection

