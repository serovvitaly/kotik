@extends('layout')

@section('content')

    <?php
    $user = \App\Helpers\CommonHelper::getCurrentUser();
    if (!$user) {
        return '';
    }
    ?>

    <div class="row">
        <div class="col-lg-10">
            <ol class="breadcrumb">
                <li><a href="/"><span class="glyphicon glyphicon-home"></span></a></li>
                <li class="active">Корзина</li>
            </ol>
        </div>
        <div class="col-lg-2">

        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="panel panel-default">
              <div class="panel-heading">Закупка косметики и парфюмерных товаров</div>
              <div class="panel-body">
                <p>Информация о закупке</p>
              </div>

              <table class="table">
                  <tbody>
                      <tr>
                          <td>Шампунь Клубок дыма</td>
                          <td style="width: 130px">
                            <div class="input-group input-group-sm">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-minus"></span></button></span>
                                <input type="text" class="form-control" value="1" style="text-align: center">
                                <span class="input-group-btn"><button class="btn btn-default" type="button"><span class="glyphicon glyphicon-plus"></span></button></span>
                            </div>
                          </td>
                          <td style="width: 170px"><button class="btn btn-danger btn-sm">Удалить</button><button class="btn btn-default btn-sm">Отложить</button></td>
                      </tr>
                  </tbody>
              </table>

              <div class="panel-footer">
                  <button class="btn btn-default" data-toggle="popover" data-placement="top" data-trigger="focus">Отказаться от заказа</button>
                  <button class="btn btn-success">Оформить заказ</button>
              </div>
            </div>
        </div>
    </div>

    <div id="cancel-the-order-popover-html" style="display: none">
        <strong>Удаление заказа</strong>
        <br>
        <button class="btn btn-danger btn-sm">Удалить заказ</button>
        <button class="btn btn-default btn-sm">Закрыть</button>
    </div>

    <script type="text/javascript">
        $(function () {
            $('[data-toggle="popover"]').popover({
                html: true,
                content: $('#cancel-the-order-popover-html').html()
            });
        })
    </script>

@endsection
