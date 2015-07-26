<?php

$model = new $model_name;

$fields_arr = array_diff($model->getFillable(), $model->getHidden());

$model_items = $model_name::paginate(30);

?>

<h3>{{ $model_name }}</h3>

<div class="btn-toolbar" role="toolbar">
    <a class="btn btn-default" href="/admin/{{ $route_base_url }}/create">Добавить</a>
</div>

<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        @foreach($fields_arr as $field_name)
        <th>{{ trans('models.' . $field_name) }}</th>
        @endforeach
        <th></th>
    </tr>
    </thead>
    <tbody>
    @foreach($model_items as $model_obj)
    <tr>
        @foreach($fields_arr as $field_name)
        <td>{{ $model_obj->$field_name }}</td>
        @endforeach
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