@extends('layout')

@section('content')

<?php
/**
 * @var $user \App\User
 */
if (!isset($user)) {
    $user = \App\Helpers\CommonHelper::getCurrentUser();
}
?>

<div class="panel panel-default">
    <div class="panel-body">

        <div class="row">
            <div class="col-lg-12">
                <h3>Накладная №00000045 от 12.08.2015</h3>
            </div>
            <div class="col-lg-12">
                <table class="table table-condensed table-borderless">
                    <colgroup>
                        <col width="100">
                        <col>
                    </colgroup>
                    <tbody>
                    <tr>
                        <td>Поставщик</td>
                        <td>ООО "Центр инновационных технологий", г.Москва ул. Театральная 9, оф. 140</td>
                    </tr>
                    <tr>
                        <td>Получатель</td>
                        <td>
                            <select>
                                <option>Сидорова Ирина Михайловна</option>
                            </select>
                            ,
                            <select>
                                <option>г.Москва ул.Набережная д.38, кв.12</option>
                            </select>
                        </td>
                    </tr>
                    </tbody>
                </table>
            </div>

            <div class="col-lg-12" style="height: 20px;"></div>

            <div class="col-lg-12">
                <table class="table table-bordered" style="border: 3px solid;">
                    <thead>
                    <tr>
                        <th class="text-center">№</th>
                        <th class="text-center">Наименование товара</th>
                        <th class="text-center">Цена</th>
                        <th class="text-center">Кол-во</th>
                        <th class="text-center">Ед. изм.</th>
                        <th class="text-center">Сумма</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($user->orderedProducts()->get() as $key => $ordered_product)
                    <tr>
                        <td class="text-right">{{ ++$key }}</td>
                        <td>{{ $ordered_product->product->name }}</td>
                        <td class="text-right">{{ $ordered_product->getProductPublicPrice() }}</td>
                        <td class="text-right">{{ $ordered_product->quantity }}</td>
                        <td class="text-center">шт.</td>
                        <td class="text-right">{{ $ordered_product->getAmount() }}</td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-12 text-right">
                <strong>Итого: {{ $user->getAmountOpenOrders() }}</strong><br>
            </div>
            <div class="col-lg-12">
                <p>
                    <em>Всего наименований {{ $user->orderedProducts()->count() }} на сумму: {{ $user->getAmountOpenOrders() }}</em><br>
                    <em>{{ $user->getAmountOpenOrdersAsString() }}</em>
                </p>
            </div>

            <div class="col-lg-12" style="height: 30px;"></div>

            <div class="col-lg-1 text-right">Отпустил</div>
            <div class="col-lg-2"><div class="borders">подпись</div></div>
            <div class="col-lg-3"><div class="borders">расшифровка</div></div>
            <div class="col-lg-1 text-right">Получил</div>
            <div class="col-lg-2"><div class="borders">подпись</div></div>
            <div class="col-lg-3"><div class="borders">расшифровка</div></div>
        </div>

    </div>

    <div class="panel-footer">
        <div class="row">
            <div class="col-lg-9">

            </div>
            <div class="col-lg-3 text-right">
                <button class="btn btn-primary btn-lg">Оплатить заказ</button>
            </div>
        </div>
    </div>

</div>

@endsection
