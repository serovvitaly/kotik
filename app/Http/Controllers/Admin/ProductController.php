<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;

class ProductController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @param $catalog_id
     * @param Request $request
     * @return Response
     */
    public function index($catalog_id, Request $request)
    {
        $catalog_model = \App\Models\Catalog::findOrFail( $catalog_id );

        if ($catalog_model->user->id != $this->user->id) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.catalog.product.index', [
            'catalog_id' => $catalog_id,
            'route_base_url' => $catalog_id . '/product',
            'model_name' => '\App\Models\Product',
            'model_items' => $catalog_model->products()->paginate(30)
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @param $catalog_id
     * @return Response
     */
    public function create($catalog_id)
    {
        return view('admin.catalog.product.edit_form', [
            'catalog_id' => $catalog_id,
            'route_base_url' => $catalog_id . '/product',
            'model_name' => '\App\Models\Product',
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param $catalog_id
     * @param  Request $request
     * @return Response
     */
    public function store($catalog_id, Request $request)
    {
        $request_all = $request->all();

        $request_all['price_1'] = str_replace(',', '.', $request_all['price_1']);
        $request_all['price_2'] = str_replace(',', '.', $request_all['price_2']);
        $request_all['price_3'] = str_replace(',', '.', $request_all['price_3']);
        $request_all['price_4'] = str_replace(',', '.', $request_all['price_4']);

        $product_model = \App\Models\Product::create($request_all);

        if (array_key_exists('is_apply', $request_all)) {
            return view('admin.catalog.product.edit_form', [
                'catalog_id' => $catalog_id,
                'route_base_url' => $catalog_id . '/product',
                'model_name' => '\App\Models\Product',
                'model_id' => $product_model->id
            ]);
        }

        return redirect("/admin/{$catalog_id}/product");
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
     * @param $catalog_id
     * @param  int $id
     * @return Response
     */
    public function edit($catalog_id, $id)
    {
        return view('admin.catalog.product.edit_form', [
            'catalog_id' => $catalog_id,
            'route_base_url' => 'product',
            'model_name' => '\App\Models\Product',
            'model_id' => $id
        ]);
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
        /*if (!$this->user->can('product-edit')) {
            \App::abort(403, 'Access denied');
        }*/

        $product_model = \App\Models\Product::findOrFail($id);

        $request_all = $request->all();

        $request_all['price_1'] = str_replace(',', '.', $request_all['price_1']);
        $request_all['price_2'] = str_replace(',', '.', $request_all['price_2']);
        $request_all['price_3'] = str_replace(',', '.', $request_all['price_3']);
        $request_all['price_4'] = str_replace(',', '.', $request_all['price_4']);

        $product_model->update($request_all);

        if (array_key_exists('is_apply', $request_all)) {
            return view('admin.catalog.product.edit_form', [
                'route_base_url' => 'product',
                'model_name' => '\App\Models\Product',
                'model_id' => $product_model->id
            ]);
        }

        return redirect("/admin/{$product_model->catalog_id}/product");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $catalog_id
     * @param  int $id
     * @return Response
     */
    public function destroy($catalog_id, $id)
    {
        $product_model = \App\Models\Product::findOrFail($id);

        $catalog_id = $product_model->catalog_id;

        $product_model->delete();

        return redirect("/admin/{$catalog_id}/product");
    }
}
