<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="/frontend/base-styles.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
    {{--<script src="https://ajax.googleapis.com/ajax/libs/angularjs/1.4.2/angular.min.js"></script>--}}

    <style>
        /*.navbar .dropdown-menu{*/
            /*border: 2px solid #C1C1C1;*/
            /*background-color: white;*/
        /*}*/
        .dropdown-danger{border-color: #e74c3c !important;}
        .dropdown-warning{border-color: #f1c40f !important;}
        .dropdown-info{border-color: #3498db !important;}
        .dropdown-success{border-color: #2ecc71 !important;}
        .dropdown-primary{border-color: #337ab7 !important;}
        .dropdown-default{border-color: #bdc3c7 !important;}

        .dropdown-danger a:hover{background: #e74c3c !important; color: white !important;}
        .dropdown-warning a:hover{background: #f1c40f !important; color: white !important;}
        .dropdown-info a:hover{background: #3498db !important; color: white !important;}
        .dropdown-success a:hover{background: #2ecc71 !important; color: white !important;}
        .dropdown-primary a:hover{background: #337ab7 !important; color: white !important;}
        .dropdown-default a:hover{background: #bdc3c7 !important; color: white !important;}


        @font-face {
            font-family: 'EtelkaLightRegular';
            src: url('/fonts/etelkalightwebfont.eot');
            src: url('/fonts/etelkalightwebfont.eot?#iefix') format('embedded-opentype'),
                 url('/fonts/etelkalightwebfont.woff') format('woff'),
                 url('/fonts/etelkalightwebfont.ttf') format('truetype'),
                 url('/fonts/etelkalightwebfont.svg#EtelkaLightRegular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'ElektraTextProRegular';
            src: url('/fonts/etelkatext-webfont.eot');
            src: url('/fonts/etelkatext-webfont.eot?#iefix') format('embedded-opentype'),
                 url('/fonts/etelkatext-webfont.woff') format('woff'),
                 url('/fonts/etelkatext-webfont.ttf') format('truetype'),
                 url('/fonts/etelkatext-webfont.svg#ElektraTextProRegular') format('svg');
            font-weight: normal;
            font-style: normal;
        }

        @font-face {
            font-family: 'ElektraMediumProRegular';
            src: url('/fonts/etelkamedium-webfont.eot');
            src: url('/fonts/etelkamedium-webfont.eot?#iefix') format('embedded-opentype'),
                 url('/fonts/etelkamedium-webfont.woff') format('woff'),
                 url('/fonts/etelkamedium-webfont.ttf') format('truetype'),
                 url('/fonts/etelkamedium-webfont.svg#ElektraMediumProRegular') format('svg');
            font-weight: normal;
            font-style: normal;

        }

        .font-etelka-medium{
            font-family: 'ElektraMediumProRegular', Verdana, sans-serif;
        }
        .font-elektra-text{
            font-family: 'ElektraTextProRegular', Verdana, sans-serif;
        }
        .font-elektra-light{
            font-family: 'EtelkaLightRegular', Verdana, sans-serif;
        }

        .text-mod{
            font-family: 'ElektraTextProRegular', Verdana, sans-serif;
            font-size: 15px;
            font-weight: normal;
            line-height: 19px;
        }

        body{
            /*background: #F1F1F1;*/
        }
        .item .thumbnail{
            border-color: transparent #cecece #adadac;
            box-shadow: 0px 1px 2px rgba(1, 1, 0, 0.1);
        }
        .dropdown-hover .dropdown-menu{
            margin: 0;
        }
        .dropdown-hover:hover .dropdown-menu{
            display: block;
        }
        .borders{
            border-top: 1px solid;
            margin-top: 16px;
            text-align: center;
            font-size: 74%;
        }
        .table-borderless td,
        .table-borderless th{
            border: 0 !important
        }
    </style>

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-2">Top menu</div>
        <div class="col-lg-2">Москва</div>
        <div class="col-lg-8">доп меню</div>
    </div>
</div>

<header class="navbar navbar-inverse navbar-static-top">
    <div class="container" style="padding-top: 7px">
        <div class="row">
            <div class="col-lg-12">

                <div class="row">
                    <div class="col-lg-2">
                        <div class="btn-group btn-block dropdown-hover">
                            <button type="button" class="btn btn-danger dropdown-toggle btn-block" data-toggle="dropdown">
                                Каталог товаров
                                <span style="padding-left: 13px" class="glyphicon glyphicon-menu-hamburger"></span>
                            </button>

                                <div class="list-group dropdown-menu" style="padding: 0; border: 0; width: 181px">
                                    <a href="#" class="list-group-item">Уход за волосами</a>
                                    <a href="#" class="list-group-item">Уход за лицом</a>
                                    <a href="#" class="list-group-item">Уход за телом</a>
                                    <a href="#" class="list-group-item">Уход за руками</a>
                                    <a href="#" class="list-group-item">Уход за ногами</a>
                                </div>

                        </div>

                    </div>
                    <div class="col-lg-8">
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="что вы ищите?">
                            <span class="input-group-btn">
                                <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                            </span>
                        </div>
                    </div>

                    <div class="col-lg-2" id="basket-mini-box" style="color: #fff;">
                        @include('basket.mini_box')
                    </div>
                </div>

                {{--@include('catalog.catalog_items')--}}
            </div>
        </div>
    </div>
</header>

<div class="container">
    @yield('content')
</div>
{{--<script src="/public/Grid-A-Licious/jquery.grid-a-licious.min.js"></script>--}}
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
<script src="/app.js"></script>
<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();
    })
</script>
</body>
</html>
