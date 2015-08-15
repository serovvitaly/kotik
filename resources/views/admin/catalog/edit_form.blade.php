@extends('admin.layout')

@section('form_after_footer')

    @if( isset($model_id) and $model_id > 0 )

    <ul class="nav nav-pills">
        <li><a href="/admin/{{ $model_id }}/template-purchase">Шаблоны закупок</a></li>
        <li><a href="/admin/{{ $model_id }}/pricing-column">Ценовые колонки</a></li>
        <li><a href="/admin/{{ $model_id }}/product">Товары</a></li>
    </ul>

    @endif

@endsection

@section('content')
    @include('admin.common.edit_form')
@endsection
