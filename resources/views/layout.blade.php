<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <!--link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.2.2/css/flat-ui.min.css"-->

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>

    <style>
        .navbar .dropdown-menu{
            border: 2px solid #C1C1C1;
            background-color: white;
        }
        .dropdown-danger{border-color: #e74c3c !important;}
        .dropdown-warning{border-color: #f1c40f !important;}
        .dropdown-info{border-color: #3498db !important;}
        .dropdown-success{border-color: #2ecc71 !important;}
        .dropdown-primary{border-color: #1abc9c !important;}
        .dropdown-default{border-color: #bdc3c7 !important;}

        .dropdown-danger a:hover{background: #e74c3c !important; color: white !important;}
        .dropdown-warning a:hover{background: #f1c40f !important; color: white !important;}
        .dropdown-info a:hover{background: #3498db !important; color: white !important;}
        .dropdown-success a:hover{background: #2ecc71 !important; color: white !important;}
        .dropdown-primary a:hover{background: #1abc9c !important; color: white !important;}
        .dropdown-default a:hover{background: #bdc3c7 !important; color: white !important;}
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

<header class="navbar navbar-static-top" style="margin: 0; padding: 20px 0; background: #ff6f00">
    <div class="container">
        <div class="row">
            <div class="col-lg-1"><a href="/" style="color: white; font-size: 24px; text-shadow: 1px 1px 1px rgba(0,0,0,0.3);">smag<strong>24</strong></a></div>
            <div class="col-lg-8">
                <div class="input-group">
                    <input type="text" class="form-control" placeholder="что вы ищите?">
                    <span class="input-group-btn">
                        <button class="btn btn-default" type="button"><span class="glyphicon glyphicon-search"></span></button>
                    </span>
                </div>
            </div>
            <div class="col-lg-1">Корзина</div>
            <div class="col-lg-2">Авторизация</div>
        </div>
    </div>
</header>

<header class="navbar navbar-inverse navbar-static-top">
    <div class="container" style="padding: 5px 15px 0">
        <div class="row">
            <div class="col-lg-12">
                @include('catalog.catalog_items')
            </div>
        </div>
    </div>
</header>

<div class="container">
    @yield('content')
</div>
<script src="/public/Grid-A-Licious/jquery.grid-a-licious.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>