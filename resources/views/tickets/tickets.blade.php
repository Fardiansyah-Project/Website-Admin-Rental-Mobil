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
                <div class="alert alert-danger text-center">{{ session('error') }}</div>
              @endif
              @if(session('success'))
                <div class="alert alert-success text-center">{{ session('success') }}</div>
              @endif

              <div class="row">
                <div class="col-md-6">
                  <div class="mb-3">
                    <label class="form-label">Pilih Supir</label>
                    <select name="id_driver" id="id_driver" class="form-control">
                      <option value="">-- Pilih Sopir --</option>
                      @foreach($drivers as $driver)
                        <option value="{{ $driver->id }}"
                                data-type_carrier="{{ $driver->vehicle_type }}"
                                data-plate_number="{{ $driver->vehicle_plate_number }}"
                                {{ old('id_driver') == $driver->id ? 'selected' : '' }}>
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

                  {{-- Tanggal Keberangkatan --}}
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
                      <option value="">-- Pilih Status --</option>
                      <option value="pending"   {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                      <option value="confirmed" {{ old('status') == 'confirmed' ? 'selected' : '' }}>Confirmed</option>
                      <option value="cancelled" {{ old('status') == 'cancelled' ? 'selected' : '' }}>Cancelled</option>
                      <option value="success"   {{ old('status') == 'success' ? 'selected' : '' }}>Success</option>
                    </select>
                    @error('status') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Jenis Mobil</label>
                    <input type="text" name="type_carrier" id="type_carrier" class="form-control" value="{{ old('type_carrier') }}" readonly>
                    @error('type_carrier') <small class="text-danger">{{ $message }}</small> @enderror
                  </div>

                  <div class="mb-3">
                    <label class="form-label">Nomor Kendaraan</label>
                    <input type="text" name="plate_number" id="plate_number" class="form-control" value="{{ old('plate_number') }}" readonly>
                    @error('plate_number') <small class="text-danger">{{ $message }}</small> @enderror
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

    @include('components.tables.data-tickets')

    <script src="{{ asset('js/controller.js')}}"></script>
@endsection
