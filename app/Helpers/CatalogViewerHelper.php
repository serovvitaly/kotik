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