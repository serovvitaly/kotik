<?php
/**
 * @var $user \App\User
 */
if (!isset($user)) {
    $user = \App\Helpers\CommonHelper::getCurrentUser();
}
$deferred_products = $user->deferredProducts()->get();
?>
@if($deferred_products->count())
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

            @foreach($deferred_products as $ordered_product)
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
                    <td>
                        <div class="btn-group btn-group-justified">
                            <div class="btn-group">
                                <button class="btn btn-danger btn-sm" onclick="App.dropDeferredProduct('{{ $ordered_product->id }}', this);">Удалить</button>
                            </div>
                            <div class="btn-group">
                                @if( $ordered_product->product->isOrdered() )
                                    <a href="/basket" class="btn btn-default btn-sm" title="Товар уже в корзине">
                                        В корзине
                                    </a>
                                @else
                                    <button class="btn btn-success btn-sm" onclick="App.putProductInBasket('{{ $ordered_product->product_id }}', 1, this)">
                                        <span class="glyphicon glyphicon-shopping-cart"></span>
                                        В корзину
                                    </button>
                                @endif
                            </div>
                        </div>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
</div>
@endif