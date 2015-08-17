<?php

/**
 * @var $user \App\User
 */

if (!isset($user)) {
    $user = \Auth::user();
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

?>

@if($open_orders->count() < 1)
    Корзина пуста
@else
    {{ $open_orders->count() }} товаров на {{ $user->getAmountOpenOrders() }} руб.
@endif
