@extends('layouts.app')

@section('title', 'Kelola Sesi - Admin')

@section('sidebar')
    @include('components.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Sesi</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Sesi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $sessions->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Verifikasi Pending</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $sessions->where('status', 'awaiting_verification')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Dikonfirmasi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $sessions->where('status', 'confirmed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-red-100 text-red-600">
                    <i class="fas fa-times text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Ditolak</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $sessions->where('status', 'rejected')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sessions Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Semua Sesi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Pembayaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status Sesi</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($sessions as $session)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $session->student->name }}</div>
                            <div class="text-sm text-gray-500">{{ $session->student->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $session->tutor->name }}</div>
                            <div class="text-sm text-gray-500">{{ $session->tutor->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $session->subject->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>{{ $session->start_at->format('M d, Y') }}</div>
                            <div class="text-gray-500">{{ $session->start_at->format('H:i') }} - {{ $session->end_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($session->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($session->payment)
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($session->payment->status === 'verified') bg-green-100 text-green-800
                                    @elseif($session->payment->status === 'pending') bg-yellow-100 text-yellow-800
                                    @else bg-red-100 text-red-800
                                    @endif">
                                    {{ ucfirst($session->payment->status) }}
                                </span>
                            @else
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                    Tidak ada pembayaran
                                </span>
                            @endif
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($session->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($session->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                @elseif($session->status === 'awaiting_verification') bg-blue-100 text-blue-800
                                @elseif($session->status === 'completed') bg-purple-100 text-purple-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            @if($session->payment && $session->payment->payment_proof_path)
                                <a href="{{ asset('storage/' . $session->payment->payment_proof_path) }}" 
                                   target="_blank" 
                                   class="text-blue-600 hover:text-blue-900 mr-2">
                                    <i class="fas fa-eye"></i> Lihat Bukti Pembayaran
                                </a>
                            @endif
                            @if($session->payment && $session->payment->status === 'pending' && $session->status === 'awaiting_verification')
                                <form action="{{ route('admin.sessions.update-payment-status', $session) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="verified">
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2" 
                                            onclick="return confirm('Verifikasi pembayaran ini?')">
                                        <i class="fas fa-check"></i> Verifikasi
                                    </button>
                                </form>
                                <form action="{{ route('admin.sessions.update-payment-status', $session) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="text-red-600 hover:text-red-900" 
                                            onclick="return confirm('Tolak pembayaran ini?')">
                                        <i class="fas fa-times"></i> Tolak
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada sesi yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 