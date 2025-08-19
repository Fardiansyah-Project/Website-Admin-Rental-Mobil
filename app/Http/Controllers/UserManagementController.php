<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class UserManagementController extends Controller
{

    public function index()
    {
        $users = User::where('id', '!=', auth()->id())->paginate(5);
        return view('user-manegement.userManagement', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $plainPassword = Str::random(8);
        
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'role'     => 'in:superadmin,admin,user',
        ],[
            'name.required' => 'Nama tidak boleh kosong.',
            'name.string' => 'Nama harus berupa huruf.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.role' => 'Email sudah terdaftar.',
            'role.in' => 'Poisi harus superadmin atau admin'
        ]);


        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($plainPassword),
            'plain_password' => $plainPassword,
            'role'     => $request->role ?? 'admin',
        ]);

        session()->flash('new_user_password', $plainPassword);

        return redirect()->route('users.index')->with('success', 'User berhasil ditambahkan');
    }

    public function edit(User $user)
    {
        // Cegah edit dirinya sendiri
        if ($user->id === auth()->id()) {
            abort(403, 'Tidak dapat mengedit diri sendiri pergi kehalaman ');
        }

        return view('user-manegement.userEdit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $plainPassword = Str::random(8);

        if ($user->id === auth()->id()) {
            abort(403, 'Pergi kehalaman edit profile untuk mengubah data sendiri');
        }
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'password' => 'nullable|min:6',
            'role'     => 'required|in:superadmin,admin',
        ],[
            'name.required' => 'Nama tidak boleh kosong.',
            'name.string' => 'Nama harus berupa huruf.',
            'name.max' => 'Nama tidak boleh lebih dari 255 karakter.',
            'email.required' => 'Email tidak boleh kosong.',
            'email.role' => 'Email sudah terdaftar.',
            'password.min' => 'Password minimal 6 karakter.',
            'role.required' => 'Posisi harus diisi.',
            'role.in' => 'Poisi harus superadmin atau admin'
        ]);

        $data = $request->only(['name', 'email', 'role']);
        if ($request->filled('password')) {
            $data['password'] = Hash::make($plainPassword);
        }

        $user->update($data);

        return redirect()->route('users.edit', $user->id)->with('success', 'User berhasil diupdate');
    }

    public function destroy(User $user)
    {
        if ($user->id === auth()->id()) {
            abort(403, 'Tidak dapat menghapus diri sendiri');
        }

        $user->delete();
        if (!$user) {
            return redirect()->route('users.index')->with('error_deleted', 'User gagal dihapus');
        }
        return redirect()->route('users.index')->with('success_deleted', 'User berhasil dihapus');
    }
}
