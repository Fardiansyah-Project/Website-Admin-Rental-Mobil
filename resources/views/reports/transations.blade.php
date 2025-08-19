@extends('layouts.master')
@section('content')
    <div class="card mt-4">
        <div class="card-body">
            <div class="card-title d-flex justify-content-between align-items-center">
                <h5 class="card-title fw-semibold">Data Laporan Pada 
                    <span class="text-info">{{ now()->format('d-m-Y')}}</span></h5>
                @if(!empty($transations->where('status', 'success')) && count($transations->where('status', 'success')) > 0)
                    <div class="d-flex gap-2">
                        <a href="{{ route('transations.pdf') }}" class="btn btn-danger">Export PDF</a>
                        <a href="{{ route('transations.excel') }}" class="btn btn-success">Export Excel</a>
                    </div>
                @endif
            </div>
            @if (session('success_deleted'))
                <div class="alert alert-success text-center">
                    {{ session('success_deleted') }}
                </div>
            @endif
            @if (session('error_deleted'))
                <div class="alert alert-danger text-center">
                    {{ session('error_deleted') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-bordered align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>No</th>
                            <th>Nomor Tiket</th>
                            <th>Nama Penumpang</th>
                            <th>Tujuan</th>
                            <th>Tanggal Pemesanan</th>
                            <th>Tanggal Keberangkatan</th>
                            <th>Jam Keberangkatan</th>
                            <th>Nomor Kursi</th>
                            <th>Status</th>
                            <th>Jenis Mobil</th>
                            <th>Nomor Plat</th>
                            <th>Harga</th>
                            <th>Nama Supir</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($transations as $index => $data)
                            <tr>
                                <td>{{ ($transations->currentPage() - 1) * $transations->perPage() + $loop->iteration }}</td>
                                <td>{{ $data->ticket_number }}</td>
                                <td>{{ $data->passenger_name }}</td>
                                <td>{{ $data->destination }}</td>
                                <td>{{ $data->order_date}}</td>
                                <td>{{ $data->departure_date }}</td>
                                <td>{{ $data->departure_time }} WITA</td>
                                <td>{{ $data->seat_number}}</td>
                                <td>
                                    @if($data->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($data->status == 'confirmed')
                                        <span class="badge bg-info">Confirmed</span>
                                    @elseif($data->status == 'success')
                                        <span class="badge bg-success">Success</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $data->type_carrier }}</td>
                                <td>{{ $data->driver->vehicle_plate_number }}</td>
                                <td>Rp{{ number_format($data->price, 0, ',', '.') }}</td>
                                <td>{{ $data->driver->name_driver }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="13" class="text-center text-secondary">Data supir belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                {{ $transations->links() }}
            </div>
        </div>
    </div>
@endsection

    