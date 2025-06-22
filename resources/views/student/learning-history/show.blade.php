@extends('layouts.app')

@section('title', 'Detail Riwayat Pembelajaran - TutorDek')

@section('sidebar')
    <x-student-sidebar />
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <div class="flex items-center justify-between">
            <div>
                <h1 class="text-3xl font-bold text-gray-900 mb-2">Detail Sesi Pembelajaran</h1>
                <p class="text-gray-600">Informasi lengkap sesi pembelajaran yang telah selesai</p>
            </div>
            <a href="{{ route('student.learning-history.index') }}" 
               class="inline-flex items-center px-4 py-2 border border-gray-300 shadow-sm text-sm font-medium rounded-md text-gray-700 bg-white hover:bg-gray-50">
                <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Kembali
            </a>
        </div>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Content -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Sesi</h2>
                </div>
                <div class="p-6">
                    <dl class="grid grid-cols-1 gap-x-4 gap-y-6 sm:grid-cols-2">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Tanggal</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $session->start_at->format('d M Y') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Waktu</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                {{ $session->start_at->format('H:i') }} - {{ $session->end_at ? $session->end_at->format('H:i') : 'TBD' }}
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Mata Pelajaran</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $session->subject->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                @if($session->status === 'completed')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @elseif($session->status === 'rejected')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Harga</dt>
                            <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($session->price, 0, ',', '.') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Durasi</dt>
                            <dd class="mt-1 text-sm text-gray-900">
                                @if($session->end_at)
                                    {{ $session->start_at->diffInMinutes($session->end_at) }} menit
                                @else
                                    TBD
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>
            </div>

            <!-- Meeting Link Section -->
            @if($session->meeting_link)
            <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Link Meeting</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 mb-2">Link meeting yang digunakan untuk sesi ini:</p>
                            <a href="{{ $session->meeting_link }}" 
                               target="_blank"
                               class="text-blue-600 hover:text-blue-800 break-all">
                                {{ $session->meeting_link }}
                            </a>
                        </div>
                        <a href="{{ $session->meeting_link }}" 
                           target="_blank"
                           class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                            </svg>
                            Buka Meeting
                        </a>
                    </div>
                </div>
            </div>
            @endif

            <!-- Learning Material Section -->
            @if($session->material)
            <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Bahan Ajar</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center justify-between">
                        <div class="flex-1">
                            <p class="text-sm text-gray-600 mb-2">File bahan ajar yang digunakan dalam sesi ini:</p>
                            <div class="flex items-center">
                                <svg class="h-8 w-8 text-gray-400 mr-3" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                                </svg>
                                <span class="text-sm font-medium text-gray-900">
                                    {{ basename($session->material) }}
                                </span>
                            </div>
                        </div>
                        <a href="{{ route('student.learning-history.download-material', $session) }}" 
                           class="ml-4 inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            <svg class="mr-2 h-4 w-4" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Download
                        </a>
                    </div>
                </div>
            </div>
            @endif
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1">
            <!-- Tutor Information -->
            <div class="bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Tutor</h2>
                </div>
                <div class="p-6">
                    <div class="flex items-center">
                        <div class="ml-4">
                            <h3 class="text-lg font-medium text-gray-900">{{ $session->tutor->name }}</h3>
                            <p class="text-sm text-gray-500">{{ $session->tutor->email }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Payment Information -->
            @if($session->payment)
            <div class="mt-6 bg-white rounded-lg shadow overflow-hidden">
                <div class="px-6 py-4 border-b border-gray-200">
                    <h2 class="text-xl font-semibold text-gray-900">Informasi Pembayaran</h2>
                </div>
                <div class="p-6">
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status Pembayaran</dt>
                            <dd class="mt-1">
                                @if($session->payment->status === 'verified')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Terverifikasi
                                    </span>
                                @elseif($session->payment->status === 'rejected')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @else
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                        Menunggu Verifikasi
                                    </span>
                                @endif
                            </dd>
                        </div>
                        @if($session->payment->verified_at)
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Diverifikasi Pada</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $session->payment->verified_at->format('d M Y H:i') }}</dd>
                        </div>
                        @endif
                    </dl>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection 