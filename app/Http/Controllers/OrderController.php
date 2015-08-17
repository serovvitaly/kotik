<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
     * @return Response
     */
    public function store(Request $request)
    {
        $product_id = $request->get('product_id');

        $product_model = \App\Models\Product::findOrFail($product_id);

        /**
         * @var $user \App\User
         */
        $user = \Auth::user();

        $sql = 'INSERT INTO orders (user_id, product_id, catalog_id, public_price, quantity) VALUES (?, ?, ?, ?, ?) ON DUPLICATE KEY UPDATE quantity = quantity + ?';

        $public_price = $product_model->getPublicPrice();

        $quantity = $request->get('quantity');

        \DB::insert($sql, [
            $user->id,
            $product_id,
            $product_model->catalog_id,
            $public_price,
            $quantity,
            $quantity,
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
        //
    }
}
