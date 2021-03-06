@extends('layout')

@section('content')

    <?php

            $products = \App\Helpers\CatalogViewerHelper::getActualOffersProducts();

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
                    @include('catalog.product_mini_item', ['product' => $product])
                @endforeach
                </div>
                @endforeach
            </div>

        </div>
    </div>

    <script>
        $(document).ready(function(){
            //
        });
    </script>

@endsection
