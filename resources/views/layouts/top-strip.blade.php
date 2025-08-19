<div class="app-topstrip bg-dark py-10 px-3 w-100 d-lg-flex align-items-center justify-content-between">
    <div class="d-flex align-items-center justify-content-center gap-5 mb-2 mb-lg-0">
        <a class="d-flex justify-content-center" href="https://www.wrappixel.com/" target="_blank">
            <img src="{{ asset('assets/images/logos/rent-car.png') }}" alt="" width="130" height="34">
        </a>
    </div>
    <div class="d-lg-flex align-items-center gap-2">
        <h3 class="text-white mb-2 mb-lg-0 fs-5 text-center">
            Selamat datang, 
            <a href="{{ url('profile/edit/' . Auth::user()->id) }}">
                {{ Auth::user()->name }} 
            </a>
        </h3>
    </div>
</div>
