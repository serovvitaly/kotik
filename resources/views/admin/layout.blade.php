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
        .navbar-inverse {
            background-color: #1a5ca0;
            border-color: #17427b;
            box-shadow: 0px 3px 5px rgba(0,0,0,0.2);
        }
        .navbar-inverse .navbar-nav>li>a {
            color: #D4E6F9;
        }
        .navbar-inverse .navbar-nav>.open>a, .navbar-inverse .navbar-nav>.open>a:focus, .navbar-inverse .navbar-nav>.open>a:hover {
            color: #fff;
            background-color: #4178B1;
        }
        .navbar-inverse .navbar-brand {
            color: #ACD4FF;
        }
    </style>

    <script>
        function searchProductByLike(inputEl, targetContainerEl){
            $.ajax({
                url: '/admin/product/search',
                type: 'get',
                dataType: 'json',
                data: {
                    query: $(inputEl).val()
                },
                success: function(data){
                    if (!data.html) return;
                    $(targetContainerEl).html(data.html);
                }
            });
        }
        $(function () {
            $('[data-toggle="tooltip"]').tooltip()
        })
    </script>

</head>
<body>

<nav class="navbar navbar-inverse navbar-static-top">
    <div class="container-fluid">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
            <a class="navbar-brand" href="/admin">Админка</a>
        </div>

        <!-- Collect the nav links, forms, and other content for toggling -->
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-9">
            @if(\Auth::user())
            <ul class="nav navbar-nav">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">Права и пользователи <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if(\Auth::user()->hasRole('users_manager'))<li><a href="/admin/user">Пользователи</a></li>@endif
                        @if(\Auth::user()->hasRole('roles_manager'))<li><a href="/admin/role">Роли</a></li>@endif
                        @if(\Auth::user()->hasRole('permissions_manager'))<li><a href="/admin/permission">Привилегии</a></li>@endif
                    </ul>
                </li>
                <li><a href="/admin/catalog">Каталоги</a></li>
                <li><a href="/admin/offer">Торговые акции</a></li>
                <li><a href="/admin/brand">Брэнды</a></li>
                <li><a href="/admin/product">Товары</a></li>
            </ul>
            <ul class="nav navbar-nav navbar-right">
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">{{ \Auth::user()->email }} <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="/auth/logout">Выход</a></li>
                    </ul>
                </li>
            </ul>
            @endif
        </div><!-- /.navbar-collapse -->
    </div><!-- /.container-fluid -->
</nav>

    <div class="container">
        @yield('content')
    </div>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
</body>
</html>