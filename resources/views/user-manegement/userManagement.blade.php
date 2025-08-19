@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
                <i class="ti ti-user"></i> Formulir Pengguna
            </h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('users.store') }}">
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
                        @if(session('new_user_password'))
                            <div class="alert alert-info text-center">
                                {{ session('new_user_password') }}<br>
                                <small class="text-danger">
                                    Simpan password ini, karena tidak akan muncul lagi.
                                </small>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" />
                                    @error('name')
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
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="password" class="form-label">
                                        Password
                                        <span class="text-info ml-3">dibuat secara otomatis</span>
                                    </label>
                                    <input type="password" class="form-control" id="password" name="password"
                                        value="{{ old('plain_password') }}" readonly />
                                </div>
                                <div class="mb-3">
                                    <label for="role" class="form-label">
                                        Posisi
                                    </label>
                                    <select name="role" id="role" class="form-control" @readonly(true)>
                                        <option value="" disabled>
                                            Pilih Posisi
                                        </option>
                                        <option value="admin">
                                            Admin
                                        </option>
                                        <option value="superadmin">
                                            Super Admin
                                        </option>
                                    </select>
                                    @error('role')
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
    @include('components.tables.data-users')
@endsection