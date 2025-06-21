@extends('layouts.app')

@section('title', 'Dashboard Tutor - TutorDek')

@section('sidebar')
    @include('components.tutor-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Dashboard Tutor</h1>
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
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Sesi Selesai</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $completedSessions }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Menunggu Pembayaran</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $pendingSessions }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-money-bill text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pendapatan</p>
                    <p class="text-2xl font-semibold text-gray-900">Rp {{ number_format($totalEarnings, 0, ',', '.') }}</p>
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
                <a href="{{ route('tutor.availabilities.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-clock text-blue-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Kelola Ketersediaan</p>
                        <p class="text-sm text-gray-500">Atur jadwal dan mata pelajaran</p>
                    </div>
                </a>

                <a href="{{ route('tutor.sessions.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-calendar-check text-green-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Lihat Sesi</p>
                        <p class="text-sm text-gray-500">Kelola sesi mengajar</p>
                    </div>
                </a>

                <a href="{{ route('tutor.learning-history.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-history text-orange-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Riwayat Pembelajaran</p>
                        <p class="text-sm text-gray-500">Lihat sesi yang telah selesai</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Upcoming Sessions -->
    @if($upcomingSessions->count() > 0)
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Sesi Mendatang</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal & Waktu</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach($upcomingSessions as $session)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $session->student->name }}</div>
                            <div class="text-sm text-gray-500">{{ $session->student->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $session->subject->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            <div>{{ $session->start_at->format('d M Y') }}</div>
                            <div class="text-gray-500">{{ $session->start_at->format('H:i') }} - {{ $session->end_at->format('H:i') }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($session->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                Dikonfirmasi
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <a href="{{ route('tutor.sessions.show', $session) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-eye"></i> Lihat
                            </a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    @endif

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
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($recentSessions as $session)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $session->student->name }}</div>
                            <div class="text-sm text-gray-500">{{ $session->student->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $session->subject->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $session->start_at->format('d M Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($session->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($session->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($session->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                @elseif($session->status === 'completed') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                @if($session->status === 'confirmed') Dikonfirmasi
                                @elseif($session->status === 'pending_payment') Menunggu Pembayaran
                                @elseif($session->status === 'completed') Selesai
                                @elseif($session->status === 'rejected') Ditolak
                                @else {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                                @endif
                            </span>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Belum ada sesi mengajar.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

    <!-- Popular Subjects -->
    @if($popularSubjects->count() > 0)
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Mata Pelajaran Populer</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                @foreach($popularSubjects as $subjectData)
                <div class="flex items-center p-4 border border-gray-200 rounded-lg">
                    <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                        <i class="fas fa-book text-lg"></i>
                    </div>
                    <div class="ml-4">
                        <p class="font-medium text-gray-900">{{ $subjectData['subject']->name }}</p>
                        <p class="text-sm text-gray-500">{{ $subjectData['count'] }} slot tersedia</p>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </div>
    @endif
</div>
@endsection
