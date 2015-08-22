<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderedProduct extends Model
{
    const TABLE = 'ordered_products';

    protected $table = 'ordered_products';

    protected $fillable = ['user_id', 'product_id', 'catalog_id', 'price', 'quantity', 'is_deferred'];

    public function product()
    {
        return $this->belongsTo('\App\Models\Product');
    }

    public function getProductPublicPrice()
    {
        return number_format($this->price, 2, ',', '`');
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getAmount()
    {
        $amount = $this->price * $this->quantity;

        return number_format($amount, 2, ',', '`');
    }
}
