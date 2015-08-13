@extends('admin.layout')

@section('form_after_footer')

    @if( isset($model_id) and $model_id > 0 )

    <ul class="nav nav-pills">
        <li><a href="/admin/template-purchase?catalog_id={{ $model_id }}">Шаблоны закупок</a></li>
        <li><a href="/admin/pricing-column?catalog_id={{ $model_id }}">Ценовые колонки</a></li>
        <li><a href="/admin/{{ $model_id }}/product">Товары</a></li>
    </ul>

    @endif

@endsection

@section('content')
    @include('admin.common.edit_form')
@endsection
