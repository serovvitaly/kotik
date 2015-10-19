<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 13.08.15
 * Time: 21:54
 */

namespace App\Helpers;


class CatalogViewerHelper
{

    public static function getActualOffersProducts()
    {
        return \App\Models\Product::where('status', '=', 1)->paginate(20);

        $sql = "select ps.product_id
            from catalogs ct
            join products_offers ps on ct.id = ps.catalog_id
            where ct.status = 1 and ps.status = 1 limit 20";
        $products_ids_obj_arr = \DB::select($sql);

        if ( empty($products_ids_obj_arr) ) {

            return [];
        }

        $products = [];

        foreach ($products_ids_obj_arr as $product_obj) {

            $products[] = \App\Models\Product::findOrFail($product_obj->product_id);
        }

        //print_r($products); exit;

        return $products;

        $products = \App\Models\Product::where('status', '>', 0)->where('price_1', '>', 0)->paginate(20);

        return $products;
    }

    public static function breakOnColumns($model_records, $num_columns = 4)
    {
        if (! count($model_records) ) {
            return [];
        }

        $output_columns = [];

        $col_index = 0;

        foreach ($model_records as $model_record) {

            if (!array_key_exists($col_index, $output_columns)) {
                $output_columns[$col_index] = [];
            }

            $output_columns[$col_index][] = $model_record;

            $col_index++;

            if ($col_index >= $num_columns) {
                $col_index = 0;
            }
        }

        return $output_columns;
    }

}