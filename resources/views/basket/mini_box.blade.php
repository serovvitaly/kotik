<?php

/**
 * @var $user \App\User
 */

if (!isset($user)) {
    $user = \Auth::user();
}

$open_orders = $user->openOrders()->get();

?>

@if($open_orders->count() < 1)
    Корзина пуста
@else
    {{ $open_orders->count() }} товаров на {{ $user->getAmountOpenOrders() }} руб.
@endif
