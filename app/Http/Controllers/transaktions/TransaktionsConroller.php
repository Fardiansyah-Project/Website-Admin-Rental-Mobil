<?php

namespace App\Http\Controllers\transaktions;
use App\Exports\TransationExport;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\TicketsModel;
use App\Models\DriversModel;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;

class TransaktionsConroller extends Controller
{
    public function transations()
    {
        $transations = TicketsModel::with('driver')
        ->where('status', 'success')
        ->orderBy('order_date', 'desc')
        // ->get([
        //     'ticket_number',
        //     'passenger_name',
        //     'destination',
        //     'order_date',
        //     'departure_date',
        //     'departure_time',
        //     'seat_number',
        //     'status',
        //     'type_carrier',
        //     'plate_number',
        //     'price',
        //     'id_driver',
        // ])
        ->paginate(20);


        return view('reports.transations', compact('transations'));
    }

    public function exportPDF()
    {
        $transations = TicketsModel::with('driver')
            ->where('status', 'success')
            ->orderBy('order_date', 'desc')
            ->get();

        $pdf = Pdf::loadView('reports.transations_pdf', compact('transations'))
            ->setPaper('a4', 'landscape');

        return $pdf->download('laporan-transaksi.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new TransationExport, 'laporan-transaksi.xlsx');
    }

}
