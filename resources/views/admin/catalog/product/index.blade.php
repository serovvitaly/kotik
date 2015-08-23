@extends('admin.layout')

@section('content')

    <?php

    $catalog_model = \App\Models\Catalog::findOrFail($catalog_id);

    $model = new $model_name;

    $fields_arr = array_diff($model->getFillable(), $model->getHidden());

    if (!isset($paginate_count)) {
        $paginate_count = 30;
    }

    if ( ! isset($model_items) ) {
        $model_items = $model_name::paginate($paginate_count);
    }

    ?>

    <h3><a class="btn btn-default" href="/admin/catalog/{{ $catalog_model->id }}/edit">Вернуться к каталогу</a> {{ $catalog_model->name }}</h3>
    <h4>{{ $catalog_model->description }}</h4>

    <ul class="nav nav-pills">
        <li><a href="/admin/{{ $catalog_id }}/template-purchase">Шаблоны закупок</a></li>
        <li><a href="/admin/{{ $catalog_id }}/pricing-column">Ценовые колонки</a></li>
        <li class="active"><a href="/admin/{{ $catalog_id }}/product">Товары</a></li>
    </ul>


    <h3>{{ $model_name }}</h3>

    <div class="row">
        <div class="col-lg-1">
            <div class="btn-toolbar" role="toolbar" style="margin-bottom: 10px">
                <a class="btn btn-info" href="/admin/{{ $route_base_url }}/create">Добавить</a>
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
        @include('admin.catalog.product.table')
    </div>

@endsection
