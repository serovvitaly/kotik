@extends('layout')

@section('content')

    <?php

            $products = \App\Models\Product::paginate(40);

    ?>

    <div class="row">
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

                        @if(!$image)
                            X
                        @elseif(empty($image->file_name))
                            <img src="/media/images/250x200/empty?mid={{ $image->id }}" alt="" style="width:100%;">
                        @else
                            <img src="/media/images/250x200/{{ $image->file_name }}" alt="" style="width:100%;">
                        @endif
                        <div class="caption">
                            <strong style="line-height: 18px; padding-bottom: 5px;" title="{{ $product->name }}">{{ $product->name }}</strong>
                            <div style="height: 10px;"></div>
                            <p style="line-height: 16px;">
                                <small>{{ str_limit($product->description, 255) }}</small>
                            </p>
                            <p>
                                <a href="/prod-{{ $product->id }}" class="btn btn-primary" role="button">Button</a>
                                <a href="#" class="btn btn-default" role="button">Button</a>
                            </p>
                        </div>
                    </div>
                </div>
            @endforeach
            </div>

            {!! $products->render() !!}

        </div>
        <div class="col-lg-2">
            <div class="panel panel-info">
                <div class="panel-heading">
                    <h3 class="panel-title">Panel title</h3>
                </div>
                <div class="panel-body">
                    Panel content
                </div>
            </div>
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