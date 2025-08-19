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
                            <!-- <th>Password</th> -->
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
                                <!-- <td>
                                    @if(empty($u->plain_password) || $u->role == 'superadmin')
                                        <p>******</p>
                                    @elseif(!empty($u->plain_password))
                                        {{ $u->plain_password}}
                                    @endif
                                </td> -->
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
                        @if(count($users) == 0)
                            <td colspan="9" class="text-center text-secondary">Data pengguna lain belum tersedia.</td>
                        @endif
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>