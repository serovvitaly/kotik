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
<?php
$open_orders_catalogs_ids_arr = $user->getOpenOrdersCatalogsIdsArr();
?>
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
                            {{ $user->getAmountOpenOrders() }}
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

            <p>
                <button class="btn btn-link">
                    <span class="glyphicon glyphicon-menu-hamburger"></span> Отобразить информацию о всех товарах
                </button>
            </p>

            @foreach($open_orders_catalogs_ids_arr as $open_orders_catalog_id)
            <?php
            $catalog_model = \App\Models\Catalog::find($open_orders_catalog_id);
            ?>
            <div class="panel panel-default">
              <div class="panel-heading">
                  <div class="row">
                      <div class="col-lg-9">
                          <strong>{{ $catalog_model->purchase_title }}</strong>
                          <a href="#" class="glyphicon glyphicon-link"></a>
                      </div>
                      <div class="col-lg-3 text-right">
                          <a href="#"><span class="glyphicon glyphicon-eye-close" style="padding-right: 5px"></span> <strong>5 отложенных товаров</strong></a>
                      </div>
                  </div>
              </div>
              <div class="panel-body">
                <p>Информация о закупке</p>

                <div class="row" style="text-align: right;">
                    <div class="col-lg-6">
                        Итого к оплате:
                        {{ $user->getAmountOpenOrders($open_orders_catalog_id) }}
                        <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                    </div>
                    <div class="col-lg-6">
                        <button class="btn btn-default" data-toggle="popover" data-placement="top" data-trigger="focus">
                            Отказаться от заказа
                        </button>
                        <button class="btn btn-success">
                            <span class="glyphicon glyphicon-thumbs-up"></span>
                            Оформить заказ
                        </button>
                    </div>
                </div>
              </div>

              <table class="table table-striped table-hover">
                  <!--caption>Товары в заказе</caption-->
                  <colgroup>
                      <col>
                      <col width="140">
                      <col width="130">
                      <col width="100">
                      <col width="195">
                  </colgroup>
                  <thead>
                      <tr>
                          <th colspan="5">Товары в заказе</th>
                      </tr>
                  </thead>
                  <tbody>

                  @foreach($user->openOrders($open_orders_catalog_id)->get() as $order)
                      <?php
                      $image = $order->product->images()->first();
                      ?>
                      <tr id="order-item-{{ $order->id }}">
                          <td>
                              <a href="/prod-{{ $order->product->id }}"><strong>{{ $order->product->name }}</strong></a>
                              <p>
                                  <button class="btn btn-xs btn-link">
                                      <span class="glyphicon glyphicon-menu-hamburger"></span> Информация о товаре
                                  </button>
                              </p>
                              <div class="panel panel-default" style="margin: 0; display: none;">
                                  <div class="panel-body">
                                      <div class="media">
                                          <div class="media-left">
                                                @if(!$image)
                                                    X
                                                @elseif(empty($image->file_name))
                                                    <img src="/media/images/64x64/empty?mid={{ $image->id }}" alt="" style="width: 64px; height: 64px;">
                                                @else
                                                    <img src="/media/images/64x64/{{ $image->file_name }}" alt="" style="width: 64px; height: 64px;">
                                                @endif
                                          </div>
                                          <div class="media-body">
                                              {{ str_limit($order->product->description, 140) }}
                                          </div>
                                      </div>
                                  </div>
                              </div>
                          </td>
                          <td style="text-align: right; padding-right: 30px;">
                              <strong style="font-size: 16px; line-height: 30px;">{{ $order->getProductPublicPrice() }}</strong>
                              <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                          </td>
                          <td>
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="App.changeOrderQuantity({{ $order->id }}, -1, this);">
                                        <span class="glyphicon glyphicon-minus"></span>
                                    </button>
                                </span>
                                <input type="text" class="form-control quantity-value" value="{{ $order->quantity }}" style="text-align: center">
                                <span class="input-group-btn">
                                    <button class="btn btn-default" type="button" onclick="App.changeOrderQuantity({{ $order->id }}, +1, this);">
                                        <span class="glyphicon glyphicon-plus"></span>
                                    </button>
                                </span>
                            </div>
                          </td>
                          <td style="text-align: right">
                              <strong style="font-size: 16px; line-height: 30px;">{{ $order->getAmount() }}</strong>
                              <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                          </td>
                          <td style="text-align: right">
                              <button class="btn btn-danger btn-sm" onclick="App.deleteOrderFromBasket('{{ $order->id }}', this);">Удалить</button>
                              <button class="btn btn-default btn-sm">Отложить</button>
                          </td>
                      </tr>
                  @endforeach
                  </tbody>
              </table>

              <div class="panel-footer" style="text-align: right;">
                  <div class="row">
                      <div class="col-lg-6"></div>
                      <div class="col-lg-2" style="text-align: left">
                          <strong style="font-size: 17px; line-height: 30px;">Итого в закупке:</strong>
                      </div>
                      <div class="col-lg-1" style="text-align: left">
                          <strong style="font-size: 16px; line-height: 30px;">8шт. на</strong>
                      </div>
                      <div class="col-lg-1">
                          <strong style="font-size: 16px; line-height: 30px;">9950000</strong>
                          <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                      </div>
                  </div>
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
