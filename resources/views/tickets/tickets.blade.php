@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
                <i class="ti ti-ticket"></i> Form Ticket
            </h5>
            <div class="card">
                <div class="card-body">
                    <form action="{{ route('tickets.store') }}" method="POST">
                        @csrf
                        @if(session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if(session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Pilih Supir</label>
                                    <select name="id_driver" class="form-control">
                                        <option value="">-- Pilih Sopir --</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->id }}" {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name_driver }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('id_driver') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nama Penumpang</label>
                                    <input type="text" name="passenger_name" class="form-control" value="{{ old('passenger_name') }}">
                                    @error('passenger_name') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tujuan</label>
                                    <input type="text" name="destination" class="form-control" value="{{ old('destination') }}">
                                    @error('destination') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Pemesanan</label>
                                    <input type="date" name="order_date" class="form-control" value="{{ old('order_date') }}">
                                    @error('order_date') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Tanggal Keberangkatan</label>
                                    <input type="date" name="departure_date" class="form-control" value="{{ old('departure_date') }}">
                                    @error('departure_date') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label class="form-label">Jam Keberangkatan</label>
                                    <input type="time" name="departure_time" id="departure_time" class="form-control" value="{{ old('departure_time') }}">
                                    @error('departure_time') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor Kursi</label>
                                    <input type="text" name="seat_number" class="form-control" value="{{ old('seat_number') }}">
                                    @error('seat_number') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Status</label>
                                    <select name="status" class="form-control">
                                        <option value="" >-- Pilih Status --</option>
                                        <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>s
                                        <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                                        <option value="success" {{ old('status') == 'success' ? 'selected' : '' }}>Success</option>
                                    </select>
                                    @error('status') 
                                        <small class="text-danger">{{ $message }}</small> 
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Jenis Mobil</label>
                                    <select name="type_carrier" class="form-control">
                                        <option value="">-- Pilih jenis Mobile --</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->vehicle_type }}" {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
                                                    {{ $driver->name_driver }} - {{ $driver->vehicle_type }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type_carrier') <small class="text-danger">{{ $message }}</small> @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label">Nomor kendaraan</label>
                                    <select name="plate_number" class="form-control">
                                        <option value="">-- Pilih nomor plat mobil --</option>
                                        @foreach($drivers as $driver)
                                            <option value="{{ $driver->vehicle_plate_number }}" {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
                                                {{ $driver->name_driver }} - {{ $driver->vehicle_plate_number }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('plate_number')
                                        <small class="text-danger">{{ $message }}</small> 
                                    @enderror
                                </div>
                            </div>
                            <div class="mb-3">
                                    <label class="form-label">Harga</label>
                                    <input type="number" name="price" class="form-control" value="{{ old('price') }}">
                                    @error('price') <small class="text-danger">{{ $message }}</small> @enderror
                            </div>
                        </div>            
                        <button type="submit" class="btn btn-primary">Submit</button>            
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Pengemudi</h5>
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
                            <th>Nama Supir</th>
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
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tickets as $index => $ticket)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $ticket->ticket_number }}</td>
                                <td>{{ $ticket->driver->name_driver }}</td>
                                <td>{{ $ticket->passenger_name }}</td>
                                <td>{{ $ticket->destination }}</td>
                                <td>{{ $ticket->order_date}}</td>
                                <td>{{ $ticket->departure_date }}</td>
                                <td>{{ $ticket->departure_time }}</td>
                                <td>{{ $ticket->seat_number}}</td>
                                <td>
                                    @if($ticket->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($ticket->status == 'confirmed')
                                        <span class="badge bg-info">Confirmed</span>
                                    @elseif($ticket->status == 'success')
                                        <span class="badge bg-success">Success</span>
                                    @else
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </td>
                                <td>{{ $ticket->type_carrier }}</td>
                                <td>{{ $ticket->driver->vehicle_plate_number }}</td>
                                <td>Rp{{ number_format($ticket->price, 0, ',', '.') }}</td>
                                <td>
                                    <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <i class="ti ti-edit"></i>
                                    </a>
                                    <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <i class="ti ti-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="9" class="text-center">Data supir belum tersedia.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection

    