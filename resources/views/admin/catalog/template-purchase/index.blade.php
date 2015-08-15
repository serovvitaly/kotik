@extends('admin.layout')

@section('table_top_header')

    <?php
        $catalog_model = \App\Models\Catalog::findOrFail($catalog_id);
    ?>

    <h3><a class="btn btn-default" href="/admin/catalog/{{ $catalog_model->id }}/edit">Вернуться к каталогу</a> {{ $catalog_model->name }}</h3>
    <h4>{{ $catalog_model->description }}</h4>

    <ul class="nav nav-pills">
        <li class="active"><a href="/admin/{{ $catalog_id }}/template-purchase">Шаблоны закупок</a></li>
        <li><a href="/admin/{{ $catalog_id }}/pricing-column">Ценовые колонки</a></li>
        <li><a href="/admin/{{ $catalog_id }}/product">Товары</a></li>
    </ul>

@endsection

@section('content')
    @include('admin.common.table')
@endsection
