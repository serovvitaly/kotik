@extends('admin.layout')

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

@section('content')

<link rel="stylesheet" href="/public/fileupload/css/jquery.fileupload.css">
<script src="/public/fileupload/js/vendor/jquery.ui.widget.js"></script>
<script src="/public/fileupload/js/jquery.fileupload.js"></script>
<script src="/public/fileupload/js/jquery.fileupload-process.js"></script>

<script>
function setCatalogId(catalogId){
    if ((catalogId < 1) || ((typeof catalogId) == 'undefined')) return;

    var input = $('input[name="category_id"]');
    var root  = input.parent('.dropdown');
    root.find('a.dropdown-toggle .title').html( root.find('a[data-catalog-id="'+catalogId+'"]').text() );
    input.val(catalogId);
}
</script>

<style>
    .dropdown-menu>li
    {	position:relative;
        -webkit-user-select: none; /* Chrome/Safari */
        -moz-user-select: none; /* Firefox */
        -ms-user-select: none; /* IE10+ */
        /* Rules below not implemented in browsers yet */
        -o-user-select: none;
        user-select: none;
        cursor:pointer;
    }
    .dropdown-menu .sub-menu {
        left: 100%;
        position: absolute;
        top: 0;
        display:none;
        margin-top: -1px;
        border-top-left-radius:0;
        /*border-bottom-left-radius:0;*/
        box-shadow:none;
    }
    .right-caret:after
    {	content:"";
        border-bottom: 4px solid transparent;
        border-top: 4px solid transparent;
        border-left: 4px solid orange;
        display: inline-block;
        height: 0;
        opacity: 0.8;
        vertical-align: middle;
        width: 0;
        margin-left:5px;
    }
    .left-caret:after
    {	content:"";
        border-bottom: 4px solid transparent;
        border-top: 4px solid transparent;
        border-right: 4px solid orange;
        display: inline-block;
        height: 0;
        opacity: 0.8;
        vertical-align: middle;
        width: 0;
        margin-left:5px;
    }
    .dropdown .title{
        padding-right: 7px;
    }
</style>

<h3>{{ $model_name . '::' . ($model_id ? $model_id : 'new') }}</h3>

<form method="post" action="/admin/{{ $route_base_url }}{{ $model_id ? ('/' . $model_id) : '' }}">

    @if($model_id)
        <input type="hidden" name="_method" value="PUT">
    @endif

    <button type="submit" class="btn btn-success">Сохранить</button>
    <button type="submit" class="btn btn-primary" name="is_apply">Применить</button>
    <a href="/admin/product?catalog_id=1" class="btn btn-default">Отмена</a>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <input type="hidden" name="catalog_id" value="{{ \Input::get('catalog_id', $model->catalog_id) }}">

    <br><br>

    <div class="form-group">
        <label>URL на сайте citynature.ru</label>
        <input type="test" class="form-control" name="source_url" value="{{ $model->source_url or \Input::get('source_url') }}">
    </div>

    <div class="form-group">

    </div>
    <div class="row">
        <div class="col-xs-3">
            <div class="form-group">
                <label>Артикул</label>
                <input type="test" class="form-control" name="article" value="{{ $model->article or \Input::get('article') }}">
            </div>
        </div>
        <div class="col-xs-3">
            <div class="form-group">
                <label>Категория</label><br>
                @include('admin.catalog.catalog_items')
                <script>
                    setCatalogId({{ $model->category_id }});
                </script>
            </div>
        </div>
    </div>

    <div class="form-group">
        <label>Наименование</label>
        <input type="test" class="form-control" name="name" value="{{ $model->name or \Input::get('name') }}">
    </div>

    <div class="form-group">
        <label>Описание</label>
        <textarea class="form-control" rows="5" name="description">{{ $model->description or \Input::get('description') }}</textarea>
    </div>

    <div class="row">
        <div class="col-xs-4">
            <div class="form-group">
                <label>Бренд</label>
                <input type="test" class="form-control" name="brand" value="{{ $model->brand or \Input::get('brand') }}">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label>Страна</label>
                <input type="test" class="form-control" name="country_name" value="{{ $model->country_name or \Input::get('country_name') }}">
            </div>
        </div>
        <div class="col-xs-4">
            <div class="form-group">
                <label>Линейка товаров</label>
                <input type="test" class="form-control" name="product_line" value="{{ $model->product_line or \Input::get('product_line') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-2">
            <div class="form-group">
                <label>Объем/вес</label>
                <input type="test" class="form-control" name="weight" value="{{ $model->weight or \Input::get('weight') }}">
            </div>
        </div>
        <div class="col-xs-1">
            <label>Ед. изм.</label>
            <select class="form-control" name="measure_unit">
                <option></option>
                <option @if($model->measure_unit == 'гр') selected @endif value="гр">гр</option>
                <option @if($model->measure_unit == 'мл') selected @endif value="мл">мл</option>
            </select>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-2">
            <div class="form-group">
                <label>В наличии</label>
                <input type="test" class="form-control" name="in_stock" value="{{ $model->in_stock or \Input::get('in_stock') }}">
            </div>
        </div>
        <div class="col-xs-2">
            <div class="form-group">
                <label>Мин. партия</label>
                <input type="test" class="form-control" name="min_party" value="{{ $model->min_party or \Input::get('min_party') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-xs-2">
            <div class="form-group">
                <label>Цена >15 т.р.</label>
                <input type="test" class="form-control" name="price_1" value="{{ $model->price_1 or \Input::get('price_1') }}">
            </div>
        </div>
        <div class="col-xs-2">
            <div class="form-group">
                <label>Цена >50 т.р.</label>
                <input type="test" class="form-control" name="price_2" value="{{ $model->price_2 or \Input::get('price_2') }}">
            </div>
        </div>
        <div class="col-xs-2">
            <div class="form-group">
                <label>Цена >100 т.р.</label>
                <input type="test" class="form-control" name="price_3" value="{{ $model->price_3 or \Input::get('price_3') }}">
            </div>
        </div>
        <div class="col-xs-2">
            <div class="form-group">
                <label>Цена >300 т.р.</label>
                <input type="test" class="form-control" name="price_4" value="{{ $model->price_4 or \Input::get('price_4') }}">
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">

            <label>Картинки</label>

            @if($model_id)
                <br>
                <span class="btn btn-success fileinput-button">
                    <i class="glyphicon glyphicon-plus"></i>
                    <span>Выберите файлы...</span>
                    <!-- The file input field used as target for the file upload widget -->
                    <input id="fileupload" type="file" name="files[]" multiple>
                </span>
                <hr>
                <!--div id="progress" class="progress">
                    <div class="progress-bar progress-bar-success"></div>
                </div-->
                <div id="files" class="files row">
                    @foreach($model->images as $image)
                        <div id="product-media-{{ $image->id }}" class="col-lg-2" style="margin-bottom: 5px; text-align: center">
                            <img src="/media/images/165x165/{{ $image->file_name }}" alt="" class="img-thumbnail" style="width:100%;">
                            <br><button class="btn btn-link btn-xs" onclick="return removeImage({{ $image->id }});">удалить</button>
                        </div>
                    @endforeach
                </div>
            @else
                <h3>Для загрузки картинок, нужно сначала создать товар</h3>
            @endif

        </div>
    </div>

    @yield('form_footer')

