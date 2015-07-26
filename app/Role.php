<?php

namespace App;

use Zizaco\Entrust\EntrustRole;

class Role extends EntrustRole
{
    protected $fillable = ['name', 'display_name', 'description'];

    public function permissions()
    {
        return $this->belongsToMany('App\Permission');
    }

    public function getPermissionsIdsArr()
    {
        $permissions_rows = \DB::table( \Config::get('entrust.permission_role_table') )->where('role_id', '=', $this->id)->get(['permission_id']);

        if (empty($permissions_rows)) {
            return [];
        }

        $permissions_ids_arr = [];
        foreach ($permissions_rows as $permission_row) {
            $permissions_ids_arr[] = $permission_row->permission_id;
        }

        return $permissions_ids_arr;
    }
}
