@extends('admin.layout')

@section('form_footer')

    <?php
        if (isset($model_id) and $model_id > 0) {

            $use_catalogs_ids_arr = \App\Models\Offer::findOrFail($model_id)->getCatalogsIdsArr();
        } else {

            $use_catalogs_ids_arr = [];
        }

    ?>

    <div class="form-group">
        <label>Каталоги</label>
        @foreach(\Auth::user()->catalogs()->get() as $catalog)
            <div class="checkbox">
                <label>
                    <input type="checkbox" name="catalogs[]" value="{{ $catalog->id }}"{{ in_array($catalog->id, $use_catalogs_ids_arr) ? ' checked' : '' }}>
                    {{ $catalog->name }}
                </label>
            </div>
        @endforeach
    </div>

@endsection

@section('content')
    @include('admin.common.edit_form')
@endsection
