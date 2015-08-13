@extends('layout')

@section('content')

    <?php

            if (!isset($products)) {
                $products = new \App\Models\Product;
            }

            $products = $products->where('price_1', '>', 0)->paginate(40);
    ?>

    <div class="row" xmlns="http://www.w3.org/1999/html">
        <div class="col-lg-10">
            <div class="row" id="catalog-list">
            @foreach($products as $product)
                <?php
                    $image = $product->images()->first();
                    ?>
                <div class="item">
                    <div class="thumbnail">

                        @if(\Auth::user() and \Auth::user()->hasRole('moderator'))
                            <div class="btn-group btn-group-xs" style="margin: -15px 0px 0px -17px; position: absolute;">
                                <div class="btn-group btn-group-xs">
                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">
                                        <span class="glyphicon glyphicon-cog"></span>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li><a target="_blank" href="/admin/product/{{ $product->id }}/edit">Изменить</a></li>
                                        <li><a target="_blank" href="#">Удалить</a></li>
                                    </ul>
                                </div>
                            </div>
                        @endif

                        <div style="width: 209px; height: 209px;">
                        @if(!$image)
                            X
                        @elseif(empty($image->file_name))
                            <img src="/media/images/250x200/empty?mid={{ $image->id }}" alt="" style="width:100%;">
                        @else
                            <img src="/media/images/250x200/{{ $image->file_name }}" alt="" style="width:100%;">
                        @endif
                        </div>
                        <div class="caption">
                            <p style="text-align: center">
                                <a href="/prod-{{ $product->id }}" style="color: black"><strong style="line-height: 18px; padding-bottom: 5px;" title="{{ $product->name }}">{{ $product->name }}</strong></a>
                            </p>
                            <div style="padding: 5px 0; text-align: center">
                                <span class="label label-info" title="{{ $product->brand }}">{{ str_limit($product->brand, 28) }}</span>
                                <span class="label label-default">{{ $product->country_name }}</span>
                            </div>
                            <p style="line-height: 16px; text-align: center">
                                <small>{{ str_limit($product->description, 255) }}</small>
                            </p>
                            <p>
                                <h4 style="text-align: center"><strong>{{ $product->price_1 }}</strong> руб.</h4>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            {!! $products->render() !!}

        </div>
        <div class="col-lg-2">
            <strong>Брэнд</strong>
            <p>

            </p>
        </div>
    </div>

    <script>
        $(document).ready(function(){
            $("#catalog-list").gridalicious({
                //width: 500
            });

            $('#catalog-list').scroll( function() {

                console.log('scrolling');

                var fromtop = $(this).scrollTop(),
                        height = $(this).find('.scroll-content').innerHeight() - $(this).innerHeight();
                // In the above line we're finding the height of the scrollable content
                // and subtracting the height of the viewable area (or parent container).

                if ((height - fromtop) < 50) {
                    alert('trigger ajax call');
                }
            });
        });
    </script>

@endsection