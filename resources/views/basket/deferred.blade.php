@extends('layout')

@section('content')
    <?php
    /**
     * @var $user \App\User
     */
    if (!isset($user)) {
        $user = \App\Helpers\CommonHelper::getCurrentUser();
    }
    ?>
    @if($user)
        <div>
            <div class="row">
                <div class="col-lg-10">
                    <ol class="breadcrumb">
                        <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                        <li class="active">Отложенные товары</li>
                    </ol>
                </div>
                <div class="col-lg-2">

                </div>
            </div>

            <div class="row">
                <div class="col-lg-12">

                    <p>
                        <button class="btn btn-link">
                            <span class="glyphicon glyphicon-menu-hamburger"></span> Отобразить информацию о всех товарах
                        </button>
                    </p>

                    <div id="deferred-products-container">
                        @include('basket.deferred_items')
                    </div>

                </div>
            </div>

            <div id="cancel-the-order-popover-html" style="display: none">
                <strong>Удаление заказа</strong>
                <br>
                <button class="btn btn-danger btn-sm">Удалить заказ</button>
                <button class="btn btn-default btn-sm">Закрыть</button>
            </div>

            <script type="text/javascript">
                $(function () {
                    $('[data-toggle="popover"]').popover({
                        html: true,
                        content: $('#cancel-the-order-popover-html').html()
                    });
                })
            </script>
        </div>
    @else
        Корзина пользователя
    @endif

@endsection
