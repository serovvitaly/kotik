<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
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
        $role_model = \App\Role::create($request->all());

        $role_model->permissions()->sync($request->get('permissions'));

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
        \App\Role::destroy($id);

        return redirect('/admin/role');
    }
}
