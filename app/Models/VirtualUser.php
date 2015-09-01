<?php
/**
 * Created by PhpStorm.
 * User: vitaly
 * Date: 01.09.15
 * Time: 21:39
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VirtualUser extends Model
{
    protected $fillable = ['last_ip'];
}