<aside class="left-sidebar">
    <!-- Sidebar scroll-->
    <div>
        <div class="brand-logo d-flex align-items-center justify-content-between">
            <a href="./index.html" class="text-nowrap logo-img">
                <img src="{{ asset('assets/images/logos/logo.svg') }}" alt="" />
            </a>
            <div class="close-btn d-xl-none d-block sidebartoggler cursor-pointer" id="sidebarCollapse">
                <i class="ti ti-x fs-8"></i>
            </div>
        </div>
        <!-- Sidebar navigation-->
        <nav class="sidebar-nav scroll-sidebar" data-simplebar="">
            <ul id="sidebarnav">
                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg" href="{{ url('/') }}" aria-expanded="false">
                        {{-- <iconify-icon icon="solar:atom-line-duotone"></iconify-icon> --}}
                        {{-- <i class="ti ti-home font-icon"></i> --}}
                        <iconify-icon icon="solar:home-2-line-duotone"></iconify-icon>
                        <span class="hide-menu">Dashboard</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg" href="{{ url('/drivers') }}" aria-expanded="false">
                        <iconify-icon icon="solar:user-id-line-duotone"></iconify-icon>
                        <span class="hide-menu">Data Pengemudi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg" href="{{ url('/tickets') }}" aria-expanded="false">
                        <iconify-icon icon="solar-ticket-sale-line-duotone"></iconify-icon>
                        <span class="hide-menu">Data Transaksi</span>
                    </a>
                </li>
                <li class="sidebar-item">
                    <a class="sidebar-link primary-hover-bg justify-content-between has-arrow" href="javascript:void(0)"
                        aria-expanded="false">
                        <div class="d-flex align-items-center gap-6">
                            <span class="d-flex">
                                <iconify-icon icon="solar:settings-line-duotone"></iconify-icon>
                            </span>
                            <span class="hide-menu">Kontrol Data</span>
                        </div>
                        <span class="hide-menu badge text-bg-primary fs-1 py-1 px-2 rounded-pill me-4">
                            {{ Auth::user()->role ?? '' }}
                        </span>
                    </a>
                    <ul aria-expanded="false" class="collapse first-level">
                        <li class="sidebar-item">
                            <a class="sidebar-link primary-hover-bg justify-content-between"
                                href="{{ url('/transations') }}">
                                <div class="d-flex align-items-center gap-6">
                                    <span class="d-flex">
                                        <span class="icon-small"></span>
                                    </span>
                                    <span class="hide-menu">Laporan Transaksi</span>
                                </div>
                                <iconify-icon icon="solar:notebook-line-duotone"></iconify-icon>
                            </a>
                        </li>
                        @if (Auth::user()->role == 'superadmin')
                            <li class="sidebar-item">
                                <a class="sidebar-link primary-hover-bg justify-content-between"
                                    href="{{ url('/users')}}">
                                    <div class="d-flex align-items-center gap-6">
                                        <span class="d-flex">
                                            <span class="icon-small"></span>
                                        </span>
                                        <span class="hide-menu">Manajemen Pengguna</span>
                                    </div>
                                    <iconify-icon icon="solar:user-plus-line-duotone"></iconify-icon>
                                </a>
                            </li>
                        @endif
                    </ul>
                </li>
            </ul>
        </nav>
        <!-- End Sidebar navigation -->
    </div>
    <!-- End Sidebar scroll-->
</aside>
