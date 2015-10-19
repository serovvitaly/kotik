<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    const TABLE_NAME = 'new_products';

    protected $table = 'new_products';

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

    public function competitorsLinks()
    {
        return $this->hasMany('\App\Models\CompetitorLink');
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
        return $this->current_price;
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

    /**
     * Возвращает актуальные товарные предложения
     */
    public function getActualProductOffers()
    {
        $sql = "select co.offer_id, po.id as product_offer_id
                from offers ofr
                join catalog_offer co on co.offer_id = ofr.id
                join catalogs ct on co.catalog_id = ct.id
                join products_offers po on po.catalog_id = ct.id
                join ".self::TABLE_NAME." p on po.product_id = p.id
                where ofr.status = 1 and ct.status = 1 and po.status = 1 and po.product_id = :product_id";
        $result = \DB::select($sql, ['product_id' => $this->id]);

        if ( ! $result ) {

            return [];
        }

        $output_arr = [];

        foreach ($result as $row) {

            $obj = new \stdClass();

            /**
             * @var \App\Models\Offer $offer_model
             * @var \App\Models\ProductOffer $product_offer_model
             */
            $offer_model = \App\Models\Offer::findOrFail($row->offer_id);
            $product_offer_model = \App\Models\ProductOffer::findOrFail($row->product_offer_id);

            $obj->offer = $offer_model;
            $obj->product_offer = $product_offer_model;

            $obj->price = $product_offer_model->getPrice();

            if ($offer_model->margin_percent > 0) {

                $obj->price += $obj->price * $offer_model->margin_percent / 100;
            }

            $obj->price = round($obj->price, 2);

            $output_arr[] = $obj;

        }

        return $output_arr;
    }
}
