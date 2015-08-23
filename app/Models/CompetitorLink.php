<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CompetitorLink extends Model
{
    protected $table = 'competitors_links';

    protected $fillable = ['url', 'price', 'image'];
}
