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
        return $this->price;
    }

    public function getQuantity()
    {
        return $this->quantity;
    }

    public function getAmount()
    {
        return $this->getProductPublicPrice() * $this->getQuantity();
    }
}
