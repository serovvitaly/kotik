<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        return view('admin.brand.index', [
            'route_base_url' => 'brand',
            'model_name' => '\App\Models\Brand',
            'model_items' => \App\Models\Brand::paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.brand.edit_form', [
            'route_base_url' => 'brand',
            'model_name' => '\App\Models\Brand'
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
        \App\Models\Brand::create([
            'name' => $request->get('name'),
            'description' => $request->get('description'),
            'site_url' => $request->get('site_url'),
        ]);

        return redirect('/admin/brand');
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
        \App\Models\Brand::findOrFail($id);

        return view('admin.brand.edit_form', [
            'route_base_url' => 'brand',
            'model_name' => '\App\Models\Brand',
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
        $model = \App\Models\Brand::findOrFail($id);

        $model->update($request->all());

        return redirect('/admin/brand');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        \App\Models\Brand::findOrFail($id)->delete();

        return redirect('/admin/brand');
    }
}
