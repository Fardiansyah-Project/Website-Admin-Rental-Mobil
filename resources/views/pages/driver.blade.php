@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
                <i class="ti ti-car"></i> Form Driver 
            </h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('drivers.store') }}">
                        @csrf
                        @if (session('error'))
                            <div class="alert alert-danger text-center">
                                {{ session('error') }}
                            </div>
                        @endif
                        @if (session('success'))
                            <div class="alert alert-success text-center">
                                {{ session('success') }}
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name_driver" class="form-label">Nama Supir</label>
                                    <input type="text" class="form-control" id="name_driver" name="name_driver"
                                        value="{{ old('name_driver') }}" />
                                    @error('name_driver')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ old('email') }}" />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Nomor Telp</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number') }}">
                                    @error('phone_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address') }}" />
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="vehicle_type" class="form-label">Jenis Kendaraan</label>
                                    <input type="text" class="form-control" id="vehicle_type" name="vehicle_type"
                                        value="{{ old('vehicle_type') }}" />
                                    @error('vehicle_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="vehicle_plate_number" class="form-label">Nomor Kendaraan</label>
                                    <input type="text" class="form-control" id="vehicle_plate_number"
                                        name="vehicle_plate_number" value="{{ old('vehicle_plate_number') }}">
                                    @error('vehicle_plate_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="license_number" class="form-label">Nomor SIM</label>
                                    <input type="text" class="form-control" id="license_number" name="license_number"
                                        value="{{ old('license_number') }}">
                                    @error('license_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">
                                        Status
                                        <span class="text-disabled">(Disabled)</span>
                                    </label>
                                    {{-- <select name="status" id="status" class="form-control" @readonly(true)>
                                        <option value="Tersedia" disabled {{ old('status') ? '' : 'selected' }}>Status
                                            pengendara saat ini</option>
                                        <option value="Aktif" {{ old('status') === 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Tersedia"
                                            {{ old('status', $data->status) === 'Tersedia' ? 'selected' : '' }}>
                                            Tersedia
                                        </option>
                                    </select> --}}
                                    <input type="text" name="status" id="status" class="form-control"
                                        value="Tersedia" aria-disabled="true" readonly />
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
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
                            <th>Nama Supir</th>
                            <th>Email</th>
                            <th>Nomor Telp</th>
                            <th>Alamat</th>
                            <th>Jenis Kendaraan</th>
                            <th>Nomor Kendaraan</th>
                            <th>Nomor SIM</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($data as $index => $driver)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>{{ $driver->name_driver }}</td>
                                <td>{{ $driver->email }}</td>
                                <td>{{ $driver->phone_number }}</td>
                                <td>{{ $driver->address }}</td>
                                <td>{{ $driver->vehicle_type }}</td>
                                <td>{{ $driver->vehicle_plate_number }}</td>
                                <td>{{ $driver->license_number }}</td>
                                <td>{{ $driver->status }}</td>
                                <td>
                                    <a href="{{ route('drivers.edit', $driver->id) }}" class="btn btn-sm btn-warning"
                                        title="Edit">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-edit"
                                            width="20" height="20" viewBox="0 0 24 24" stroke-width="2"
                                            stroke="#fff" fill="none" stroke-linecap="round"
                                            stroke-linejoin="round">
                                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                            <path d="M9 7h.01" />
                                            <path d="M3 17v4h4l11 -11a2.828 2.828 0 0 0 -4 -4l-11 11" />
                                        </svg>
                                    </a>
                                    <form action="{{ route('drivers.deleted', $driver->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('POST')
                                        <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                                            <svg xmlns="http://www.w3.org/2000/svg"
                                                class="icon icon-tabler icon-tabler-trash" width="20" height="20"
                                                viewBox="0 0 24 24" stroke-width="2" stroke="#fff" fill="none"
                                                stroke-linecap="round" stroke-linejoin="round">
                                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                                <path d="M4 7l16 0" />
                                                <path d="M10 11l0 6" />
                                                <path d="M14 11l0 6" />
                                                <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                                <path d="M9 7l0 -3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1l0 3" />
                                            </svg>
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
