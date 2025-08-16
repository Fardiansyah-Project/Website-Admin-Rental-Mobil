<?php

namespace App\Exports;

use App\Models\TicketsModel;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class TransationExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        return TicketsModel::with('driver')
            ->where('status', 'confirmed')
            ->orderBy('order_date', 'desc')
            ->get()
            ->map(function($row) {
                return [
                    'ticket_number'  => $row->ticket_number,
                    'passenger_name' => $row->passenger_name,
                    'destination'    => $row->destination,
                    'order_date'     => $row->order_date,
                    'departure_date' => $row->departure_date,
                    'departure_time' => $row->departure_time,
                    'seat_number'    => $row->seat_number,
                    'type_carrier'   => $row->type_carrier,
                    'plate_number'   => $row->plate_number,
                    'driver'         => $row->driver->name_driver ?? '-',
                    'price'          => $row->price,
                ];
            });
    }

    public function headings(): array
    {
        return [
            'No Tiket',
            'Nama Penumpang',
            'Tujuan',
            'Tanggal Pesan',
            'Tanggal Berangkat',
            'Jam Berangkat',
            'Nomor Kursi',
            'Jenis Mobil',
            'Plat Nomor',
            'Nama Sopir',
            'Harga',
        ];
    }
}
