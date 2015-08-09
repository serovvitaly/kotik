<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;

    protected $fillable = ['title'];

    public static function getByParents()
    {
        $items_by_parents = [];

        foreach (self::all() as $item) {

            if (!array_key_exists($item->parent_id, $items_by_parents)) {
                $items_by_parents[$item->parent_id] = [];
            }

            $items_by_parents[$item->parent_id][] = $item;
        }

        return $items_by_parents;
    }
}