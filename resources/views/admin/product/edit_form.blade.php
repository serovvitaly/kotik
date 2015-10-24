@extends('admin.layout')

<?php

$model_id = isset($model_id) ? intval($model_id) : null;
if ($model_id) {
    $model = \App\Models\Product::findOrFail($model_id);
} else {
    $model = new \App\Models\Product;
}

?>

@section('content')

<link rel="stylesheet" href="/public/fileupload/css/jquery.fileupload.css">
<script src="/public/fileupload/js/vendor/jquery.ui.widget.js"></script>
<script src="/public/fileupload/js/jquery.fileupload.js"></script>
<script src="/public/fileupload/js/jquery.fileupload-process.js"></script>

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
        border-left: 4px solid #2e6da4;
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
        border-right: 4px solid #2e6da4;
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

<h3>{{ ($model->id ?  $model->name : 'NEW \App\Models\Product') }}</h3>

<form method="post" action="/admin/product/{{ ($model->id ? ('/' . $model->id) : '') }}">

    @if($model->id)
        <input type="hidden" name="_method" value="PUT">
    @endif

    <button type="submit" class="btn btn-success">Сохранить</button>
    <button type="submit" class="btn btn-primary" name="is_apply">Применить</button>
    <a href="/admin/product" class="btn btn-default">Отмена</a>

    <input type="hidden" name="_token" value="{{ csrf_token() }}">

    <br><br>

    <ul class="nav nav-tabs">
        <li class="active"><a href="#base" data-toggle="tab">Основные</a></li>
        <li class=""><a href="#prices-offers" data-toggle="tab">Ценовые предложения</a></li>
        <li class=""><a href="#competitors-links" id="profile-tab" data-toggle="tab">Ссылки конкурентов</a></li>
        <li class=""><a href="#images" id="profile-tab" data-toggle="tab">Картинки</a></li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane fade active in" id="base">

            <div class="form-group">
                <label>Наименование</label>
                <input type="text" class="form-control" name="name" value="{{ $model->name }}">
            </div>

            <div class="row">
                <div class="col-lg-6">
                    <div class="row">
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Артикул</label>
                                <input type="text" class="form-control" name="article" value="{{ $model->article }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Статус</label><br>
                                <select class="form-control" name="status">
                                    <option value="1" @if( $model->status == 1 ) selected @endif>Активен</option>
                                    <option value="0" @if( $model->status == 0 ) selected @endif>Скрыт</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Объем/вес</label>
                                <input type="text" class="form-control" name="weight" value="{{ $model->weight }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Ед. изм.</label>
                                <select class="form-control" name="measure_unit">
                                    <option></option>
                                    <option @if($model->measure_unit == 'гр') selected @endif value="гр">гр</option>
                                    <option @if($model->measure_unit == 'мл') selected @endif value="мл">мл</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Бренд</label>
                                <input type="text" class="form-control" name="brand" value="{{ $model->brand }}">
                            </div>
                        </div>
                        <div class="col-xs-6">
                            <div class="form-group">
                                <label>Страна</label>
                                <input type="text" class="form-control" name="country_name" value="{{ $model->country_name }}">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="form-group">
                        <label>Описание</label>
                        <textarea class="form-control" rows="8" name="description">{{ $model->description }}</textarea>
                    </div>
                </div>
            </div>

        </div>
        <div class="tab-pane fade" id="prices-offers">
            <p>Food truck fixie locavore, accusamus mcsweeney's marfa nulla single-origin coffee squid. Exercitation +1
                labore velit, blog sartorial PBR leggings next level wes anderson artisan four loko farm-to-table craft
                beer twee. Qui photo booth letterpress, commodo enim craft beer mlkshk aliquip jean shorts ullamco ad vin
                yl cillum PBR. Homo nostrud organic, assumenda labore aesthetic magna delectus mollit. Keytar helvetica
                VHS salvia yr, vero magna velit sapiente labore stumptown. Vegan fanny pack odio cillum wes anderson 8-bi
                t, sustainable jean shorts beard ut DIY ethical culpa terry richardson biodiesel. Art party scenester stu
                mptown, tumblr butcher vero sint qui sapiente accusamus tattooed echo park.</p>
        </div>
        <div class="tab-pane fade" id="competitors-links">
            <div class="row">
                <div class="col-lg-12">

                    <label style="color: #0000C2">Ссылки конкурентов</label>

                    <input type="text" class="form-control" id="input-competitors-links" autocomplete="off">
                    <div id="competitors-links-container">
                        @include('admin.catalog.product.competitors_links_table', ['product_id' => $model_id])
                    </div>

                </div>
            </div>
        </div>
        <div class="tab-pane fade" id="images">
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
                                    @if(empty($image->file_name))
                                        <img src="/media/images/165x165/empty?mid={{ $image->id }}" alt="" class="img-thumbnail" style="width:100%;">
                                    @else
                                        <img src="/media/images/165x165/{{ $image->file_name }}" alt="" class="img-thumbnail" style="width:100%;">
                                    @endif
                                    <br><button class="btn btn-link btn-xs" onclick="return removeImage({{ $image->id }});">удалить</button>
                                </div>
                            @endforeach
                        </div>
                    @else
                        <h3>Для загрузки картинок, нужно сначала создать товар</h3>
                    @endif

                </div>
            </div>
        </div>
    </div>
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

        $('#input-competitors-links').on('keypress', function(e){

            if (e.keyCode != 13) return;

            var url = $(this).val();

            $(this).val('');

            $.ajax({
                url: '/admin/product/competitor-link-add',
                type: 'get',
                dataType: 'json',
                data: {
                    product_id: '{{ $model_id }}',
                    url: url
                },
                success: function(data){
                    if (!data.html) return;
                    $('#competitors-links-container').html(data.html);
                }
            });

            return false;
        });

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

            setCatalogId( $(this).data('category-id') );

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