<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{
    /**
     *
     * @return Response
     */
    public function getIndex()
    {
        return view('basket.index');
    }

}
