<?php
/**
 * @var $user \App\User
 */
if (!isset($user)) {
    $user = \App\Helpers\CommonHelper::getCurrentUser();
}
?>

@if(!$user)
    <a href="/auth/login">Авторизация</a> | <a href="/auth/register">Регистрация</a>
@endif

<?php

if (!$user) {
    return;
}

$open_orders = $user->openOrders()->get();
$open_orders_count_str = $open_orders->count() . ' товаров на ' . $user->getAmountOpenOrders() . ' руб.';

?>
<div class="btn-group btn-block dropdown-hover">
    <button type="button" class="btn btn-info dropdown-toggle btn-block" data-toggle="dropdown" title="{{ $open_orders_count_str }}">
        <span class="glyphicon glyphicon-shopping-cart"></span>
        @if($open_orders->count() < 1)
            Корзина пуста
        @else
            {{ str_limit($open_orders_count_str, 18) }}
        @endif
    </button>
    <div class="list-group dropdown-menu" style="padding: 0; border: 0; width: 181px">
        <h5 style="color: black">{{ $open_orders_count_str }}</h5>
        <a href="/basket" class="list-group-item">Перейти в корзину</a>
    </div>

</div>
