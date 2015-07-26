<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['code', 'article', 'name', 'description', 'user_id'];

    protected $hidden = ['user_id'];

    public function setAttributeById($attribute_id, $value)
    {
        //
    }

    public function setPriceByColumnId($column_id, $price)
    {
        //
    }
}
