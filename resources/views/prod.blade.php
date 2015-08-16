@extends('layout')

@section('content')

    <div class="row">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="#">{{ $base_category_name }}</a></li>
                <li><a href="#">{{ $category_name }}</a></li>
                <li class="active">{{ $name }}</li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">

            @if(!count($images))
                X
            @elseif(count($images) == 1)
                @if(empty($images[0]->file_name))
                    <img src="/media/images/360x510/empty?mid={{ $images[0]->id }}" alt="" style="width: 360px; height: 510px;">
                @else
                    <img src="/media/images/360x510/{{ $images[0]->file_name }}" alt="" style="width: 360px; height: 510px;">
                @endif
            @else
                <div id="carousel-example-generic" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        @foreach($images as $key => $image)
                            <li data-target="#carousel-example-generic" data-slide-to="{{ $key }}" @if($key == 0) class="active" @endif></li>
                        @endforeach
                    </ol>
                    <div class="carousel-inner" role="listbox">
                        @foreach($images as $key => $image)
                        <div class="item @if($key == 0) active @endif">
                            @if(empty($image->file_name))
                                <img src="/media/images/360x510/empty?mid={{ $image->id }}" alt="" style="width: 360px; height: 510px;">
                            @else
                                <img src="/media/images/360x510/{{ $image->file_name }}" alt="" style="width: 360px; height: 510px;">
                            @endif
                        </div>
                        @endforeach
                    </div>
                    <a class="left carousel-control" href="#carousel-example-generic" role="button" data-slide="prev">
                        <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="right carousel-control" href="#carousel-example-generic" role="button" data-slide="next">
                        <span class="glyphicon glyphicon-chevron-right" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            @endif
        </div>
        <div class="col-lg-8">
            <h1 style="font-size: 25px">{{ $name }}</h1>
            <p style="color: #a3a5a8">
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
            </p>
            <p>
                <a href="#" title="Бренд"><span class="label label-default">{{ $brand }}</span></a>
                <a href="#" title="Страна производитель"><span class="label label-default">{{ $country_name }}</span></a>
                <br>
                <a href="#" title="Категория"><span class="label label-primary">{{ $category_name }}</span></a>
                <a href="#" title="Линейка товаров"><span class="label label-info">{{ $product_line }}</span></a>
            </p>
            @if($weight > 0)
            <p>
                <span title="Объем"><span class="glyphicon glyphicon-tint"></span> {{ $weight }} {{ $measure_unit }}.</span>
            </p>
            @endif
            <p>{{ $description }}</p>
            <p>
            <h4 style="text-align: center"><strong>{{ $product->getPublicPrice() }}</strong> руб.</h4>
            <div class="form-inline">
                <input type="text" id="product-quantity-input-{{ $id }}" class="form-control" value="1" style="width: 70px; text-align: center">
                <button type="button" class="btn btn-danger" onclick="putProductInBasket('{{ $id }}', $('#product-quantity-input-{{ $id }}').val())">
                    <span class="glyphicon glyphicon-shopping-cart"></span> В корзину
                </button>
            </div>
            </p>
        </div>

        <div class="col-lg-12">
            <div class="media">
                <div class="media-left">
                    <a href="#">
                        <img class="media-object" data-src="holder.js/64x64" alt="64x64" src="data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiBlbmNvZGluZz0iVVRGLTgiIHN0YW5kYWxvbmU9InllcyI/PjxzdmcgeG1sbnM9Imh0dHA6Ly93d3cudzMub3JnLzIwMDAvc3ZnIiB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIHZpZXdCb3g9IjAgMCA2NCA2NCIgcHJlc2VydmVBc3BlY3RSYXRpbz0ibm9uZSI+PCEtLQpTb3VyY2UgVVJMOiBob2xkZXIuanMvNjR4NjQKQ3JlYXRlZCB3aXRoIEhvbGRlci5qcyAyLjYuMC4KTGVhcm4gbW9yZSBhdCBodHRwOi8vaG9sZGVyanMuY29tCihjKSAyMDEyLTIwMTUgSXZhbiBNYWxvcGluc2t5IC0gaHR0cDovL2ltc2t5LmNvCi0tPjxkZWZzPjxzdHlsZSB0eXBlPSJ0ZXh0L2NzcyI+PCFbQ0RBVEFbI2hvbGRlcl8xNGYwYzYwMTc2NCB0ZXh0IHsgZmlsbDojQUFBQUFBO2ZvbnQtd2VpZ2h0OmJvbGQ7Zm9udC1mYW1pbHk6QXJpYWwsIEhlbHZldGljYSwgT3BlbiBTYW5zLCBzYW5zLXNlcmlmLCBtb25vc3BhY2U7Zm9udC1zaXplOjEwcHQgfSBdXT48L3N0eWxlPjwvZGVmcz48ZyBpZD0iaG9sZGVyXzE0ZjBjNjAxNzY0Ij48cmVjdCB3aWR0aD0iNjQiIGhlaWdodD0iNjQiIGZpbGw9IiNFRUVFRUUiLz48Zz48dGV4dCB4PSIxMy40Njg3NSIgeT0iMzYuNSI+NjR4NjQ8L3RleHQ+PC9nPjwvZz48L3N2Zz4=" data-holder-rendered="true" style="width: 64px; height: 64px;">
                    </a>
                </div>
                <div class="media-body">
                    <h4 class="media-heading">Media heading</h4>
                    Cras sit amet nibh libero, in gravida nulla. Nulla vel metus scelerisque ante sollicitudin commodo.
                    Cras purus odio, vestibulum in vulputate at, tempus viverra turpis. Fusce condimentum nunc ac nisi
                    vulputate fringilla. Donec lacinia congue felis in faucibus.
                </div>
            </div>
        </div>

    </div>

@endsection