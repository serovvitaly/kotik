<?php

if ( ! isset($product_id) ) {

    return;
}

$product_model = \App\Models\Product::findOrFail($product_id);

?>

@if ($product_model->offers_count == 1)
    <h4 style="text-align: center"><strong>{{ $product->getPublicPrice() }}</strong> руб.</h4>
    <div class="form-inline">
        <input type="text" id="product-quantity-input-{{ $id }}" class="form-control" value="1" style="width: 70px; text-align: center">
        <button type="button" class="btn btn-danger" onclick="App.putProductInBasket('{{ $id }}', $('#product-quantity-input-{{ $id }}').val())">
            <span class="glyphicon glyphicon-shopping-cart"></span> В корзину
        </button>
    </div>
@elseif($product_model->offers_count > 1)

    <div class="list-group">
        @foreach($product_model->getActualProductOffers() as $product_offer)
        <div class="list-group-item">
            <div class="row">
                <div class="col-lg-10">
                    <h4 class="list-group-item-heading">{{ $product_offer->offer->title }}</h4>
                    <p class="list-group-item-text">Donec id elit non mi porta gravida at eget metus. Maecenas sed diam eget risus varius blandit.</p>
                    {{ $product_offer->price }}
                </div>
                <div class="col-lg-2">
                    <button type="button" class="btn btn-danger" onclick="App.putProductInBasket('1', $('#product-quantity-input-1').val())">
                        <span class="glyphicon glyphicon-shopping-cart"></span> В корзину
                    </button>
                </div>
            </div>
        </div>
        @endforeach
    </div>

@else
нет предложений
@endif
