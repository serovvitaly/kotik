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

    <div class="btn-toolbar" role="toolbar" style="margin-bottom: 10px">
        <a class="btn btn-info" href="/admin/{{ $route_base_url }}/create">Добавить</a>
    </div>

    <table class="table table-bordered table-striped table-hover table-condensed">
        <thead>
        <tr>
            <th>ID</th>
            <th>Наименование</th>
            <th>Брэнд</th>
            <th>Цена 1</th>
            <th>Цена 2</th>
            <th>Наценка</th>
            <th style="width:154px;"></th>
        </tr>
        </thead>
        <tbody>
        @foreach($model_items as $model_obj)
            <tr>
                <td>{{ $model_obj->id }}</td>
                <td><a target="_blank" href="{{ $model_obj->source_url }}">{{ $model_obj->name }}</a></td>
                <td>{{ $model_obj->brand }}</td>
                <td>{{ $model_obj->price_1 }}</td>
                <td>{{ $model_obj->price_2 }}</td>
                <td>@if($model_obj->price_1 > 0){{ ceil( ($model_obj->price_1 - $model_obj->price_2) / $model_obj->price_1 * 100 ) }} % @endif</td>
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
