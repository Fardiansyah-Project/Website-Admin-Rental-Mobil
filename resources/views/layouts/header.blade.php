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
                        <div class="message-body d-flex justify-content-center align-items-center py-3">
                            <form action="{{ route('logout.auth') }}" method="post">
                                @csrf
                                <button type="submit"
                                    class="btn btn-outline-primary d-block w-100">
                                    Logout
                                </button>
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </nav>
</header>
