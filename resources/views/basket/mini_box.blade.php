<?php
/**
 * @var $user \App\User
 */
if (!isset($user)) {
    $user = \App\Helpers\CommonHelper::getCurrentUser();
}

$virtual_user = \App\Helpers\VirtualUserHelper::user();

?>

@if($virtual_user)
    <button class="btn btn-default">{{ $virtual_user->name }}</button>
@endif

@if(!$user)
    <a href="/auth/login">Авторизация</a> | <a href="/auth/register">Регистрация</a>
@endif

<?php

if (!$user) {
    return;
}

$open_orders = $user->orderedProducts()->get();
$open_orders_count_str = $open_orders->count() . ' товаров на ' . $user->getAmountOpenOrders() . ' руб.';

$deferred_products = $user->deferredProducts()->get();
?>
@if( count($deferred_products) )
<div class="btn-group">
    <div class="btn-group">
        <a href="/deferred" class="btn btn-warning">
            <span class="badge" style="position: absolute; margin: -4px 0px 0px -21px;">{{ count($deferred_products) }}</span>
            <span class="glyphicon glyphicon-star"></span>
        </a>
    </div>
    <div class="btn-group dropdown-hover">
        <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" title="{{ $open_orders_count_str }}" style="width: 142px;">
            @if($open_orders->count() < 1)
                <span class="glyphicon glyphicon-shopping-cart"></span>
                Корзина пуста
            @else
                {{ $open_orders->count() }}
                <span class="glyphicon glyphicon-shopping-cart"></span>
                {{ $user->getAmountOpenOrders() }}
                <span class="glyphicon glyphicon-ruble" title="Рубли"></span>
            @endif
        </button>
        <div class="list-group dropdown-menu dropdown-menu-right" style="padding: 0; border: 0; width: 181px">
            <h5 style="color: black">{{ $open_orders_count_str }}</h5>
            <a href="/basket" class="list-group-item">Перейти в корзину</a>
            <a href="/deferred" class="list-group-item">Отложенные товары</a>
            <a href="/history" class="list-group-item">История заказов</a>
        </div>

    </div>
</div>
@else
<div class="btn-group btn-block dropdown-hover">
    <button type="button" class="btn btn-info dropdown-toggle" data-toggle="dropdown" title="{{ $open_orders_count_str }}">
        @if($open_orders->count() < 1)
            <span class="glyphicon glyphicon-shopping-cart"></span>
            Корзина пуста
        @else
            {{ $open_orders->count() }}
            <span class="glyphicon glyphicon-shopping-cart"></span>
            {{ $user->getAmountOpenOrders() }}
            <span class="glyphicon glyphicon-ruble" title="Рубли"></span>
        @endif
    </button>
    <div class="list-group dropdown-menu" style="padding: 0; border: 0; width: 181px">
        <h5 style="color: black">{{ $open_orders_count_str }}</h5>
        <a href="/basket" class="list-group-item">Перейти в корзину</a>
        <a href="/deferred" class="list-group-item">Отложенные товары</a>
        <a href="/history" class="list-group-item">История заказов</a>
    </div>
</div>
@endif