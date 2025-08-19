@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h5 class="card-title fw-semibold">
                    <i class="ti ti-user"></i> Data Anda
                </h5>
                <a href="{{ url('/profile/editPassword/' . Auth::user()->id) }}" class="btn btn-outline-danger">
                    <i class="ti ti-key"></i>
                    Ganti Kata Sandi
                </a>
            </div>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.update', $profile->id) }}">
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
                        @if(session('new_user_password'))
                            <div class="alert alert-info text-center">
                                {{ session('new_user_password') }}<br>
                                <small class="text-danger">
                                    Simpan password ini, karena tidak akan muncul lagi.
                                </small>
                            </div>
                        @endif
                        <div class="row">
                            <div class="col-md-12">
                                <div class="mb-3">
                                    <label for="name" class="form-label">Nama Pengguna</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name', $profile->name) }}" />
                                    @error('name')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="text" class="form-control" id="email" name="email"
                                        value="{{ old('email', $profile->email) }}" />
                                    @error('email')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Perbarui</button>
                            <a href="{{ url('/') }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
