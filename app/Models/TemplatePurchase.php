<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TemplatePurchase extends Model
{
    protected $fillable = ['name', 'description', 'catalog_id'];

    protected $hidden = ['catalog_id'];

    public function catalog()
    {
        return $this->belongsTo('\App\Models\Catalog');
    }
}
