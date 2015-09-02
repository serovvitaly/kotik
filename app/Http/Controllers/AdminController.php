<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

abstract class AdminController extends Controller
{

    protected $request;

    protected $user;

    public function __construct(Request $request)
    {
        $this->user = \Auth::user();

        if (!$this->user->userCan('adminka-access')) {
            \App::abort(403, 'Access denied');
        }

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
