<div class="card mt-4">
  <div class="card-body">
    <h5 class="card-title fw-semibold mb-4">Data Tiket</h5>

    @if (session('success_deleted'))
      <div class="alert alert-success text-center">{{ session('success_deleted') }}</div>
    @endif
    @if (session('error_deleted'))
      <div class="alert alert-danger text-center">{{ session('error_deleted') }}</div>
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
          @forelse($tickets as $ticket)
            <tr>
              <td>{{ ($tickets->currentPage() - 1) * $tickets->perPage() + $loop->iteration }}</td>
              <td>{{ $ticket->ticket_number }}</td>
              <td>{{ optional($ticket->driver)->name_driver }}</td>
              <td>{{ $ticket->passenger_name }}</td>
              <td>{{ $ticket->destination }}</td>
              <td>{{ $ticket->order_date }}</td>
              <td>{{ $ticket->departure_date }}</td>
              <td>{{ $ticket->departure_time }}</td>
              <td>{{ $ticket->seat_number }}</td>
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
              <td>{{ optional($ticket->driver)->vehicle_plate_number }}</td>
              <td>Rp{{ number_format($ticket->price, 0, ',', '.') }}</td>
              <td>
                <a href="{{ route('tickets.edit', $ticket->id) }}" class="btn btn-sm btn-warning" title="Edit">
                  <i class="ti ti-edit"></i>
                </a>
                <form action="{{ route('tickets.destroy', $ticket->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus data ini?');">
                  @csrf
                  @method('DELETE')
                  <button type="submit" class="btn btn-sm btn-danger" title="Hapus">
                    <i class="ti ti-trash"></i>
                  </button>
                </form>
              </td>
            </tr>
          @empty
            <tr>
              <td colspan="14" class="text-center text-secondary">Data tiket belum tersedia.</td>
            </tr>
          @endforelse
        </tbody>
      </table>
      {{ $tickets->links() }}
    </div>
  </div>
</div>