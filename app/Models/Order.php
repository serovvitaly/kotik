<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 16.08.15
 * Time: 20:59
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{

    protected $fillable = ['product_id', 'quantity', 'user_id'];

}