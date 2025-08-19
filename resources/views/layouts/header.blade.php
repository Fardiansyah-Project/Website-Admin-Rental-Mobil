<header class="app-header">
    <nav class="navbar navbar-expand-lg navbar-light">
        <ul class="navbar-nav">
            <li class="nav-item d-block d-xl-none">
                <a class="nav-link sidebartoggler " id="headerCollapse" href="javascript:void(0)">
                    <i class="ti ti-menu-2"></i>
                </a>
            </li>
            <li class="nav-item ">
                <a class="nav-link" href="{{ url('/') }}">
                    {{ ucfirst(Request::segment(1) ?? 'dashboard') }}
                </a>
            </li>
        </ul>
        <div class="navbar-collapse justify-content-end px-0" id="navbarNav">
            <ul class="navbar-nav flex-row ms-auto align-items-center justify-content-end">
                <li class="nav-item dropdown">
                    <button class="nav-link "  id="drop2" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <i class="ti ti-settings fs-9"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end dropdown-menu-animate-up" aria-labelledby="drop2">
                        <div class="message-body py-3 px-4">
                            <a href="{{ url('profile/edit/' . Auth::user()->id) }}" class="flex items-center gap-2 py-2 px-3 hover:bg-gray-100 rounded-md transition-colors duration-200">
                                <ti class="ti ti-user fs-9"></ti>
                                <span class="text-sm font-medium text-gray-700">Edit Profil</span>
                            </a>

                            <hr class="my-2 border-gray-200">
                            <form action="{{ route('logout.auth') }}" method="post">
                                @csrf
                                <button type="submit" class="flex items-center justify-center gap-2 w-full py-2 px-3 text-red-500 hover:bg-red-50 rounded-md transition-colors duration-200 btn btn-outline-danger align-items-center">
                                    <i class="ti ti-door-exit fs-5"></i>
                                    <span class="text-sm font-medium">Logout</span>
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
