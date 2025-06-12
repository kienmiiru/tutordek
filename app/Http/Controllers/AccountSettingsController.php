<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\TutorProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class AccountSettingsController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $tutorProfile = null;
        
        if ($user->isTutor()) {
            $tutorProfile = $user->tutorProfile;
        }
        
        return view('account.settings', compact('user', 'tutorProfile'));
    }

    public function updateProfile(Request $request)
    {
        $user = auth()->user();
        
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'current_password' => ['exclude_without:new_password', 'required', 'current_password'],
            'new_password' => ['nullable', 'string', 'min:8', 'confirmed'],
        ], [
            'name.required' => 'Nama harus diisi',
            'name.string' => 'Nama harus berupa string',
            'name.max' => 'Nama maksimal 255 karakter',
            'email.required' => 'Email harus diisi',
            'email.email' => 'Email tidak valid',
            'email.max' => 'Email maksimal 255 karakter',
            'email.unique' => 'Email sudah terdaftar',
            'current_password.required' => 'Password saat ini harus diisi untuk mengubah password',
            'current_password.current_password' => 'Password saat ini tidak cocok',
            'new_password.string' => 'Password baru tidak valid',
            'new_password.min' => 'Password baru minimal 8 karakter',
            'new_password.confirmed' => 'Password baru dan konfirmasi password tidak cocok',
        ]);

        $user->name = $validated['name'];
        $user->email = $validated['email'];
        
        if (isset($validated['new_password'])) {
            $user->password = Hash::make($validated['new_password']);
        }
        
        $user->save();

        if ($user->isTutor()) {
            $validatedTutor = $request->validate([
                'bio' => ['nullable', 'string', 'max:1000'],
                'payment_method' => ['nullable', 'string', 'max:255'],
            ]);

            $tutorProfile = $user->tutorProfile ?? new TutorProfile(['user_id' => $user->id]);
            $tutorProfile->bio = $validatedTutor['bio'];
            $tutorProfile->payment_method = $validatedTutor['payment_method'];
            $tutorProfile->save();
        }

        return redirect()->route('account.settings')->with('success', 'Profil berhasil diubah');
    }
} 