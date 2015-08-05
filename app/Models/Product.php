<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 'article', 'name', 'description', 'user_id', 'catalog_id', 'purchase_template_id',
        'source_url', 'brand', 'country_name', 'weight', 'measure_unit', 'in_stock', 'min_party',
        'price_1', 'price_2', 'price_3', 'price_4', 'category_id', 'product_line'
    ];

    protected $hidden = ['user_id'];

    public function images()
    {
        return $this->hasMany('\App\Models\Media');
    }

    public function setAttributeById($attribute_id, $value)
    {
        //
    }

    public function setPriceByColumnId($column_id, $price)
    {
        //
    }
}
