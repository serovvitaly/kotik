<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class DeferredController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('basket.deferred');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response|null
     */
    public function store(Request $request)
    {
        /**
         * @var $user \App\User
         */
        $user = \Auth::user();

        if (!$user) {
            return null;
        }

        $product_id = $request->get('product_id');

        $product_model = \App\Models\Product::findOrFail($product_id);

        $sql = 'INSERT IGNORE INTO ' . \App\Models\OrderedProduct::TABLE . ' (created_at, user_id, product_id, catalog_id, is_deferred) '
            .'VALUES (now(), ?, ?, ?, 1)';

        \DB::insert($sql, [
            $user->id,
            $product_id,
            $product_model->catalog_id,
        ]);

        return [
            'basket_mini' => view('basket.mini_box')->render()
        ];
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  Request  $request
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        /**
         * @var $user \App\User
         */
        $user = \Auth::user();

        if (!$user) {
            return;
        }

        $user->deferredProducts()->findOrFail($id)->delete();

        return [
            'success' => true,
            'basket_mini' => view('basket.mini_box')->render()
        ];
    }
}
