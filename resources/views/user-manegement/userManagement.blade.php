@extends('layouts.master')
@section('content')
    <div class="card">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">
                <i class="ti ti-user"></i> Form Pengguna
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
    <div class="card mt-4">
        <div class="card-body">
            <h5 class="card-title fw-semibold mb-4">Data Pengguna</h5>
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
                            <th>Nama</th>
                            <th>Email</th>
                            <th>Password</th>
                            <th>Posisi</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->email }}</td>
                                <td>
                                    @if(empty($u->plain_password) || $u->role == 'superadmin')
                                        <p>******</p>
                                    @elseif(!empty($u->plain_password))
                                        {{ $u->plain_password}}
                                    @endif
                                </td>
                                <td>{{ $u->role }}</td>
                                <td>
                                    <a href="{{ route('users.edit', $u->id) }}"class="btn btn-sm btn-warning"
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
                                    <form action="{{ route('users.destroy', $u->id) }}" method="POST"
                                        style="display:inline-block;"
                                        onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                                        @csrf
                                        @method('DELETE')
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
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection