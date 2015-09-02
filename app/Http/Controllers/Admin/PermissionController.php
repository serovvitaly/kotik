<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;

class PermissionController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!$this->user->userCan('permission-view')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.permission.index', [
            'route_base_url' => 'permission',
            'model_name' => '\App\Permission'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!$this->user->userCan('permission-create')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.permission.edit_form', [
            'route_base_url' => 'permission',
            'model_name' => '\App\Permission'
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
        if (!$this->user->userCan('permission-create')) {
            \App::abort(403, 'Access denied');
        }

        \App\Permission::create($request->all());

        return redirect('/admin/permission');
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
        if (!$this->user->userCan('permission-edit')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.permission.edit_form', [
            'route_base_url' => 'permission',
            'model_name' => '\App\Permission',
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
        if (!$this->user->userCan('permission-edit')) {
            \App::abort(403, 'Access denied');
        }

        $permission_model = \App\Permission::findOrFail($id);

        $permission_model->update($request->all());

        return redirect('/admin/permission');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!$this->user->userCan('permission-delete')) {
            \App::abort(403, 'Access denied');
        }

        \App\Permission::destroy($id);

        return redirect('/admin/permission');
    }
}
