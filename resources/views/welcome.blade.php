<!DOCTYPE html>
<html>
    <head>
        <title>Laravel</title>
        <link rel="stylesheet" href="{{asset('resources/bootstrap/css/bootstrap.min.css')}}">
        <script type="text/javascript" src="{{asset('resources/views/admin/style/js/jquery.js')}}"></script>
        <script type="text/javascript" src="{{asset('resources/views/home/js/jquery.twbsPagination.min.js')}}"></script>
        {{--<link href="https://fonts.googleapis.com/css?family=Lato:100" rel="stylesheet" type="text/css">--}}

        <style>
            html, body {
                height: 100%;
            }

            body {
                margin: 0;
                padding: 0;
                width: 100%;
                display: table;
                font-weight: 100;
                font-family: 'Lato';
            }

            .container {
                text-align: center;
                display: table-cell;
                vertical-align: middle;
            }

            .content {
                text-align: center;
                display: inline-block;
            }

            .title {
                font-size: 96px;
            }
        </style>
    </head>
    <body>
    <script>

    </script>
        <div class="container">
            <div class="content">

                <div class="title"></div>
                <div id="page-content"></div>
                <ul id="pagination" class="pagination-sm"></ul>
            </div>
        </div>
    <script>
        var artsJson =$.parseJSON({!!$json!!});
        var artData = artsJson.data;
       // var json = artsJson.toJS();
        console.log(artsJson);
        $('#pagination').twbsPagination({
            totalPages:artsJson.per_page,
            visiblePages: 3,
            onPageClick: function (event, page) {
                $('#page-content').text(artData[page-1].art_title);
            }

        });
    </script>
    </body>
</html>
