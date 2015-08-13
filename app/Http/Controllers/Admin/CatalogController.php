<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;

class CatalogController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.catalog.index', [
            'route_base_url' => 'catalog',
            'model_name' => '\App\Models\Catalog',
            'model_items' => $this->user->catalogs()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.catalog.edit_form', [
            'route_base_url' => 'catalog',
            'model_name' => '\App\Models\Catalog'
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
        \App\Models\Catalog::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'user_id' => $this->user->id,
        ]);

        return redirect('/admin/catalog');
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
        $this->user->catalogs()->findOrFail($id);

        return view('admin.catalog.edit_form', [
            'route_base_url' => 'catalog',
            'model_name' => '\App\Models\Catalog',
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
        $catalog_model = \App\Models\Catalog::findOrFail($id);

        $catalog_model->update($request->all());

        return redirect('/admin/catalog');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        //$this->user->catalogs()->findOrFail($id)->delete();

        return redirect('/admin/catalog');
    }
}
