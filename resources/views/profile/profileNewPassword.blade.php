@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
                <i class="ti ti-lock"></i> Perbarui Kata Sandi Anda
            </h5>
            <div class="card">
                <div class="card-body">
                    <form method="POST" action="{{ route('profile.updatePassword', $profile->id) }}">
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
                                    <label for="current_password" class="form-label">Kata sandi saat ini</label>
                                    <input type="password" class="form-control" id="current_password" name="current_password"/>
                                    @error('current_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password" class="form-label">Kata sandi baru</label>
                                    <input type="password" class="form-control" id="new_password" name="new_password"/>
                                    @error('new_password')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="new_password_confirmation" class="form-label">Konfirmasi kata sandi baru</label>
                                    <input type="password" class="form-control" id="new_password_confirmation" name="new_password_confirmation"/>
                                    @error('new_password_confirm')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-3">
                            <button type="submit" class="btn btn-primary">Perbarui kata sandi</button>
                            <a href="{{ url('/profile/edit/' . Auth::user()->id) }}" class="btn btn-outline-secondary">Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
