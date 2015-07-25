<?php

$model = new $model_name;

$fields_arr = array_diff($model->getFillable(), $model->getHidden());

$model_items = $model_name::paginate(30);

?>

<div class="btn-toolbar" role="toolbar">
    <a class="btn btn-default" href="/admin/{{ $route_base_url }}/create">Добавить</a>
</div>

<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        @foreach($fields_arr as $field_name)
        <th>{{ $field_name }}</th>
        @endforeach
    </tr>
    </thead>
    <tbody>
    @foreach($model_items as $model_obj)
    <tr>
        @foreach($fields_arr as $field_name)
            <td>{{ $model_obj->$field_name }}</td>
        @endforeach
    </tr>
    @endforeach
    </tbody>
</table>

{!! $model_items->render() !!}