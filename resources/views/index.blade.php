@extends('layouts.master')
@section('content')
<div class="row">
    <!-- <div class="col-lg-8 d-flex align-items-strech">
        <div class="card w-100">
            <div class="card-body">
                <div class="d-flex align-items-center justify-content-between mb-1">
                    <div class="">
                        <h5 class="card-title fw-semibold">Profit & Expenses</h5>
                    </div>
                    <div class="dropdown">
                        <button id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false"
                            class="rounded-circle btn-transparent rounded-circle btn-sm px-1 btn shadow-none">
                            <i class="ti ti-dots-vertical fs-7 d-block"></i>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownMenuButton1">
                            <li><a class="dropdown-item" href="#">Action</a></li>
                            <li>
                                <a class="dropdown-item" href="#">Another action</a>
                            </li>
                            <li>
                                <a class="dropdown-item" href="#">Something else here</a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div id="profit"></div>
            </div>
        </div>
    </div> -->
    <div class="col-lg-8">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <!-- Monthly Earnings -->
                <div class="card">
                    <div class="card-body">
                        <div class="row alig n-items-start">
                            <div class="col-8">
                                <h5 class="card-title mb-10 fw-semibold">Jumlah Transaksi</h5>
                                <h4 class="fw-semibold mb-3">
                                    {{count($tickets)}} <span class="text-success fs-4">Tiket terjual</span>
                                </h4>
                                <div class="d-flex align-items-center pb-1">
                                    <span
                                        class="me-2 rounded-circle bg-light-danger round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-down-right text-danger"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">Saat ini</p>
                                    <p class="fs-3 mb-0">Tahun {{now()->format('Y')}}</p>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="d-flex justify-content-end">
                                    <div
                                        class="text-white bg-danger rounded-circle p-6 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-currency-dollar fs-6"></i>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6">
                <!-- Yearly Breakup -->
                <div class="card overflow-hidden">
                    <div class="card-body p-4">
                        <h5 class="card-title mb-10 fw-semibold">Traffic Distribution</h5>
                        <div class="row align-items-center">
                            <div class="col-7">
                                <h4 class="fw-semibold mb-3">$36,358</h4>
                                <div class="d-flex align-items-center mb-2">
                                    <span
                                        class="me-1 rounded-circle bg-light-success round-20 d-flex align-items-center justify-content-center">
                                        <i class="ti ti-arrow-up-left text-success"></i>
                                    </span>
                                    <p class="text-dark me-1 fs-3 mb-0">+9%</p>
                                    <p class="fs-3 mb-0">last year</p>
                                </div>
                                <div class="d-flex align-items-center">
                                    <div class="me-3">
                                        <span class="round-8 bg-primary rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Oragnic</span>
                                    </div>
                                    <div>
                                        <span class="round-8 bg-danger rounded-circle me-2 d-inline-block"></span>
                                        <span class="fs-2">Refferal</span>
                                    </div>
                                </div>
                            </div>
                            <div class="col-5">
                                <div class="d-flex justify-content-center">
                                    <div id="grade"></div>
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
