<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductOffer extends Model
{
    protected $table = 'products_offers';

    public function getPrice()
    {
        return 4000;
    }
}
