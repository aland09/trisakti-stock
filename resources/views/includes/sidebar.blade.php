<nav id="sidebarMenu" class="sidebar d-lg-block bg-gray-800 text-white collapse" data-simplebar>
    <div class="sidebar-inner px-2 pt-3">
        <div
            class="user-card d-flex d-md-none align-items-center justify-content-between justify-content-md-center pb-4">
            <div class="d-flex align-items-center">
                <div class="avatar-lg me-4">
                    <img src="{{ asset('assets/img/team/profile-picture-3.jpg') }}"
                        class="card-img-top rounded-circle border-white" alt="Bonnie Green">
                </div>
                <div class="d-block">
                    <h2 class="h5 mb-3">Hi, Jane</h2>
                    <a href="{{ route('logout') }}"
                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();"
                        class="btn btn-secondary btn-sm d-inline-flex align-items-center">
                        <svg class="icon icon-xxs me-1" fill="none" stroke="currentColor" viewBox="0 0 24 24"
                            xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 16l4-4m0 0l-4-4m4 4H7m6 4v1a3 3 0 01-3 3H6a3 3 0 01-3-3V7a3 3 0 013-3h4a3 3 0 013 3v1">
                            </path>
                        </svg>
                        Sign Out
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                        @csrf
                    </form>
                </div>
            </div>
            <div class="collapse-close d-md-none">
                <a href="#sidebarMenu" data-bs-toggle="collapse" data-bs-target="#sidebarMenu"
                    aria-controls="sidebarMenu" aria-expanded="true" aria-label="Toggle navigation">
                    <svg class="icon icon-xs" fill="currentColor" viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg">
                        <path fill-rule="evenodd"
                            d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                            clip-rule="evenodd"></path>
                    </svg>
                </a>
            </div>
        </div>
        <ul class="nav flex-column pt-3 pt-md-0">
            <li class="nav-item">
                <a href="#!" class="py-3 px-3 h4 fw-bolder d-flex align-items-center">
                    {{-- <span class="sidebar-icon">
                        <img src="{{ asset('assets/img/logo/pemprov_dki.png') }}" height="30" width="30"
                            alt="Volt Logo">
                    </span>
                    <span class="mt-1 ms-3 sidebar-text fs-5 fw-bolder">E H I B A H</span> --}}
                    {{ config('app.name', 'Laravel') }}
                </a>
            </li>
            @role('user')
                <li class="nav-item {{ Request::is(['dashboard*']) ? 'active' : '' }}">
                    <a href="#!" class="nav-link" id="dashboard">
                        <span class="sidebar-icon">
                            <svg class="icon icon-xs me-2" fill="none" stroke="currentColor" stroke-width="1.5"
                                viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M10.5 6a7.5 7.5 0 107.5 7.5h-7.5V6z"></path>
                                <path stroke-linecap="round" stroke-linejoin="round"
                                    d="M13.5 10.5H21A7.5 7.5 0 0013.5 3v7.5z"></path>
                            </svg>
                        </span>
                        <span class="sidebar-text">User</span>
                    </a>
                </li>
            @endrole
            @role('admin')
                <li class="nav-item {{ Request::is(['categories*']) ? 'active' : '' }}">
                    <a href="{{ route('categories.index') }}" class="nav-link d-flex" id="categories">
                        <span class="sidebar-icon align-self-center me-3 ms-2">
                            <i class="bi bi-ui-checks-grid h5"></i>
                        </span>
                        <span class="sidebar-text">Category</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is(['inventories*']) ? 'active' : '' }}">
                    <a href="{{ route('inventories.index') }}" class="nav-link d-flex" id="inventories">
                        <span class="sidebar-icon align-self-center me-3 ms-2">
                            <i class="bi bi-boxes h5"></i>
                        </span>
                        <span class="sidebar-text">Inventory</span>
                    </a>
                </li>
                <li class="nav-item {{ Request::is(['rooms*']) ? 'active' : '' }}">
                    <a href="{{ route('rooms.index') }}" class="nav-link d-flex" id="rooms">
                        <span class="sidebar-icon align-self-center me-3 ms-2">
                            <i class="bi bi-building h5"></i>
                        </span>
                        <span class="sidebar-text">Room</span>
                    </a>
                </li>
            @endrole
        </ul>
    </div>
</nav>
