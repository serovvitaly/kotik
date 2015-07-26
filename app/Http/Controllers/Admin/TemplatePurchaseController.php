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
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $catalog_model = \App\Models\Catalog::findOrFail( $request->get('catalog_id') );

        if ($catalog_model->user->id != $this->user->id) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.catalog.template-purchase.index', [
            'route_base_url' => 'template-purchase',
            'model_name' => '\App\Models\TemplatePurchase',
            'model_items' => $catalog_model->templates_purchases()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.catalog.template-purchase.edit_form', [
            'route_base_url' => 'template-purchase',
            'model_name' => '\App\Models\TemplatePurchase'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        \App\Models\TemplatePurchase::create($request->all());

        return redirect('/admin/catalog/' . $request->get('catalog_id') . '/edit');
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
        $template_purchase_model = \App\Models\TemplatePurchase::findOrFail($id);

        if ($template_purchase_model->catalog->user->id != $this->user->id) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.catalog.template-purchase.edit_form', [
            'route_base_url' => 'template-purchase',
            'model_name' => '\App\Models\TemplatePurchase',
            'model_id' => $id,
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
        $template_purchase_model = \App\Models\TemplatePurchase::findOrFail($id);

        if ($template_purchase_model->catalog->user->id != $this->user->id) {
            \App::abort(403, 'Access denied');
        }

        $template_purchase_model->update($request->all());

        return redirect('/admin/catalog/' . $request->get('catalog_id') . '/edit');
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
