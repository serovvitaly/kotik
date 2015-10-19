<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 16.10.15
 * Time: 23:12
 */

namespace App\Helpers;


use App\Models\Product;

class ProductHelper
{
    /**
     * Массовое обновление цен на все продукты,
     * в соответствии с их активными товарными предложениями и активными торговыми акциями
     */
    public static function massUpdateProductsPrices()
    {
        $sql = "update ".Product::TABLE_NAME." set current_price = 0";
        \DB::update($sql);

        $sql = "update ".Product::TABLE_NAME." p
                left join (
                    select po.product_id, min(pp.value) as current_price
                        from products_prices pp
                        join products_offers po on po.id = pp.product_offer_id
                        group by po.product_id
                        order by pp.created_at desc
                ) as ppz on p.id = ppz.product_id
                set p.current_price = ppz.current_price";
        \DB::update($sql);
    }

    /**
     * Массовое обновление колличества активных товарных предложений на все продукты
     */
    public static function massUpdateProductsOffersCounts()
    {
        $sql = "update ".Product::TABLE_NAME." set offers_count = 0";
        \DB::update($sql);

        $sql = "update ".Product::TABLE_NAME." p
                left join (
                    select product_id, count(product_id) as offers_count
                        from products_offers
                        group by product_id
                ) as po on p.id = po.product_id
                set p.offers_count = po.offers_count";
        \DB::update($sql);
    }

    /**
     * Массовое обновление статуса на все продукты,
     * в соответствии с их активными товарными предложениями и активными торговыми акциями
     */
    public static function massUpdateProductsStatuses()
    {
        $sql = "update ".Product::TABLE_NAME." set status = 0";
        \DB::update($sql);

        $sql = "update ".Product::TABLE_NAME." p
                  join products_offers po on p.id = po.product_id
                  join catalogs ct on ct.id = po.catalog_id
                set p.status = 1
                where ct.status = 1 and po.status = 1";
        \DB::update($sql);
    }

}