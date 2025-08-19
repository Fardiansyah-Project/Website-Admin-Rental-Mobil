@extends('layouts.master')
@section('content')
<div class="row">
    <div class="col-sm-12 col-xxl-12">
        <div class="row d-flex flex-column flex-lg-row">
            <div class="col-lg-6 col-xxl-4 col-md-8 col-sm-8">
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-10 fw-semibold">Jumlah Transaksi</h5>
                        <div class="row align-items-center">
                            <div class="col-7">
                                <h4 class="fw-semibold mb-3">
                                    @if(count($tickets) == 0)
                                        <span class="text-secondary fs-6">Belum ada tiket terjual</span>
                                    @else
                                        {{ $tickets->where('status', 'success')->count('status')}}
                                        <span class="text-secondary">Tiket terjual</span>
                                    @endif
                                </h4>
                                <div class="d-flex align-items-center mb-2">
                                    <span
                                        class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">Saat ini</p>
                                    <p class="fs-3 mb-0">bulan {{now()->format('M-d-y')}}</p>
                                </div>
                            </div>
                            <div class="col-4 ms-3 bg-light-success rounded-circle">
                                <img src="{{ asset('assets/images/logos/ticket.png')}}" width="100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4 col-md-8 col-sm-8">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-10 fw-semibold">Pendapatan saat ini</h5>
                        <div class="row align-items-center">
                            <div class="col-7">
                                <h4 class="fw-semibold mb-3">
                                    @if(count($tickets) == 0)
                                        <span class="text-secondary fs-6">Belum ada penghasilan</span>
                                    @else
                                        Rp{{ number_format($tickets->where('status', 'success')->sum('price'), 0, ',', '.') }}
                                    @endif
                                </h4>
                                <div class="d-flex align-items-center mb-2">
                                    <span
                                        class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">Saat ini</p>
                                    <p class="fs-3 mb-0">bulan {{now()->format('M-d-y')}}</p>
                                </div>
                            </div>
                            <div class="col-4 ms-3 bg-light-info rounded-circle">
                                <img src="{{ asset('assets/images/logos/coins.png')}}" width="100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-xxl-4  col-md-8 col-sm-8">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-10 fw-semibold">Jumlah driver tersedia saat ini</h5>
                        <div class="row align-items-center">
                            <div class="col-7">
                                <h4 class="fw-semibold mb-3">
                                    @if(count($drivers) == 0)
                                        <span class="text-secondary fs-6">Data supir belum tersedia</span>
                                    @else
                                        {{ $drivers->where('status', 'Tersedia')->count($drivers) }}
                                        <span class="text-secondary">Driver tersedia</span>
                                    @endif
                                </h4>
                                <div class="d-flex align-items-center mb-2">
                                    <span
                                        class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">Saat ini</p>
                                    <p class="fs-3 mb-0">bulan {{now()->format('M-d-y')}}</p>
                                </div>
                            </div>
                            <div class="col-4 ms-3 bg-light-primary rounded-circle">
                                <img src="{{ asset('assets/images/logos/car.svg')}}" width="100" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card w-100">
                    <div class="card-body">
                        <!-- Header dengan logo -->
                        <div class="mb-3">
                            <h5 class="card-title fw-semibold fs-5">
                                <img src="{{ asset('assets/images/logos/2.png') }}" 
                                     class="img-fluid" 
                                     style="max-height: 50px; width: auto;"
                                     alt="Logo">
                            </h5>
                        </div>
                        
                        <!-- Container untuk gambar mobil -->
                        <div class="row g-3 py-3">
                            <!-- Gambar mobil pertama -->
                            <div class="col-12 col-md-6">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('/assets/images/backgrounds/Car1.png') }}" 
                                         class="img-fluid" 
                                         style="max-width: 100%; height: auto; object-fit: contain;"
                                         alt="Car 1">
                                </div>
                            </div>
                            
                            <!-- Gambar mobil kedua -->
                            <div class="col-12 col-md-6">
                                <div class="d-flex justify-content-center">
                                    <img src="{{ asset('/assets/images/backgrounds/Car2.png') }}" 
                                         class="img-fluid" 
                                         style="max-width: 100%; height: auto; object-fit: contain;"
                                         alt="Car 2">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
