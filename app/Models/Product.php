<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 'article', 'name', 'description', 'user_id', 'catalog_id', 'purchase_template_id',
        'source_url', 'brand', 'country_name', 'weight', 'measure_unit', 'in_stock', 'min_party',
        'price_1', 'price_2', 'price_3', 'price_4', 'category_id', 'category_name', 'product_line',
        'status', 'public_price'
    ];

    protected $hidden = ['user_id'];

    public function images()
    {
        return $this->hasMany('\App\Models\Media');
    }

    public function delete()
    {
        $media = $this->images()->get();
        if ($media->count()) {
            foreach ($media as $media_object) {
                $media_object->delete();
            }
        }
        parent::delete();
    }

    public function catalog()
    {
        return $this->belongsTo('\App\Models\Catalog');
    }

    public function setAttributeById($attribute_id, $value)
    {
        //
    }

    public function setPriceByColumnId($column_id, $price)
    {
        //
    }

    /**
     * Возвращает Публичную цену
     * @return mixed
     */
    public function getPublicPrice()
    {
        return $this->public_price;
    }

    public function isOrdered()
    {
        /**
         * Воозвращает true, если продукт Заказан для данного пользователя
         * @var $user \App\User
         */
        $user = \Auth::user();

        if (!$user) {
            return false;
        }

        return (bool) $user->orderedProducts()->where('product_id', '=', $this->id)->count();
    }

    /**
     * Воозвращает true, если продукт Отложен для данного пользователя
     * @return bool
     */
    public function isDeferred()
    {
        /**
         * @var $user \App\User
         */
        $user = \Auth::user();

        if (!$user) {
            return false;
        }

        return (bool) $user->deferredProducts()->where('product_id', '=', $this->id)->count();
    }
}
