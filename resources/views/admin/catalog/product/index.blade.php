@extends('admin.layout')

@section('content')

    <?php
    $catalog_id = \Input::get('catalog_id', 1);
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
        <li><a href="/admin/template-purchase?catalog_id={{ \Input::get('catalog_id') }}">Шаблоны закупок</a></li>
        <li><a href="/admin/pricing-column?catalog_id={{ \Input::get('catalog_id') }}">Ценовые колонки</a></li>
        <li class="active"><a href="/admin/product?catalog_id={{ \Input::get('catalog_id') }}">Товары</a></li>
    </ul>


    <h3>{{ $model_name }}</h3>

    <div class="btn-toolbar" role="toolbar" style="margin-bottom: 10px">
        <a class="btn btn-info" href="/admin/{{ $route_base_url }}/create?catalog_id={{ \Input::get('catalog_id', 0) }}">Добавить</a>
    </div>

    <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
        <tr>
            <th>ID</th>
            <th>Наименование</th>
            <th>Ёмкость</th>
            <th>Брэнд/страна</th>
            <th style="width:154px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($model_items as $model_obj)
            <tr>
                <td>{{ $model_obj->id }}</td>
                <td><a target="_blank" href="http://www.citynature.ru{{ $model_obj->source_url }}">{{ $model_obj->name }}</a></td>
                <td>{{ $model_obj->weight }} {{ $model_obj->measure_unit }}</td>
                <td>{{ $model_obj->brand }}, {{ $model_obj->country_name }}</td>
                <td>
                    <form action="/admin/{{ $route_base_url }}/{{ $model_obj->id }}" method="post">
                        <input type="hidden" name="_method" value="DELETE">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        <a class="btn btn-primary btn-xs" href="/admin/{{ $route_base_url }}/{{ $model_obj->id }}/edit">Изменить</a>
                        <button class="btn btn-danger btn-xs">Удалить</button>
                    </form>

                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {!! $model_items->render() !!}

@endsection
