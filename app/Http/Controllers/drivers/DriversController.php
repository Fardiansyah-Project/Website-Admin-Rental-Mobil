<?php

namespace App\Http\Controllers\drivers;

use App\Http\Controllers\Controller;
use App\Models\DriversModel;
use Illuminate\Http\Request;

class DriversController extends Controller
{
    public function index()
    {
        $data = DriversModel::paginate(5);
        return view('pages.driver', compact('data'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name_driver' => 'required|string',
            'email' => 'required|email|unique:drivers_models,email',
            'phone_number' => 'required|unique:drivers_models,phone_number|numeric|digits_between:12,14',
            'address' => 'required|string',
            'vehicle_type' => 'required|string',
            'vehicle_plate_number' => 'required|string|unique:drivers_models,vehicle_plate_number',
            'license_number' => 'required|numeric|unique:drivers_models,license_number',
            'status' => 'nullable|in:Aktif,Tidak sedang berkendara'
        ], [
            'name_driver.required' => 'Nama driver wajib diisi.',
            'name_driver.string' => 'Nama driver harus berupa teks.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.unique' => 'Nomor telepon sudah terdaftar.',
            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
            'phone_number.digits_between' => 'Nomor telepon harus terdiri dari 12 sampai 14 digit.',
            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'vehicle_type.required' => 'Tipe kendaraan wajib diisi.',
            'vehicle_type.string' => 'Tipe kendaraan harus berupa teks.',
            'vehicle_plate_number.required' => 'Nomor plat kendaraan wajib diisi.',
            'vehicle_plate_number.string' => 'Nomor plat kendaraan harus berupa teks.',
            'vehicle_plate_number.unique' => 'Nomor plat sudah terdaftar',
            'license_number.required' => 'Nomor SIM wajib diisi.',
            'license_number.numeric' => 'Nomor SIM harus berupa angka.',
            'license_number.unique' => 'Nomor SIM sudah terdaftar.',
            'status.in' => 'Status harus "Aktif" atau "Tidak sedang berkendara".'
        ]);

        $data = new DriversModel();
        $data->name_driver = trim($request->name_driver);
        $data->email = strtolower(trim($request->email));
        $data->phone_number = trim($request->phone_number);
        $data->address = trim($request->address);
        $data->vehicle_type = trim($request->vehicle_type);
        $data->vehicle_plate_number = strtoupper(trim($request->vehicle_plate_number));
        $data->license_number = trim($request->license_number);
        $data->status = trim($request->status ?? 'Tidak sedang berkendara');

        $data->save();
        if(!$data->save()){
            return redirect()->back()->with('error', 'Gagal menyimpan data driver.');
        }

        return redirect()->route('drivers.index')->with('success', 'Driver berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $data = DriversModel::find($id);
        return view('pages.driverEdit', compact('data'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name_driver' => 'required|string',
            'email' => 'required|email|unique:drivers_models,email,' . $id,
            'phone_number' => 'required|numeric|digits_between:12,14|unique:drivers_models,phone_number,' . $id,
            'address' => 'required|string',
            'vehicle_type' => 'required|string',
            'vehicle_plate_number' => 'required|string|unique:drivers_models,vehicle_plate_number,' . $id,
            'license_number' => 'required|numeric|unique:drivers_models,license_number,' . $id,
            'status' => 'string'
        ], [
            'name_driver.required' => 'Nama driver wajib diisi.',
            'name_driver.string' => 'Nama driver harus berupa teks.',
            'email.required' => 'Email wajib diisi.',
            'email.email' => 'Format email tidak valid.',
            'email.unique' => 'Email sudah terdaftar.',
            'phone_number.required' => 'Nomor telepon wajib diisi.',
            'phone_number.unique' => 'Nomor telepon sudah terdaftar.',
            'phone_number.numeric' => 'Nomor telepon harus berupa angka.',
            'phone_number.digits_between' => 'Nomor telepon harus terdiri dari 12 sampai 14 digit.',
            'address.required' => 'Alamat wajib diisi.',
            'address.string' => 'Alamat harus berupa teks.',
            'vehicle_type.required' => 'Tipe kendaraan wajib diisi.',
            'vehicle_type.string' => 'Tipe kendaraan harus berupa teks.',
            'vehicle_plate_number.unique' => 'Nomor plat kendaraan sudah terdaftar.',
            'vehicle_plate_number.string' => 'Nomor plat kendaraan harus berupa teks.',
            'license_number.required' => 'Nomor SIM wajib diisi.',
            'license_number.numeric' => 'Nomor SIM harus berupa angka.',
            'license_number.unique' => 'Nomor SIM sudah terdaftar.',
        ]);

        $data = DriversModel::findOrFail($id);

        if(!$data){
            return redirect()->back()->with('error', 'Gagal mengubah data driver.');
        }

        $data->update($request->all());

        return redirect()->route('drivers.edit', ['id' => $id])->with('success', 'Driver berhasil diubah');
    }


    public function delete($id)
    {
        $data = DriversModel::find($id);
        if(!$data){
            return redirect()->back()->with('error_deleted', 'Gagal menghapus data driver.');
        }
        $data->delete();

        return redirect()->route('drivers.index')->with('success_deleted', 'Driver berhasil dihapus');
    }
}
