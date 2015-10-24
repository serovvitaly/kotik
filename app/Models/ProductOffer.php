<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    protected $table = 'products_offers';

    /**
     * @return \App\Models\Product
     */
    public function product()
    {
        return $this->belongsTo('\App\Models\Product');
    }

    public function getPrice()
    {
        return 4000;
    }
}
