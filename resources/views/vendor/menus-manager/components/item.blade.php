@if($item->haschildren())
<li class="nav-item dropdown" {{ $attributes->merge($item->attributes) }}>
    <a href="#{{ $item->id }}" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle nav-link">
        <x-menus-icon class="{{ $item->icon }}" :item="$item" />
        <span class="ml-3 item-text">{{ $item->title }}</span>
    </a>
    <x-menus-children :items="$item->children()" class="list-unstyled pl-4 w-100" />
</li>
@else
<li {{ $attributes->merge($item->attributes) }}>
    <a class="nav-link pl-3" href="{{ $item->getUrl() }}">
        <x-menus-icon class="{{ $item->icon }}" :item="$item" />
        <span class="ml-1 item-text">{{ $item->title }}</span>
    </a>
</li>
@endif
