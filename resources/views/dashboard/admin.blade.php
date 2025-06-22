@extends('layouts.app')

@section('title', 'Admin Dashboard - TutorDek')

@section('sidebar')
    @include('components.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <div class="text-sm text-gray-500">
            Selamat datang kembali, {{ auth()->user()->name }}
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Sesi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalSessions }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Tutor</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalTutors }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pembayaran Pending</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalPendingPayments }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Mata Pelajaran</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $totalSubjects }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Aksi Cepat</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.sessions.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-calendar-check text-blue-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Kelola Sesi</p>
                        <p class="text-sm text-gray-500">Lihat dan kelola sesi pembelajaran</p>
                    </div>
                </a>

                <a href="{{ route('admin.tutor-accounts.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-user-plus text-green-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Kelola Tutor</p>
                        <p class="text-sm text-gray-500">Tambah, edit, atau hapus akun tutor</p>
                    </div>
                </a>

                <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-credit-card text-purple-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Pengaturan Pembayaran</p>
                        <p class="text-sm text-gray-500">Konfigurasi metode pembayaran</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Sessions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Sesi Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(\App\Models\TeachingSession::with(['student', 'tutor', 'subject'])->latest()->take(5)->get() as $session)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $session->student->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $session->tutor->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $session->subject->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $session->start_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($session->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($session->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                @elseif($session->status === 'completed') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 