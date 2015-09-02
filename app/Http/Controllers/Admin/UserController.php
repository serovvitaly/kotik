<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\AdminController;
use Illuminate\Http\Request;
use App\Http\Requests;

class UserController extends AdminController
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        if (!$this->user->userCan('user-view')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.user.index', [
            'route_base_url' => 'user',
            'model_name' => '\App\User'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        if (!$this->user->userCan('user-create')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.user.edit_form', [
            'route_base_url' => 'user',
            'model_name' => '\App\User'
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
        if (!$this->user->userCan('user-create')) {
            \App::abort(403, 'Access denied');
        }

        \App\User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email'),
            'password' => \Hash::make($request->input('password')),
        ]);

        return redirect('/admin/user');
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
        if (!$this->user->userCan('user-edit')) {
            \App::abort(403, 'Access denied');
        }

        return view('admin.rbac.user.edit_form', [
            'route_base_url' => 'user',
            'model_name' => '\App\User',
            'model_id' => $id,
            'user_roles_ids_arr' => \App\User::findOrFail($id)->getRolesIdsArr()
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
        if (!$this->user->userCan('user-edit')) {
            \App::abort(403, 'Access denied');
        }

        $user_model = \App\User::findOrFail($id);

        $user_model->update($request->all());

        $user_model->roles()->sync($request->get('roles', []));

        return redirect('/admin/user');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        if (!$this->user->userCan('user-delete')) {
            \App::abort(403, 'Access denied');
        }

        \App\User::destroy($id);

        return redirect('/admin/user');
    }
}
