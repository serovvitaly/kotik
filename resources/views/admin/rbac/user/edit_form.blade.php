@extends('admin.layout')

@section('form_footer')

    {{ $all_roles_arr = \App\Role::paginate(10) }}

    <?php
    if (!isset($user_roles_ids_arr)) {
        $user_roles_ids_arr = [];
    }
    ?>

    <div class="form-group">
        <label>Роли</label> - <a href="/admin/role">перейти к списку ролей</a>
        @foreach($all_roles_arr as $role)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="roles[]" value="{{ $role->id }}"{{ in_array($role->id, $user_roles_ids_arr) ? ' checked' : '' }}>
                    <a href="/admin/role/{{ $role->id }}/edit">{{ $role->name }}</a> - {{ $role->display_name }}
                </label>
            </div>
        @endforeach
    </div>

@endsection

@section('content')
    @include('admin.common.edit_form')
@endsection
