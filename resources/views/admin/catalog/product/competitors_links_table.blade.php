<?php
/**
 * @var $product_model \App\Models\Product
 */
$product_model = \App\Models\Product::find($product_id);
?>
@if($product_model)
<table class="table">
    <tbody>
    @foreach($product_model->competitorsLinks()->get() as $competitor_link)
    <tr>
        <td><a target="_blank" href="{{ $competitor_link->url }}">{{ $competitor_link->url }}</a></td>
        <td>{{ $competitor_link->price }}</td>
        <td>{{ !empty($competitor_link->image) ? 'Есть картинка' : '' }}</td>
    </tr>
    @endforeach
    </tbody>
</table>
@endif