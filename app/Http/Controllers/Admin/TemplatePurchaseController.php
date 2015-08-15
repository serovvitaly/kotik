<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;

class TemplatePurchaseController extends AdminController
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

        return view('admin.catalog.template-purchase.index', [
            'catalog_id' => $catalog_id,
            'route_base_url' => $catalog_id . '/template-purchase',
            'model_name' => '\App\Models\TemplatePurchase',
            'model_items' => $catalog_model->templates_purchases()->paginate()
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
        return view('admin.catalog.template-purchase.edit_form', [
            'route_base_url' => $catalog_id . '/template-purchase',
            'model_name' => '\App\Models\TemplatePurchase'
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
        \App\Models\TemplatePurchase::create($request->all());

        return redirect('/admin/catalog/' . $catalog_id . '/edit');
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
        $template_purchase_model = \App\Models\TemplatePurchase::findOrFail($id);

        if ($template_purchase_model->catalog->user->id != $this->user->id) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.catalog.template-purchase.edit_form', [
            'route_base_url' => $catalog_id . '/template-purchase',
            'model_name' => '\App\Models\TemplatePurchase',
            'model_id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $catalog_id
     * @param  Request $request
     * @param  int $id
     * @return Response
     */
    public function update($catalog_id, Request $request, $id)
    {
        $template_purchase_model = \App\Models\TemplatePurchase::findOrFail($id);

        if ($template_purchase_model->catalog->user->id != $this->user->id) {
            \App::abort(403, 'Access denied');
        }

        $template_purchase_model->update($request->all());

        return redirect('/admin/catalog/' . $catalog_id . '/edit');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $template_purchase_model = \App\Models\TemplatePurchase::findOrFail($id);

        if ($template_purchase_model->catalog->user->id != $this->user->id) {
            \App::abort(403, 'Access denied');
        }

        $catalog_id = $template_purchase_model->catalog_id;

        $template_purchase_model->delete();

        return redirect('/admin/catalog/' . $catalog_id . '/edit');
    }
}
