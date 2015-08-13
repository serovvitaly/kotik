<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 09.08.15
 * Time: 22:52
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductPrice extends Model
{

    protected $fillable = ['name', 'code', 'article', 'price_1', 'price_2', 'price_3', 'price_4'];

}