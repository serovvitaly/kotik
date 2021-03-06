<?php

$model = new $model_name;

$fields_arr = array_diff($model->getFillable(), $model->getHidden());

if (!isset($paginate_count)) {
    $paginate_count = 30;
}

if ( ! isset($model_items) ) {
    $model_items = $model_name::paginate($paginate_count);
}

?>

@yield('table_top_header')

<h3>{{ $model_name }}</h3>

<div class="btn-toolbar" role="toolbar" style="margin-bottom: 10px">
    <a class="btn btn-info" href="/admin/{{ $route_base_url }}/create">Добавить</a>
</div>

<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        @foreach($fields_arr as $field_name)
        <th>{{ trans('models.' . $field_name) }}</th>
        @endforeach
        <th style="width:145px;"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($model_items as $model_obj)
    <tr>
        @foreach($fields_arr as $field_name)
        <td>{{ $model_obj->$field_name }}</td>
        @endforeach
        <td>
            <form id="row-form-{{ $model_obj->id }}" action="/admin/{{ $route_base_url }}/{{ $model_obj->id }}" method="post">
                <input type="hidden" name="_method" value="DELETE">
                <input type="hidden" name="_token" value="{{ csrf_token() }}">
                <div class="btn-group btn-group-xs">
                    <a class="btn btn-primary" href="/admin/{{ $route_base_url }}/{{ $model_obj->id }}/edit">Изменить</a>
                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu">
                        <li><a href="#" onclick="$('#row-form-{{ $model_obj->id }}').submit(); return false;">Удалить</a></li>
                    </ul>
                </div>

            </form>
        </td>
    </tr>
    @endforeach
    </tbody>
</table>

{!! $model_items->render() !!}