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
        <div ng-controller="BasketController">
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



                        <div class="panel panel-default">
                            <div class="panel-body">
                                <table class="table table-striped table-hover">
                                    <!--caption>Товары в заказе</caption-->
                                    <colgroup>
                                        <col>
                                        <col width="140">
                                        <col width="195">
                                    </colgroup>
                                    <thead>
                                    <tr>
                                        <th colspan="5">Отложенные товары</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach($user->deferredProducts()->get() as $ordered_product)
                                        <?php
                                        $image = $ordered_product->product->images()->first();
                                        ?>
                                        <tr id="order-item-{{ $ordered_product->id }}">
                                            <td>
                                                <a href="/prod-{{ $ordered_product->product->id }}"><strong>{{ $ordered_product->product->name }}</strong></a>
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
                                                                {{ str_limit($ordered_product->product->description, 140) }}
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                            <td style="text-align: right; padding-right: 30px;">
                                                <strong style="font-size: 16px; line-height: 30px;">{{ $ordered_product->getProductPublicPrice() }}</strong>
                                                <span style="color: #49C2FF" class="glyphicon glyphicon-ruble" title="Рубли"></span>
                                            </td>
                                            <td style="text-align: right">
                                                <button class="btn btn-danger btn-sm" onclick="App.dropDeferredProduct('{{ $ordered_product->id }}', this);">Удалить</button>
                                                <button class="btn btn-success btn-sm">
                                                    <span class="glyphicon glyphicon-shopping-cart"></span>
                                                    В корзину
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
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
