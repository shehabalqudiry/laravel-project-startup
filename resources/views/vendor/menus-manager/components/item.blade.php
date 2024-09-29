@if ($item->haschildren())
    <li class="sidebar-item has-sub" {{ $attributes->merge($item->attributes) }}>
        <a href="#{{ $item->id }}" class="sidebar-link">
            <x-menus-icon class="{{ $item->icon }}" :item="$item" />
            <span>{{ $item->title }}</span>
        </a>

        <x-menus-children :items="$item->children()" class="submenu" />
    </li>
@else
    <li class="sidebar-item {{ $item->isActive() ? 'active' : '' }}" {{ $attributes->merge($item->attributes) }}>
        <a href="{{ $item->getUrl() }}" class="sidebar-link">
            <x-menus-icon class="{{ $item->icon }}" :item="$item" />
            <span>{{ $item->title }}</span>
        </a>
    </li>
@endif
