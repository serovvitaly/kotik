<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class PaymentController extends Controller
{
    /**
     *
     */
    public function getIndex()
    {
        return view('torg12');
    }

}
