<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')damaohub</title>
    <meta name="keywords" content="@yield('keywords')">
    <meta name="description" content="@yield('description')">
    <meta http-equiv="content-type" content="text/html;charset=utf-8">
    <meta name="_token" content="{{ csrf_token() }}"/>
    <link rel="shortcut icon" type="image/ico" href="{{asset('favicon.ico')}}">
    <link rel="stylesheet" href="{{asset('assets/css/blog.min.css')}}">
    <script type="text/javascript" src="{{asset('assets/js/blog.min.js')}}"></script>

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