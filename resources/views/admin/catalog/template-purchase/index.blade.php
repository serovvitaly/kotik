@extends('admin.layout')

@section('table_top_header')

    <?php
        $catalog_id = \Input::get('catalog_id');
        $catalog_model = \App\Models\Catalog::findOrFail($catalog_id);
    ?>

    <h3><a class="btn btn-default" href="/admin/catalog/{{ $catalog_model->id }}/edit">Вернуться к каталогу</a> {{ $catalog_model->name }}</h3>
    <h4>{{ $catalog_model->description }}</h4>

    <ul class="nav nav-pills">
        <li class="active"><a href="/admin/template-purchase?catalog_id={{ $catalog_id }}">Шаблоны закупок</a></li>
        <li><a href="/admin/pricing-column?catalog_id={{ $catalog_id }}">Ценовые колонки</a></li>
        <li><a href="/admin/product?catalog_id={{ $catalog_id }}">Товары</a></li>
    </ul>

@endsection

@section('content')
    @include('admin.common.table')
@endsection
