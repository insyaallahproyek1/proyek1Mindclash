<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AdminUserController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->get();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'class' => 'nullable|string|max:50',
        ]);

        $validated['password'] = Hash::make($validated['password']);
        User::create($validated);
        
        return redirect('/users')->with('success', 'Pengguna berhasil ditambahkan');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $id,
            'password' => 'nullable|min:6|confirmed',
            'role' => 'required|in:admin,user',
            'class' => 'nullable|string|max:50',
        ]);

        if ($validated['password']) {
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']);
        }

        $user->update($validated);
        return redirect('/users')->with('success', 'Pengguna berhasil diperbarui');
    }

    public function destroy($id)
    {
        // Cegah menghapus user yang sedang login
        if ($id === auth()->id()) {
            return redirect('/users')->with('error', 'Tidak dapat menghapus akun yang sedang aktif');
        }

        $user = User::findOrFail($id);
        $user->delete();
        return redirect('/users')->with('success', 'Pengguna berhasil dihapus');
    }
}
