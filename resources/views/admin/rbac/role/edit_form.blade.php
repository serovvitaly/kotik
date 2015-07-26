@extends('admin.layout')

@section('footer_form')

    {{ $all_permissions_arr = \App\Permission::paginate(10) }}

    <div class="form-group">
        <label>Привилегии</label> - <a href="/admin/permission">перейти к списку привилегий</a>
    @foreach($all_permissions_arr as $permission)
        <div class="checkbox">
            <label>
                <input type="checkbox" name="permissions[]" value="{{ $permission->id }}"{{ in_array($permission->id, $role_permissions_ids_arr) ? ' checked' : '' }}>
                {{ $permission->name }} - {{ $permission->display_name }}
            </label>
        </div>
    @endforeach
    </div>

@endsection

@section('content')
    @include('admin.common.edit_form', ['footer_content' => 'role_footer_content'])
@endsection
