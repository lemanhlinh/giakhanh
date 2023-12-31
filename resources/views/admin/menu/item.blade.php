<li class="dd-item" data-id="{{ $item->id }}" data-name="{{ $item->name }}" data-link="{{ $item->link }}" >
    <div class="dd-handle">
        {{ isset($item->translations->name)?$item->translations->name:$item->name }}
    </div>
    <div class="dd-remove" data-url="{{ route('admin.menu.destroy', $item->menu_id) }}">
        Xóa
    </div>
    <input type="text" class="form-control update-name" id="update-name-{{ $item->menu_id }}" value="{{ isset($item->translations->name)?$item->translations->name:$item->name }}">
    <input type="text" class="form-control update-link" id="update-link-{{ $item->menu_id }}" value="{{ $item->url }}" @if(!empty($item->name_url)) readonly @endif>
    @if (count($item->children) > 0)
        <ol class="dd-list">
            @foreach ($item->children as $val)
                @include('admin.menu.item', ['item'=>$val])
            @endforeach
        </ol>
    @endif
</li>
