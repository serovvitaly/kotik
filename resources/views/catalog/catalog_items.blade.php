<div class="btn-group btn-group-justified">

    <?php
        $categories_items_by_parent = \App\Models\Category::getByParents();
    ?>

    @foreach($categories_items_by_parent[1] as $parent_item)

    <div class="btn-group">
        <button type="button" class="btn @if(!empty($parent_item->color_class))btn-{{ $parent_item->color_class }}@endif dropdown-toggle" data-toggle="dropdown">
            {{ $parent_item->title }}
        </button>
        <ul class="dropdown-menu @if(!empty($parent_item->color_class))dropdown-{{ $parent_item->color_class }}@endif">
            @foreach($categories_items_by_parent[$parent_item->id] as $item)
            <li><a data-category-id="{{ $item->id }}" href="/cat-{{ $item->id }}">{{ $item->title }}</a></li>
            @endforeach
        </ul>
    </div>

    @endforeach

</div>
