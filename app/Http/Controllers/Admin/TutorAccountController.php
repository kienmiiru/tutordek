<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TutorAccountController extends Controller
{
    public function index()
    {
        $tutors = User::where('role', 'tutor')->get();
        return view('admin.tutor-accounts.index', compact('tutors'));
    }

    public function create(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8',
        ]);

        $tutor = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'role' => 'tutor',
        ]);

        return redirect()->route('admin.tutor-accounts.index')
            ->with('success', 'Tutor berhasil dibuat');
    }

    public function update(Request $request, User $tutor)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $tutor->name = $request->name;
        $tutor->save();

        return redirect()->route('admin.tutor-accounts.index')
            ->with('success', 'Nama tutor berhasil diupdate');
    }

    public function destroy(User $tutor)
    {
        $tutor->delete();

        return redirect()->route('admin.tutor-accounts.index')
            ->with('success', 'Tutor berhasil dihapus');
    }
}
