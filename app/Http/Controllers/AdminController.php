<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class AdminController extends Controller
{

    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    protected function isJson()
    {
        return $this->request->isJson();
    }

    protected function isAjax()
    {
        return $this->request->ajax();
    }

}
