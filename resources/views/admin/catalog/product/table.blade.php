<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th>ID</th>
        <th>Наименование</th>
        <th>Статус</th>
        <th>Брэнд</th>
        <th>Цена</th>
        <th>Цена опт</th>
        <th>Наценка</th>
        <th style="width:154px;"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($model_items as $model_obj)
        <tr>
            <td>{{ $model_obj->id }}</td>
            <td><a target="_blank" href="{{ $model_obj->source_url }}" title="{{ $model_obj->name }}" data-toggle="tooltip">{!! $model_obj->display_name !!}</a></td>
            <td>{!! $model_obj->status ? '<span class="label label-success">Активен</span>' : '<span class="label label-danger">Скрыт</span>' !!}</td>
            <td>{{ $model_obj->brand }}</td>
            <td>{{ $model_obj->getPublicPrice() }}</td>
            <td>{{ $model_obj->price_1 }}</td>
            <td>
                @if($model_obj->price_1 > 0)
                    {{ ($model_obj->getPublicPrice() > 0) ? ceil( ($model_obj->getPublicPrice() - $model_obj->price_1) / $model_obj->getPublicPrice() * 100 ) . ' %' : '' }}
                @endif
            </td>
            <td>
                <form action="/admin/{{ $route_base_url }}/{{ $model_obj->id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a class="btn btn-primary btn-xs" href="/admin/{{ $model_obj->catalog_id }}{{ $route_base_url }}/{{ $model_obj->id }}/edit">Изменить</a>
                    <button class="btn btn-danger btn-xs">Удалить</button>
                </form>
            </td>
        </tr>
    @endforeach
    </tbody>
</table>

<script>
    $(function () {
        $('[data-toggle="tooltip"]').tooltip();

        $('#products-target-container .pagination a').on('click', function(e){

            var hrefSegs = $(this).attr('href').match(/page=(\d{1,})/);

            var data = {
                query: $('#input-search-like').val()
            }

            if (hrefSegs) {
                data.page = hrefSegs[1] * 1;
            }

            $.ajax({
                url: '/admin/product/search',
                type: 'get',
                dataType: 'json',
                data: data,
                success: function(data){
                    if (!data.html) return;
                    $('#products-target-container').html(data.html);
                }
            });

            return false;
        });
    })
</script>

{!! $model_items->render() !!}