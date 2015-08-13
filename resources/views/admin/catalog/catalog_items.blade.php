<div class="dropdown" style="position:relative">
    <input type="hidden" name="category_id">
    <a href="#" class="btn btn-default dropdown-toggle" data-toggle="dropdown"><span class="title">-- выберите категорию -- </span> <span class="caret"></span></a>
    <ul class="dropdown-menu">

        <?php
        $categories_items_by_parent = \App\Models\Category::getByParents();
        ?>

        @foreach($categories_items_by_parent[1] as $parent_item)

            <li><a data-category-id="{{ $parent_item->id }}" href="#" class="trigger right-caret">{{ $parent_item->title }}</a>
                <ul class="dropdown-menu sub-menu">
                @foreach($categories_items_by_parent[$parent_item->id] as $item)
                    <li><a data-category-id="{{ $item->id }}" href="/cat-{{ $item->id }}">{{ $item->title }}</a></li>
                @endforeach
                </ul>
            </li>

        @endforeach
        
    </ul>
</div>
