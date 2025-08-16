@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-3">Edit Data</h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('drivers.update', $data->id) }}">
                        @csrf
                        @method('PUT')
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
                                        value="{{ old('name_driver', $data->name_driver) }}" />
                                    @error('name_driver')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ old('email', $data->email) }}" />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="phone_number" class="form-label">Nomor Telp</label>
                                    <input type="number" class="form-control" id="phone_number" name="phone_number"
                                        value="{{ old('phone_number', $data->phone_number) }}">
                                    @error('phone_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="address" class="form-label">Alamat</label>
                                    <input type="text" class="form-control" id="address" name="address"
                                        value="{{ old('address', $data->address) }}" />
                                    @error('address')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="vehicle_type" class="form-label">Jenis Kendaraan</label>
                                    <input type="text" class="form-control" id="vehicle_type" name="vehicle_type"
                                        value="{{ old('vehicle_type', $data->vehicle_type) }}" />
                                    @error('vehicle_type')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="vehicle_plate_number" class="form-label">Nomor Kendaraan</label>
                                    <input type="text" class="form-control" id="vehicle_plate_number"
                                        name="vehicle_plate_number"
                                        value="{{ old('vehicle_plate_number', $data->vehicle_plate_number) }}">
                                    @error('vehicle_plate_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="license_number" class="form-label">Nomor SIM</label>
                                    <input type="text" class="form-control" id="license_number" name="license_number"
                                        value="{{ old('license_number', $data->license_number) }}">
                                    @error('license_number')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select name="status" id="status" class="form-control">
                                        <option value="" disabled
                                            {{ old('status', $data->status) ? 'Tersedia' : 'selected' }}>Status
                                            pengendara saat ini</option>
                                        <option value="Aktif"
                                            {{ old('status', $data->status) === 'Aktif' ? 'selected' : '' }}>Aktif
                                        </option>
                                        <option value="Tersedia"
                                            {{ old('status', $data->status) === 'Tersedia' ? 'selected' : '' }}>
                                            Tersedia
                                        </option>
                                    </select>
                                    @error('status')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ url('/drivers') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
