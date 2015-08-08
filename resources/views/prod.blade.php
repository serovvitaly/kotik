@extends('layout')

@section('content')

    <div class="row">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                <li><a href="#">Косметика</a></li>
                <li class="active">Для лица</li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="row">

        <div class="col-lg-4">
            <img style="width: 100%" src="http://www.citynature.ru/components/com_jshopping/files/img_products/full_aubrey-organics-139-calaguala-liposome-cream.jpg">
        </div>
        <div class="col-lg-8">
            <p>
                <strong>Смягчающий и восстанав. крем "Папоротник" для грубых участков кожи</strong>
            </p>
            <p style="color: #a3a5a8">
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty" style="color: red"></span>
                <span class="glyphicon glyphicon-star-empty"></span>
            </p>
            <p>
                <a href="#" title="Бренд"><span class="label label-default">Aubrey Organics</span></a>
                <a href="#" title="Страна производитель"><span class="label label-default">Соединенные Штаты</span></a>
                <br>
                <a href="#" title="Категория"><span class="label label-primary">Для тела</span></a>
                <a href="#" title="Линейка товаров"><span class="label label-info">Средства для особого ухода за кожей</span></a>
            </p>
            <p>
                <span title="Объем"><span class="glyphicon glyphicon-tint"></span> 60 мл.</span>
            </p>
            <p>
                Для максимального смягчения сухих и загрубевших участков кожи Природная сила папоротника калагуала и примулы,
                а также новейшие технологии производства продуктов с липосомами, обеспечивают эффективную помощь в смягчении
                и увлажнении участков чрезмерно сухой, шелушащейся кожи.
            </p>
            <p>
            <form class="form-inline">
                <input type="text" class="form-control" value="1" style="width: 70px; text-align: center">
                <button class="btn btn-danger"><span class="glyphicon glyphicon-shopping-cart"></span> В корзину</button>
            </form>
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