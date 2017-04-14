<nav class="navbar navbar-default">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse-1" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="{{url('/')}}">
                <span class="icon-M"></span>
            </a>
        </div>
        <div class="navbar-collapse collapse" id="navbar-collapse-1">
            <ul class="nav navbar-nav">
                @foreach($navs as $k=>$v)
                    <li><a href="{{url($v->nav_url)}}">{{$v->nav_name}}</a></li>
                @endforeach
            </ul>
        </div>
    </div>
</nav>