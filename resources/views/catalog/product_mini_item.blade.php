<?php
$image = $product->images()->first();
?>
<div class="ct-product-item" id="product-mini-item-{{ $product->id }}">
    <div class="thumbnail">

        @if(\Auth::user() and \Auth::user()->hasRole('moderator'))
            <div class="btn-group btn-group-xs" style="margin: -15px 0px 0px -17px; position: absolute;">
                <div class="btn-group btn-group-xs">
                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                        <span class="glyphicon glyphicon-cog"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a target="_blank" href="/admin/{{ $product->catalog->id }}/product/{{ $product->id }}/edit">Изменить</a></li>
                        <li><a target="_blank" href="#">Удалить</a></li>
                    </ul>
                </div>
            </div>
        @endif

        <div style="width: 209px; height: 209px;">
            @if(!$image)
                X
            @elseif(empty($image->file_name))
                <img src="/media/images/250x200/empty?mid={{ $image->id }}" alt="" style="width:100%;">
            @else
                <img src="/media/images/250x200/{{ $image->file_name }}" alt="" style="width:100%;">
            @endif
        </div>
        <div class="caption">
            <p style="text-align: center">
                <a href="/prod-{{ $product->id }}" style="color: black" class="text-mod" title="{{ $product->name }}">{{ $product->name }}</a>
            </p>
            <div style="padding: 5px 0; text-align: center">
                <span class="label label-info" title="{{ $product->brand }}">{{ str_limit($product->brand, 28) }}</span>
                <span class="label label-default">{{ $product->country_name }}</span>
            </div>
            <p style="line-height: 16px; text-align: center">
                <small>{{ str_limit($product->description, 120) }}</small>
            </p>
            <p>
            <h4 style="text-align: center"><strong>{{ $product->getPublicPrice() }}</strong> руб.</h4>
            </p>
            <div class="btn-group btn-group-justified">
                <div class="btn-group btn-group-sm">
                    @if($product->isDeferred())
                        <button class="btn btn-warning disabled" title="Этот товар уже есть в отложенных">
                            <span class="glyphicon glyphicon-star"></span>
                            Отложен
                        </button>
                    @else
                        <button class="btn btn-default" onclick="App.putProductInDeferred('{{ $product->id }}', this)">
                            <span class="glyphicon glyphicon-star-empty"></span>
                            Отложить
                        </button>
                    @endif
                </div>
                <div class="btn-group btn-group-sm">
                    @if($product->isOrdered())
                        <button class="btn btn-info" onclick="App.putProductInBasket('{{ $product->id }}', 1, this)">
                            <span class="glyphicon glyphicon-plus"></span>
                            Пополнить
                        </button>
                    @else
                        <button class="btn btn-success" onclick="App.putProductInBasket('{{ $product->id }}', 1, this)">
                            <span class="glyphicon glyphicon-shopping-cart"></span>
                            В корзину
                        </button>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>