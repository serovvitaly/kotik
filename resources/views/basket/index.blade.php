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
    <div class="row">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">Корзина</li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <div class="panel panel-default">
                <div class="panel-body">
                    <p>Информация о закупке</p>

                    <div class="row" style="text-align: right;">
                        <div class="col-lg-6">
                            Итого к оплате:
                            <span id="basket-total-sum">{{ $user->getAmountOpenOrders() }}</span>
                            <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                        </div>
                        <div class="col-lg-6">
                            <button class="btn btn-default btn-lg" data-toggle="popover" data-placement="top" data-trigger="focus">
                                Отказаться от всех заказов
                            </button>
                            <button class="btn btn-success btn-lg">
                                <span class="glyphicon glyphicon-thumbs-up"></span>
                                Оформить все заказы
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <div id="basket-orders-container">
                @include('basket.orders_items')
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

@else
    Корзина пользователя
@endif

@endsection
