@extends('layouts.app')

@section('title', 'Pengaturan Akun - TutorDek')

@section('sidebar')
    @if(auth()->user()->isTutor())
        @include('components.tutor-sidebar')
    @else
        @include('components.student-sidebar')
    @endif
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="max-w-2xl mx-auto">
        <div class="bg-white rounded-lg shadow-md p-6">
            <h4 class="text-xl font-semibold mb-6">Pengaturan Akun</h4>

            @if (session('success'))
                <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded mb-4" role="alert">
                    {{ session('success') }}
                </div>
            @endif

            <form method="POST" action="{{ route('account.settings.update') }}">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="name" class="block text-sm font-medium text-gray-700 mb-1">Nama</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('name') border-red-500 @enderror" 
                        id="name" name="name" value="{{ old('name', $user->name) }}" required>
                    @error('name')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                    <input type="email" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('email') border-red-500 @enderror" 
                        id="email" name="email" value="{{ old('email', $user->email) }}" required>
                    @error('email')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <hr class="my-6 border-gray-200">

                <h5 class="text-lg font-medium mb-4">Ubah Password</h5>
                <div class="mb-4">
                    <label for="current_password" class="block text-sm font-medium text-gray-700 mb-1">Password Saat Ini</label>
                    <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('current_password') border-red-500 @enderror" 
                        id="current_password" name="current_password">
                    @error('current_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="new_password" class="block text-sm font-medium text-gray-700 mb-1">Password Baru</label>
                    <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('new_password') border-red-500 @enderror" 
                        id="new_password" name="new_password">
                    @error('new_password')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-4">
                    <label for="new_password_confirmation" class="block text-sm font-medium text-gray-700 mb-1">Konfirmasi Password Baru</label>
                    <input type="password" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                        id="new_password_confirmation" name="new_password_confirmation">
                </div>

                @if($user->isTutor())
                    <hr class="my-6 border-gray-200">
                    <h5 class="text-lg font-medium mb-4">Profil Tutor</h5>
                    
                    <div class="mb-4">
                        <label for="bio" class="block text-sm font-medium text-gray-700 mb-1">Bio</label>
                        <textarea placeholder="Jelaskan tentang diri Anda, seperti pengalaman, pendidikan, minat, apalah, dll." class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('bio') border-red-500 @enderror" 
                            id="bio" name="bio" rows="4">{{ old('bio', $tutorProfile?->bio) }}</textarea>
                        @error('bio')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-1">Metode Pembayaran (digunakan oleh siswa untuk melakukan pembayaran)</label>
                        <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500 @error('payment_method') border-red-500 @enderror" 
                            id="payment_method" name="payment_method" 
                            value="{{ old('payment_method', $tutorProfile?->payment_method) }}"
                            placeholder="Masukkan metode pembayaran yang Anda gunakan, seperti rekening, e-wallet, dll.">
                        @error('payment_method')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                @endif

                <div class="mt-6">
                    <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                        Simpan Perubahan
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection 