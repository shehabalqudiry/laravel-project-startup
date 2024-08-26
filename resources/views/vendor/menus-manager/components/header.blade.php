<li class="sidebar-item {{ $item->haschildren() ? 'has-sub' : '' }}">
    @if ($item->haschildren())
        <a href="#{{ $item->attributes['id'] }}" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle nav-link pl-3">
            <x-menus-icon class="{{ $item->icon }}" :item="$item" />
            <span class="ml-1 item-text">{{ $item->title }}</span>
        </a>
        <x-menus-children :items="$item->children()" class="submenu" id="{{ $item->attributes['id'] }}" />

 
        <a href="#" class="sidebar-link">
            <i class="bi bi-stack"></i>
            <span>{{ $item->title }}</span>
        </a>
        <ul class="submenu">
            <li class="submenu-item">
                <a href="component-accordion.html" class="submenu-link">Accordion</a>
            </li>
        </ul>
    @else
        <a href="{{ $item->getUrl() }}" class="sidebar-link">
            <x-menus-icon class="{{ $item->icon }}" :item="$item" />
            <span>{{ $item->title }}</span>
        </a>
    @endif
</li>

<li class="sidebar-item has-sub">
    <a href="#" class="sidebar-link">
        <i class="bi bi-stack"></i>
        <span>Components</span>
    </a>

    <ul class="submenu">
        <li class="submenu-item">
            <a href="component-accordion.html" class="submenu-link">Accordion</a>
        </li>
    </ul>
</li>
<li class="nav-item dropdown">
    @if ($item->haschildren())
        <a href="#{{ $item->attributes['id'] }}" data-toggle="collapse" aria-expanded="false"
            class="dropdown-toggle nav-link pl-3">
            <x-menus-icon class="{{ $item->icon }}" :item="$item" />
            <span class="ml-1 item-text">{{ $item->title }}</span>
        </a>
        <x-menus-children :items="$item->children()" class="collapse list-unstyled pl-4 w-100"
            id="{{ $item->attributes['id'] }}" />
    @else
        <a class="nav-link pl-3" href="{{ $item->getUrl() }}">
            <x-menus-icon class="{{ $item->icon }}" :item="$item" />
            <span class="ml-1 item-text">{{ $item->title }}</span>
        </a>
    @endif
</li>
