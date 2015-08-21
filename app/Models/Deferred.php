<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Deferred extends Model
{
    protected $table = 'deferred_products';

    protected $fillable = ['product_id', 'quantity', 'user_id'];

    public function product()
    {
        return $this->belongsTo('\App\Models\Product');
    }
}
