<aside class="sidebar-left border-right bg-white shadow" id="leftSidebar" data-simplebar {{ $attributes }}>
    <a href="#" class="btn collapseSidebar toggle-btn d-lg-none text-muted ml-2 mt-3" data-toggle="toggle">
        <i class="fe fe-x"><span class="sr-only"></span></i>
    </a>
    <nav class="vertnav navbar navbar-light">
        <!-- nav bar -->
        <div class="w-100 mb-4 d-flex">
            <a class="navbar-brand mx-auto mt-2 flex-fill text-center" href="./index.html">
            </a>
        </div>
        <ul class="navbar-nav flex-fill w-100 mb-2">
            @foreach ($items as $item)
                @if ($item->isDivider())
                    <x-menus-divider :item="$item" class="border-0 bg-gray-500 text-gray-500 h-px" />
                @else
                    <x-menus-item :item="$item" />
                @endif
            @endforeach
        </ul>
    </nav>
</aside>
