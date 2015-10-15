@extends('admin.layout')

@section('content')

    <a class="btn btn-link" href="/auth/register">Регистрация</a>

    <div class="row">
        <div class="col-lg-4">
            <form method="POST" action="/auth/login">
                {!! csrf_field() !!}
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control" placeholder="Email" name="email" value="{{ old('email') }}">
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" name="password" placeholder="Password">
                </div>
                <div class="checkbox">
                    <label>
                        <input type="checkbox" name="remember"> Remember Me
                    </label>
                </div>
                <button type="submit" class="btn btn-default">Login</button>
            </form>
        </div>
        <div class="col-lg-4">
            <a href="#"  class="btn btn-default btn-primary" onclick="openVkWindow(); return false;">Вконтакте</a>
            <a href="#"  class="btn btn-default btn-warning" onclick="openOkWindow(); return false;">Одноклассники</a>
        </div>
    </div>

    <script>

        function popupwindow(url, title, w, h) {
            console.log(screen);
            var left = (screen.width/2)-(w/2);
            var top = (screen.height/2)-(h/2);
            return window.open(url, title, 'toolbar=no, location=no, directories=no, status=no, menubar=no, scrollbars=no, resizable=no, copyhistory=no, width='+w+', height='+h+', top='+top+', left='+left);
        }

        function openVkWindow(){
            popupwindow("{!! \App\Http\Controllers\OAuthController::getVkUrl() !!}", "VK", 200, 100);
        }
        function openOkWindow(){
            popupwindow("{!! \App\Http\Controllers\OAuthController::getOkUrl() !!}", "OK", 200, 100);
        }
    </script>
@endsection
