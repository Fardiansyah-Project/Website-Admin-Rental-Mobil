<?php

namespace App\Http\Controllers\tickets;

use App\Http\Controllers\Controller;
use App\Models\TicketsModel;
use App\Models\DriversModel;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class TicketsController extends Controller
{
    public function index()
    {
        $tickets = TicketsModel::with('driver:id,name_driver,vehicle_plate_number,vehicle_type')
            ->latest()
            ->paginate(5);

        $drivers = DriversModel::select('id','name_driver','vehicle_plate_number','vehicle_type')
            ->orderBy('name_driver')
            ->orderBy('vehicle_plate_number')
            ->orderBy('vehicle_type')
            ->get();

        return view('tickets.tickets', compact('tickets','drivers'));
    }


    public function store(Request $request)
    {
        try {
                $driverBusy = TicketsModel::where('id_driver', $request->id_driver)
                    ->where('status', 'confirmed')
                    ->exists();

                if ($driverBusy && $request->status === 'confirmed') {
                    return redirect()->back()
                        ->withErrors(['id_driver' => 'Supir ini sedang memiliki tiket dengan status confirmed.'])
                        ->withInput();
                }

            $ticket_number = 'BT-' . now()->format('Ymd') . '-' . random_int(1000, 9999);
            $validated = $request->validate([
                'id_driver'        => 'required|exists:drivers_models,id',
                'passenger_name'   => 'required|string|max:255',
                'destination'      => 'required|string|max:255',
                'order_date'       => 'required|date',
                'departure_date'  => 'required|date|after_or_equal:order_date',
                'departure_time'  => 'required',
                'seat_number'     => [
                        'required',
                        'string',
                        'max:5',
                        Rule::unique('tickets_models')->where(function ($query) use ($request) {
                            return $query->where('plate_number', $request->plate_number);
                    })
                ],
                'status'           => 'required|in:pending,confirmed,cancelled',
                'type_carrier'     => 'required|string|max:255',
                'plate_number'     => 'required|string',
                'price'            => 'required|numeric|min:0',
            ], [
                'id_driver.required'       => 'Silakan pilih supir.',
                'id_driver.exists'         => 'Supir yang dipilih tidak valid.',
                'id_driver.unique'         => 'Supir sedang aktif pilih supir lain',
                'passenger_name.required'  => 'Nama penumpang wajib diisi.',
                'passenger_name.string'    => 'Nama penumpang harus berupa teks.',
                'passenger_name.max'       => 'Nama penumpang maksimal 255 karakter.',

                'destination.required'     => 'Tujuan wajib diisi.',
                'destination.string'       => 'Tujuan harus berupa teks.',
                'destination.max'          => 'Tujuan maksimal 255 karakter.',

                'order_date.required'      => 'Tanggal pemesanan wajib diisi.',
                'order_date.date'          => 'Tanggal pemesanan tidak valid.',

                'departure_date.required'  => 'Tanggal keberangkatan wajib diisi.',
                'departure_date.date'      => 'Tanggal keberangkatan tidak valid.',
                'departure_date.after_or_equal' => 'Tanggal keberangkatan tidak boleh sebelum tanggal pemesanan.',

                'departure_time.required'  => 'Jam keberangkatan wajib diisi.',

                'seat_number.required'     => 'Nomor kursi wajib diisi.',
                'seat_number.string'       => 'Nomor kursi harus berupa teks.',
                'seat_number.max'          => 'Nomor kursi maksimal 5karakter.',
                'seat_number.unique'       => 'Nomor kursi ini sudah terpakai di mobil yang sama',

                'status.required'          => 'Status wajib diisi.',
                'status.in'                => 'Status hanya boleh Pending, Confirmed, atau Cancelled.',

                'type_carrier.required'    => 'Jenis mobil wajib diisi.',
                'type_carrier.string'      => 'Jenis mobil harus berupa teks.',
                'type_carrier.max'         => 'Jenis mobil maksimal 255 karakter.',

                'plate_number.required'    => 'Nomor plat wajib diisi.',
                'plate_number.string'      => 'Nomor plat harus berupa teks.',

                'price.required'           => 'Harga wajib diisi.',
                'price.numeric'            => 'Harga harus berupa angka.',
                'price.min'                => 'Harga tidak boleh kurang dari 0.'
            ]);

            $driver = DriversModel::findOrFail($request->id_driver);

            $ticket = new TicketsModel();
            $ticket->ticket_number = $ticket_number;
            $ticket->id_driver = $request->id_driver;
            $ticket->passenger_name = $request->passenger_name;
            $ticket->destination = $request->destination;
            $ticket->order_date = $request->order_date;
            $ticket->departure_date = $request->departure_date;
            $ticket->departure_time = $request->departure_time;
            $ticket->seat_number = $request->seat_number;
            $ticket->status = $request->status;
            $ticket->type_carrier = $request->type_carrier;
            $ticket->plate_number = $request->plate_number;
            $ticket->price = $request->price;
            $ticket->save();

            if(!$ticket->save()){
                return redirect()->route('tickets.index')->with('success', 'Tiket gagal ditambahkan: ');
            }

            return redirect()->route('tickets.index')->with('success', 'Tiket berhasil ditambahkan: ');
        } catch (Throwable $th) {
            $errorMessage = $th->getMessage();
            return redirect()->route('nama.rute.yang.dituju')->with('error', $errorMessage);
        }
        
    }

    public function edit($id)
    {
        $ticket = TicketsModel::findOrFail($id);
        $drivers = DriversModel::select('id', 'name_driver', 'vehicle_plate_number', 'vehicle_type')->get();
        return view('tickets.ticketEdit', compact('ticket', 'drivers'));
    }

    public function update(Request $request, $id)
    {
        $ticket = TicketsModel::findOrFail($id);
        $oldDriverId = $ticket->id_driver;

        $driverBusy = TicketsModel::where('id_driver', $request->id_driver)
            ->where('status', 'confirmed')
            ->where('id', '!=', $id)
            ->exists();

        if ($driverBusy && $request->status === 'confirmed') {
            return redirect()->back()
                ->withErrors(['id_driver' => 'Supir ini sedang memiliki tiket dengan status confirmed.'])
                ->withInput();
        }

        $request->validate([
            'id_driver'        => 'required|exists:drivers_models,id',
            'passenger_name'   => 'required|string|max:255',
            'destination'      => 'required|string|max:255',
            'order_date'       => 'required|date',
            'departure_date'  => 'required|date|after_or_equal:order_date',
            'departure_time'  => 'required',
            'seat_number' => [
                'required',
                'string',
                'max:5',
                Rule::unique('tickets_models')->where(function ($query) use ($request) {
                    return $query->where('plate_number', $request->plate_number);
                })->ignore($ticket->id)
            ],
            'status'           => 'required|in:pending,confirmed,cancelled,success',
            'type_carrier'     => 'required|string|max:255',
            'price'            => 'required|numeric|min:0',
        ], [
            'id_driver.required'       => 'Silakan pilih sopir.',
            'id_driver.exists'         => 'Sopir yang dipilih tidak valid.',

            'passenger_name.required'  => 'Nama penumpang wajib diisi.',
            'passenger_name.string'    => 'Nama penumpang harus berupa teks.',
            'passenger_name.max'       => 'Nama penumpang maksimal 255 karakter.',

            'destination.required'     => 'Tujuan wajib diisi.',
            'destination.string'       => 'Tujuan harus berupa teks.',
            'destination.max'          => 'Tujuan maksimal 255 karakter.',

            'order_date.required'      => 'Tanggal pemesanan wajib diisi.',
            'order_date.date'          => 'Tanggal pemesanan tidak valid.',

            'departure_date.required'  => 'Tanggal keberangkatan wajib diisi.',
            'departure_date.date'      => 'Tanggal keberangkatan tidak valid.',
            'departure_date.after_or_equal' => 'Tanggal keberangkatan tidak boleh sebelum tanggal pemesanan.',

            'departure_time.required'  => 'Jam keberangkatan wajib diisi.',

            'seat_number.required'     => 'Nomor kursi wajib diisi.',
            'seat_number.string'       => 'Nomor kursi harus berupa teks.',
            'seat_number.max'          => 'Nomor kursi maksimal 5karakter.',
            'seat_number.unique'       => 'Nomor kursi ini sudah terpakai di mobil yang sama',

            'status.required'          => 'Status wajib diisi.',
            'status.in'                => 'Status hanya boleh Pending, Confirmed, atau Cancelled.',

            'type_carrier.required'    => 'Jenis mobil wajib diisi.',
            'type_carrier.string'      => 'Jenis mobil harus berupa teks.',
            'type_carrier.max'         => 'Jenis mobil maksimal 255 karakter.',

            'plate_number.required'    => 'Nomor plat wajib diisi.',
            'plate_number.string'      => 'Nomor plat harus berupa teks.',

            'price.required'           => 'Harga wajib diisi.',
            'price.numeric'            => 'Harga harus berupa angka.',
            'price.min'                => 'Harga tidak boleh kurang dari 0.'
        ]);

        $driver = DriversModel::findOrFail($request->id_driver);

        $update = $ticket->update([
            'id_driver'       => $request->id_driver,
            'passenger_name'  => $request->passenger_name,
            'destination'     => $request->destination,
            'order_date'      => $request->order_date,
            'deparature_date' => $request->deparature_date,
            'deperature_time' => $request->deperature_time,
            'seat_number'     => $request->seat_number,
            'status'          => $request->status,
            'type_carrier'    => $driver->vehicle_type,
            'plate_number'    => $driver->vehicle_plate_number,
            'price'           => $request->price,
        ]);

        if(!$update)
        {
            return redirect()->route('tickets.edit')->with('error', 'Tiket gagal diperbarui.');
        }


        return redirect()->route('tickets.edit', ['id' => $id])->with('success', 'Tiket berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $ticket = TicketsModel::findOrFail($id);
        $driverId = $ticket->id_driver;

        $ticket->delete();

        DriversModel::where('id', $driverId)
        ->update(['status' => 'Tersedia']);

        if (!$ticket->delete()) {
            return redirect()->route()->with('error_deleted', 'Tiket tidak berhasil dihapus');
        }

        return redirect()->route('tickets.index')->with('success_deleted', 'Tiket berhasil dihapus');
    }
}


