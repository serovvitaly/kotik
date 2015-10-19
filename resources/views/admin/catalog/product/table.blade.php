<table class="table table-bordered table-striped table-hover table-condensed">
    <thead>
    <tr>
        <th>ID</th>
        <th>Наименование</th>
        <th>Статус</th>
        <th>Брэнд</th>
        <th style="width:154px;"></th>
    </tr>
    </thead>
    <tbody>
    @foreach($model_items as $model_obj)
        <tr>
            <td>{{ $model_obj->id }}</td>
            <td><a target="_blank" href="{{ $model_obj->source_url }}" title="{{ $model_obj->title }}" data-toggle="tooltip">{!! $model_obj->display_title !!}</a></td>
            <td>{!! $model_obj->status ? '<span class="label label-success">Активен</span>' : '<span class="label label-danger">Скрыт</span>' !!}</td>
            <td>{{ $model_obj->brand }}</td>
            <td>
                <form action="/admin/{{ $route_base_url }}/{{ $model_obj->id }}" method="post">
                    <input type="hidden" name="_method" value="DELETE">
                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <a class="btn btn-primary btn-xs" href="/admin/{{ $route_base_url }}/{{ $model_obj->id }}/edit">Изменить</a>
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