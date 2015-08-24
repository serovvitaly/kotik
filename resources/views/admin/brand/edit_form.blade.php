@extends('admin.layout')

@section('content')

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

    <div class="container">
        <h3>\App\Models\Brand::new</h3>

        <form method="post" action="/admin/{{ $route_base_url }}{{ $model_id ? ('/' . $model_id) : '' }}">

            @if($model_id)
                <input type="hidden" name="_method" value="PUT">
            @endif

            <button type="submit" class="btn btn-success">Сохранить</button>
            <a href="/admin/brand" class="btn btn-default">Отмена</a>

            <input type="hidden" name="_token" value="{{ csrf_token() }}">

            <div class="form-group">
                <label>Имя</label>
                <input type="test" class="form-control" name="name" value="{{ $model->name }}">
            </div>
            <div class="form-group">
                <label>Описание</label>
                <textarea rows="10" class="form-control" name="description">{{ $model->description }}</textarea>
            </div>
            <div class="form-group">
                <label>Адрес сайта</label>
                <input type="test" class="form-control" name="site_url" value="{{ $model->site_url }}">
            </div>


        </form>

    </div>
@endsection
