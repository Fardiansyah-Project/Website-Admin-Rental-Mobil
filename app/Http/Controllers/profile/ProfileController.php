<?php

namespace App\Http\Controllers\profile;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;




class ProfileController extends Controller
{
    public function edit($id)
    {
        $profile = User::findOrFail($id);

        return view('profile.profileEdit', compact('profile'));
    }

    public function update(Request $request, $id)
    {
        $profile = User::findOrFail($id);

        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $id,
        ],[
            'name.required' => 'Nama tidak boleh kosong.',
            'name.string' => 'Nama harus berupa huruf.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.unique' => 'Email sudah terdaftar.',
        ]);

        $profile->update([
            'name' => $request->name,
            'email' => $request->email
        ]);

        return redirect()->route('profile.edit', ['id' => $id])->with('success', 'User berhasil diupdate');
    }

    public function editPassword($id)
    {
        $profile = User::findOrFail($id);

        return view('profile.profileNewPassword', compact('profile'));
    }

    public function updatePassword(Request $request, $id)
    {
        $profile = User::findOrFail($id);

        $request->validate([
            'current_password' => 'required',
            'new_password' => ['required', 'string', Password::min(8)->numbers(), 'confirmed'],
        ], [
            'current_password.required' => 'Kata sandi saat ini tidak boleh kosong.',
            'new_password.required' => 'Kata sandi baru tidak boleh kosong.',
            'new_password.string' => 'Kata sandi baru harus berupa string.',
            'new_password.min' => 'Kata sandi baru harus minimal 8 karakter.',
            // 'new_password.mixedCase' => 'Kata sandi baru harus mengandung huruf besar dan kecil.',
            'new_password.numbers' => 'Kata sandi baru harus mengandung angka.',
            // 'new_password.symbols' => 'Kata sandi baru harus mengandung simbol.',
            'new_password.confirmed' => 'Konfirmasi kata sandi tidak cocok.',
        ]);

        if (!Hash::check($request->current_password, $profile->password)) {
            return redirect()->back()->withErrors(['current_password' => 'Kata sandi saat ini salah.']);
        }

        $profile->update([
            'password' => Hash::make($request->new_password),
        ]);

        session()->flash('new_user_password', $request->new_password);

        return redirect()->route('profile.edit', ['id' => $id])->with('success', 'Kata sandi berhasil diubah.');
    }
}
