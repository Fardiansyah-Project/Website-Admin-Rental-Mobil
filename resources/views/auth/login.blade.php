<!doctype html>
<html lang="en">

<head>
    @include('layouts.head', ['title' => 'Login'])
</head>

<body>
    <!--  Body Wrapper -->
    <div class="page-wrapper" id="main-wrapper" data-layout="vertical" data-navbarbg="skin6" data-sidebartype="full"
        data-sidebar-position="fixed" data-header-position="fixed">
        <div
            class="position-relative overflow-hidden text-bg-light min-vh-100 d-flex align-items-center justify-content-center">
            <div class="d-flex align-items-center justify-content-center w-100">
                <div class="row justify-content-center w-100">
                    <div class="col-6 col-md-8 col-lg-6 col-xxl-3">
                        <div class="card mb-0">
                            <div class="card-body px-3 px-md-5 px-lg-3">
                                <a href="{{ url('/')}}" class="text-nowrap logo-img text-center d-block py-3 w-100">
                                    <img src="{{ asset('assets/images/logos/family.png')}}" alt="">
                                </a>
                                <p class="text-center text-info">Halaman Dashbord Admin</p>
                                <form method="POST" action="{{ route('login.auth') }}">
                                    @csrf
                                    @if ($errors->has('login_error'))
                                        <div class="alert alert-danger text-center">
                                            {{ $errors->first('login_error') }}
                                        </div>
                                    @endif
                                    <div class="mb-3">
                                        <label for="email" class="form-label">
                                            Email <i class="ti ti-mail"></i>
                                        </label>
                                        <input type="text" class="form-control" name="email" id="email" value="{{old('email')}}">
                                        @error('email')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="form-label">
                                            Password <i class="ti ti-lock-off"></i>
                                        </label>
                                        <input type="password" class="form-control" id="password" name="password">
                                        @error('password')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <button type="submit" class="btn btn-primary w-100 py-8 fs-4 mb-4">Sign In</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('layouts.script')
</body>

</html>
