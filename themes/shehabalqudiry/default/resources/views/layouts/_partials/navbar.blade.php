<nav class="topnav navbar navbar-light">
    <button type="button" class="navbar-toggler text-muted mt-2 p-0 mr-3 collapseSidebar">
        <i class="fe fe-menu navbar-toggler-icon"></i>
    </button>
    <ul class="nav">
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="#" id="modeSwitcher" data-mode="dark">
                <i class="fe fe-sun fe-16"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-shortcut">
                <span class="fe fe-grid fe-16"></span>
            </a>
        </li>
        <li class="nav-item nav-notif">
            <a class="nav-link text-muted my-2" href="./#" data-toggle="modal" data-target=".modal-notif">
                <span class="fe fe-bell fe-16"></span>
                <span class="dot dot-md bg-success"></span>
            </a>
        </li>
        <div class="dropdown">
            <a href="#" class="dropdown-toggle" type="button" id="dropdownMenuButtonEmoji"
                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="me-50">
                    {{--  <i class="rounded-circle bi bi-person"></i>  --}}
                    {{--  image   --}}
                    <img src="{{ $settings['app_logo'] }}" alt="avatar" class="rounded-circle" width="30"
                        height="30">
                </span>
            </a>
            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButtonEmoji"
                style="margin: 0px; position: absolute; inset: 0px auto auto 0px; transform: translate(-180px, 38px);">
                <a class="dropdown-item" href="{{ route('admin.profile.edit') }}"><span class="dropdown-item-emoji"><i
                            class="bi bi-person-fill"></i></span> {{ __('Profile') }}</a>
                {{--  <a class="dropdown-item" href="#"><span class="dropdown-item-emoji">😎</span></a>  --}}
                {{--  logout form  --}}
                <div class="dropdown-divider"></div>

                <form action="{{ route('admin.logout') }}" class="d-inline" method="post">
                    @csrf
                    <button type="submit" class="dropdown-item"><span class="dropdown-item-emoji">
                            <i class="bi bi-door-closed-fill"></i></span> {{ __('Logout') }}
                    </button>
                </form>
            </div>
        </div>
    </ul>
</nav>
