<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class NewProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.product.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.product.edit_form');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $request_all = $request->all();

        var_dump($request_all); exit;

        /*$request_all['price_1'] = str_replace(',', '.', $request_all['price_1']);
        $request_all['price_2'] = str_replace(',', '.', $request_all['price_2']);
        $request_all['price_3'] = str_replace(',', '.', $request_all['price_3']);
        $request_all['price_4'] = str_replace(',', '.', $request_all['price_4']);*/

        $product_model = \App\Models\Product::create($request_all);

        if (array_key_exists('is_apply', $request_all)) {
            return view('admin.product.edit_form', [
                'model_name' => '\App\Models\ProductModel',
                'model_id' => $product_model->id
            ]);
        }

        return redirect("/admin/product");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        return 'show';
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function edit($id)
    {
        return 'edit';
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
        return 'update';
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        return 'destroy';
    }
}
