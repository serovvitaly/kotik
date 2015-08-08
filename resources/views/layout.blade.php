<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title></title>

    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flat-ui/2.2.2/css/flat-ui.min.css">

</head>
<body>

<div class="container">
    <div class="row">
        <div class="col-lg-2">Top menu</div>
        <div class="col-lg-2">Москва</div>
        <div class="col-lg-8">доп меню</div>
    </div>
</div>

<header class="navbar navbar-static-top bs-docs-nav" style="margin: 0; padding: 20px 0; background: #ff6f00">
    <div class="container">
        <div class="row">
            <div class="col-lg-1"><a href="/">ЛОГО</a></div>
            <div class="col-lg-8">
                <input type="text" class="form-control" placeholder="Default input">
            </div>
            <div class="col-lg-1">Корзина</div>
            <div class="col-lg-2">Авторизация</div>
        </div>
    </div>
</header>

<header class="navbar navbar-inverse navbar-static-top bs-docs-nav">
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.4/jquery.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>