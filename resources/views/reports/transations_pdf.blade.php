<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Laporan Transaksi</title>
    <style>
        table {
            width: 100%;
            border-collapse: collapse;
            font-size: 12px;
        }
        th, td {
            border: 1px solid #000;
            padding: 5px;
            text-align: left;
        }
        th {
            background-color: #eee;
        }
    </style>
</head>
<body>
    <h3>Laporan Transaksi Tahun {{ now()->format('m-d-Y') }} - Yang Telah Dikonfirmasi</h3>
    <table>
        <thead>
            <tr>
                <th>No Tiket</th>
                <th>Nama Penumpang</th>
                <th>Tujuan</th>
                <th>Tanggal Pesan</th>
                <th>Tanggal Berangkat</th>
                <th>Jam</th>
                <th>No Kursi</th>
                <th>Jenis Mobil</th>
                <th>Plat Nomor</th>
                <th>Nama Sopir</th>
                <th>Harga</th>
            </tr>
        </thead>
        <tbody>
            @foreach($transations as $row)
            <tr>
                <td>{{ $row->ticket_number }}</td>
                <td>{{ $row->passenger_name }}</td>
                <td>{{ $row->destination }}</td>
                <td>{{ $row->order_date }}</td>
                <td>{{ $row->departure_date }}</td>
                <td>{{ $row->departure_time }}</td>
                <td>{{ $row->seat_number }}</td>
                <td>{{ $row->type_carrier }}</td>
                <td>{{ $row->plate_number }}</td>
                <td>{{ $row->driver->name_driver ?? '-' }}</td>
                <td>{{ number_format($row->price, 0, ',', '.') }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>