</form>

<script>

    function removeImage(id){
        $.get('/media/remove/'+id, function(data){
            if (data.success != true) {
                return;
            }
            $('#product-media-'+id).remove();
        }, 'json');
        return false;
    }

    $(function(){
        $(".dropdown-menu > li > a.trigger").on("click",function(e){
            var current=$(this).next();
            var grandparent=$(this).parent().parent();
            if($(this).hasClass('left-caret')||$(this).hasClass('right-caret')) {
                $(this).toggleClass('right-caret left-caret');
            }
            grandparent.find('.left-caret').not(this).toggleClass('right-caret left-caret');
            grandparent.find(".sub-menu:visible").not(current).hide();
            current.toggle();
            e.stopPropagation();
            return false;
        });
        $(".dropdown-menu > li > a:not(.trigger)").on("click",function(){
            var root=$(this).closest('.dropdown');
            root.find('.left-caret').toggleClass('right-caret left-caret');
            root.find('.sub-menu:visible').hide();
            root.removeClass("open");

            setCatalogId( $(this).data('catalog-id') );

            return false;
        });

        $('#fileupload')
                .fileupload({
                    url: '/media/upload',
                    dataType: 'json',
                    autoUpload: true,
                    acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i,
                    maxFileSize: 5000000, // 5 MB
                    disableImageResize: /Android(?!.*Chrome)|Opera/
                            .test(window.navigator.userAgent),
                    previewMaxWidth: 100,
                    previewMaxHeight: 100,
                    previewCrop: true
                })
                .bind('fileuploadsubmit', function (e, data) {
                    data.formData = {
                        product_id: '{{ $model_id }}',
                        _token: '{{ csrf_token() }}'
                    };
                })
                .bind('fileuploaddone', function (e, data) {
                    var box = '<div id="product-media-'+data.result.id+'" class="col-lg-2" style="margin-bottom: 5px; text-align: center">'+
                            '<img src="/media/images/165x165/'+data.result.file_name+'" alt="" class="img-thumbnail" style="width:100%;">'+
                            '<br><button class="btn btn-link btn-xs" onclick="return removeImage('+data.result.id+');">удалить</button>'+
                            '</div>';
                    $('#files').append(box);
                });
    });
</script>

@endsection