<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Requests;
use App\Http\Controllers\AdminController;

class OfferController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.offer.index', [
            'route_base_url' => 'offer',
            'model_name' => '\App\Models\Offer',
            'model_items' => $this->user->offers()->paginate()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.offer.edit_form', [
            'route_base_url' => 'offer',
            'model_name' => '\App\Models\Offer'
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $model = \App\Models\Offer::create([
            'title' => $request->get('title'),
            'user_id' => $this->user->id,
        ]);

        $model->catalogs()->sync($request->get('catalogs', []));

        return redirect('/admin/offer');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->user->offers()->findOrFail($id);

        return view('admin.offer.edit_form', [
            'route_base_url' => 'offer',
            'model_name' => '\App\Models\Offer',
            'model_id' => $id,
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $model = \App\Models\Offer::findOrFail($id);

        $model->update($request->all());

        $model->catalogs()->sync($request->get('catalogs', []));

        return redirect('/admin/offer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //$this->user->offers()->findOrFail($id)->delete();

        return redirect('/admin/offer');
    }
}
