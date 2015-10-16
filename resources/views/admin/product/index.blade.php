@extends('admin.layout')

@section('content')

    <?php
    $model_items = \App\Models\Product::paginate(30);
    ?>

    <h3>Товары</h3>

    <div class="row">
        <div class="col-lg-1">
            <div class="btn-toolbar" role="toolbar" style="margin-bottom: 10px">
                <a class="btn btn-info" href="/admin/product/create">Добавить</a>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="input-group">
                <input type="text" class="form-control" placeholder="маска наименования товара" id="input-search-like">
          <span class="input-group-btn">
            <button class="btn btn-default" type="button" onclick="searchProductByLike('#input-search-like', '#products-target-container')">Go!</button>
          </span>
            </div><!-- /input-group -->
        </div>
    </div>

    <div id="products-target-container">
        @include('admin.product.table')
    </div>

@endsection
