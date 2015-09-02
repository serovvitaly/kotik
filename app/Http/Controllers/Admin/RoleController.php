<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;

class RoleController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!$this->user->userCan('role-view')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.role.index', [
            'route_base_url' => 'role',
            'model_name' => '\App\Role'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!$this->user->userCan('role-create')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.role.edit_form', [
            'route_base_url' => 'role',
            'model_name' => '\App\Role',
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
        if (!$this->user->userCan('role-create')) {
            \App::abort(403, 'Access denied');
        }

        $role_model = \App\Role::create($request->all());

        $role_model->permissions()->sync($request->get('permissions', []));

        return redirect('/admin/role');
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
        if (!$this->user->userCan('role-edit')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.role.edit_form', [
            'route_base_url' => 'role',
            'model_name' => '\App\Role',
            'model_id' => $id,
            'role_permissions_ids_arr' => \App\Role::findOrFail($id)->getPermissionsIdsArr()
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
        if (!$this->user->userCan('role-edit')) {
            \App::abort(403, 'Access denied');
        }

        $role_model = \App\Role::findOrFail($id);

        $role_model->update($request->all());

        $role_model->permissions()->sync($request->get('permissions', []));

        return redirect('/admin/role');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!$this->user->userCan('role-delete')) {
            \App::abort(403, 'Access denied');
        }

        \App\Role::destroy($id);

        return redirect('/admin/role');
    }
}
