<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>@yield('title')damaohub</title>
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" type="image/ico" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/base.css')}}">
    <link rel="stylesheet" href="{{elixir('assets/css/app.css')}}">
    <script type="text/javascript" src="{{asset('assets/js/base.js')}}"></script>
    <script type="text/javascript" src="{{elixir('assets/js/app.js')}}"></script>
</head>
<body>

    @include('layouts.partials.nav')

    <div class="container">
        <div class="row">
            @section('main')

                <div class="col-sm-12 col-md-9">
                    @yield('content')
                </div>

                @include('layouts.partials.aside')

           @show
        </div>

    </div>


</body>
</html>