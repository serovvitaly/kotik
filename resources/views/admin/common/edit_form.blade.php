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


<form method="post" action="/admin/{{ $route_base_url }}">

    <button type="submit" class="btn btn-success">Сохранить</button>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    @foreach($model->getFillable() as $fillable_item)
    <div class="form-group">
        <label>{{ $fillable_item }}</label>
        <input type="test" class="form-control" name="{{ $fillable_item }}">
    </div>
    @endforeach

</form>