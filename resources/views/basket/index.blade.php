@extends('layout')

@section('content')
<?php
/**
 * @var $user \App\User
 */
if (!isset($user)) {
    $user = \App\Helpers\CommonHelper::getCurrentUser();
}

$open_orders_catalogs_ids_arr = $user->getOpenOrdersCatalogsIdsArr();

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
            @foreach($open_orders_catalogs_ids_arr as $open_orders_catalog_id)
            <div class="panel panel-default">
              <div class="panel-heading"><strong>Закупка косметики и парфюмерных товаров</strong> <a href="#" class="glyphicon glyphicon-link"></a></div>
              <div class="panel-body">
                <p>Информация о закупке</p>
              </div>

              <table class="table table-striped table-hover">
                  <caption>Товары в заказе</caption>
                  <colgroup>
                      <col>
                      <col width="140">
                      <col width="130">
                      <col width="100">
                      <col width="190">
                  </colgroup>
                  <tbody>

                  @foreach($user->openOrders($open_orders_catalog_id)->get() as $order)
                      <tr id="order-item-{{ $order->id }}">
                          <td>{{ $order->product->name }}</td>
                          <td style="text-align: right; padding-right: 30px;">
                              <strong style="font-size: 16px; line-height: 30px;">{{ $order->public_price }}</strong>
                              <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                          </td>
                          <td>
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="changeQuantityProductInBasket({{ $order->product->id }}, {{ $order->id }}, -1);">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" class="form-control quantity-value" value="{{ $order->quantity }}" style="text-align: center">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="changeQuantityProductInBasket({{ $order->product->id }}, {{ $order->id }}, +1);">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                          </td>
                          <td style="text-align: right">
                              <strong style="font-size: 16px; line-height: 30px;">{{ $order->public_price * $order->quantity }}</strong>
                              <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                          </td>
                          <td style="text-align: right">
                              <button class="btn btn-danger btn-sm">Удалить</button>
                              <button class="btn btn-default btn-sm">Отложить</button>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>

              <div class="panel-footer">
                  <button class="btn btn-default" data-toggle="popover" data-placement="top" data-trigger="focus">Отказаться от заказа</button>
                  <button class="btn btn-success">Оформить заказ</button>
              </div>
            </div>
            @endforeach
        </div>
    </div>

    <div id="cancel-the-order-popover-html" style="display: none">
        <strong>Удаление заказа</strong>
        <br>
        <button class="btn btn-danger btn-sm">Удалить заказ</button>
        <button class="btn btn-default btn-sm">Закрыть</button>
    </div>

    <script type="text/javascript">
        function changeQuantityProductInBasket(productId, orderId, top){
            var inputEl = $('#order-item-'+orderId+' input.quantity-value');
            var oldValue = inputEl.val() * 1;
            var newValue = oldValue + top;
            if (newValue < 1) {
                return;
            }
            inputEl.val(newValue);
            console.log(newValue);
        }
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
