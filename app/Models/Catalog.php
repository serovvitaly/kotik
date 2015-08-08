<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    protected $fillable = ['name', 'description', 'user_id'];

    protected $hidden = ['user_id'];

    public function templates_purchases()
    {
        return $this->hasMany('\App\Models\TemplatePurchase');
    }

    public function pricing_columns()
    {
        return $this->hasMany('\App\Models\PricingColumn');
    }

    public function products()
    {
        return $this->hasMany('\App\Models\Product');
    }

    public function user()
    {
        return $this->belongsTo('\App\User');
    }
}