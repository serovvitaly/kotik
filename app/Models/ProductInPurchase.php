<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductInPurchase extends Model
{
    const TABLE_NAME = 'products_in_purchases';

    protected $table = 'products_in_purchases';

    /**
     * @return \App\Models\Product
     */
    public function product()
    {
        var_dump($this->product_offer->product());

        exit;

        return $this->product_offer->product;
    }

    /**
     * @return \App\Models\ProductOffer
     */
    public function product_offer()
    {
        return $this->belongsTo('\App\Models\ProductOffer');
    }

    /**
     * @return \App\Models\Offer
     */
    public function offer()
    {
        return $this->belongsTo('\App\Models\Offer');
    }

    public function images()
    {
        return $this->product()->images();
    }
}
