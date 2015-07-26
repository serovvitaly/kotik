<?php

if ( ! ($model_name instanceof \Model) ) {
    //throw new \Exception('Class is not Model');
}

$model_id = isset($model_id) ? $model_id : null;
if ($model_id) {
    $model = $model_name::findOrFail($model_id);
} else {
    $model = new $model_name;
}

?>

<h3>{{ $model_name . '::' . ($model_id ? $model_id : 'new') }}</h3>

<form method="post" action="/admin/{{ $route_base_url }}{{ $model_id ? ('/' . $model_id) : '' }}">

    @if($model_id)
        <input type="hidden" name="_method" value="PUT">
    @endif

    <button type="submit" class="btn btn-success">Сохранить</button>
    <a href="/admin/{{ $route_base_url }}" class="btn btn-default">Отмена</a>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    @foreach($model->getFillable() as $fillable_item)
    <div class="form-group">
        <label>{{ trans('models.' . $fillable_item) }}</label>
        <input type="test" class="form-control" name="{{ $fillable_item }}" value="{{ $model->$fillable_item }}">
    </div>
    @endforeach

    @yield('form_footer')

</form>