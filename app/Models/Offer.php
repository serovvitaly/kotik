<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    protected $fillable = ['title', 'user_id'];

    protected $hidden = ['user_id'];

    public function catalogs()
    {
        return $this->belongsToMany('App\Models\Catalog');
    }

    public function getCatalogsIdsArr()
    {
        $catalogs_rows = \DB::table('catalog_offer')->where('offer_id', '=', $this->id)->get(['catalog_id']);

        if (empty($catalogs_rows)) {
            return [];
        }

        $catalogs_ids_arr = [];
        foreach ($catalogs_rows as $catalog_row) {
            $catalogs_ids_arr[] = $catalog_row->catalog_id;
        }

        return $catalogs_ids_arr;
    }
}
