<!doctype html>
<html lang="en">

<head>
    @include('layouts.head', ['title' => 'B-Trans Family'])
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <!--  App Topstrip -->
        @include('layouts.top-strip')
        <!-- Sidebar Start -->
        @include('layouts.sidebar')
        <!--  Sidebar End -->
        <!--  Main wrapper -->
        <div class="body-wrapper">
            <div class="body-wrapper-inner">
                <div class="container-fluid">
                    <!--  Header Start -->
                    @include('layouts.header')
                    <!--  Header End -->
                    <!--  Row 1 -->
                    @yield('content')
                    @include('layouts.footer')
                </div>
            </div>
        </div>
    </div>

    @include('layouts.script')
    <!-- solar icons -->
</body>

</html>
