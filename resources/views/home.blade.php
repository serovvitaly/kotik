@extends('layout')

@section('content')

    <?php

            if (!isset($products)) {
                $products = new \App\Models\Product;
            }

            $products = $products->where('price_1', '>', 0)->paginate(20);

            $products_by_columns = \App\Helpers\CatalogViewerHelper::breakOnColumns($products);

    ?>

    <div class="row">
        <div class="col-lg-2">
            <strong>Брэнд</strong>
            <p>

            </p>
        </div>
        <div class="col-lg-10">
            <div class="row" id="catalog-list">
                @foreach($products_by_columns as $column_products)
                <div class="col-lg-3">
                @foreach($column_products as $product)
                    <?php
                        $image = $product->images()->first();
                    ?>
                    <div class="ct-product-item">
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
                                    <a href="/prod-{{ $product->id }}" style="color: black"><strong style="line-height: 18px; padding-bottom: 5px;" title="{{ $product->name }}">{{ $product->name }}</strong></a>
                                </p>
                                <div style="padding: 5px 0; text-align: center">
                                    <span class="label label-info" title="{{ $product->brand }}">{{ str_limit($product->brand, 28) }}</span>
                                    <span class="label label-default">{{ $product->country_name }}</span>
                                </div>
                                <p style="line-height: 16px; text-align: center">
                                    <small>{{ str_limit($product->description, 255) }}</small>
                                </p>
                                <p>
                                    <h4 style="text-align: center"><strong>{{ $product->getPublicPrice() }}</strong> руб.</h4>
                                </p>
                                <div class="btn-group btn-group-justified">
                                    <div class="btn-group btn-group-sm">
                                        @if($product->isDeferred())
                                        <button class="btn btn-default disabled" title="Этот товар уже есть в отложенных">
                                            <span class="glyphicon glyphicon-star" style="color: red"></span>
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
                @endforeach
                </div>
                @endforeach
            </div>

            {!! $products->render() !!}

        </div>
    </div>

    <script>
        $(document).ready(function(){
            //
        });
    </script>

@endsection
