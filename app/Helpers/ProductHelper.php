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
     * Создает коллекцию товарных предложений в акции
     * @param int $offer_id
     */
    public static function makeProductsInPurchasesCollection($offer_id = 0)
    {
        $offer_id = (int) $offer_id;

        $product_in_purchase_table_name = \App\Models\ProductInPurchase::TABLE_NAME;

        /**
         * Очищаем все товарные предложения в акциях, лоя которых нет реальных активных товарных предложений
         */
        \DB::table($product_in_purchase_table_name)->where('offers_count', '<', 1)->delete();

        if ($offer_id > 0) {
            /**
             * Если указан ID торговой акции, то очищаем товарные предложения только для неё
             */
            \DB::table($product_in_purchase_table_name)->where('offer_id', '=', $offer_id)->delete();

            $insert_sql = "insert {$product_in_purchase_table_name} (product_offer_id, offer_id, min_price, offers_count) (
                    select pp.product_offer_id, co.offer_id,
                           min(pp.value)*(100+ofr.margin_percent)/100 as min_price,
                           count(pp.product_offer_id) as offers_count
                    from offers ofr
                      join catalog_offer co on co.offer_id = ofr.id
                      join catalogs ct on ct.id = co.catalog_id
                      join products_offers po on po.catalog_id = ct.id
                      join products_prices pp on pp.product_offer_id = po.id
                    where ofr.status = 1 and ct.status = 1 and po.status = 1 and ofr.id = {$offer_id}
                    group by pp.product_offer_id, co.offer_id
                )";

        } else {
            /**
             * Если НЕ указан ID торговой акции, то очищаем товарные предложения для всех акций
             */
            \DB::table($product_in_purchase_table_name)->delete();

            $insert_sql = "insert {$product_in_purchase_table_name} (product_offer_id, offer_id, min_price, offers_count) (
                    select pp.product_offer_id, co.offer_id,
                           min(pp.value)*(100+ofr.margin_percent)/100 as min_price,
                           count(pp.product_offer_id) as offers_count
                    from offers ofr
                      join catalog_offer co on co.offer_id = ofr.id
                      join catalogs ct on ct.id = co.catalog_id
                      join products_offers po on po.catalog_id = ct.id
                      join products_prices pp on pp.product_offer_id = po.id
                    where ofr.status = 1 and ct.status = 1 and po.status = 1
                    group by pp.product_offer_id, co.offer_id
                )";
        }

        \DB::insert($insert_sql);

    }

    /**
     * Массовое обновление цен на все товарные предложения в акциях,
     * в соответствии с их статусом
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
     * Массовое обновление колличества активных товарных предложений
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