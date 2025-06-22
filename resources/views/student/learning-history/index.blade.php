@extends('layouts.app')

@section('title', 'Riwayat Pembelajaran - TutorDek')

@section('sidebar')
    <x-student-sidebar />
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <h1 class="text-3xl font-bold text-gray-900 mb-2">Riwayat Pembelajaran</h1>
        <p class="text-gray-600">Lihat semua sesi pembelajaran yang telah selesai</p>
    </div>

    @if($sessions->count() > 0)
        <div class="bg-white rounded-lg shadow overflow-hidden">
            <div class="overflow-x-auto">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tanggal & Waktu
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Tutor
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Mata Pelajaran
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Status
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Harga
                            </th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">
                                Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @foreach($sessions as $session)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm font-medium text-gray-900">
                                    {{ $session->start_at->format('d M Y') }}
                                </div>
                                <div class="text-sm text-gray-500">
                                    {{ $session->start_at->format('H:i') }} - {{ $session->end_at ? $session->end_at->format('H:i') : 'TBD' }}
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="flex items-center">
                                    <div class="ml-4">
                                        <div class="text-sm font-medium text-gray-900">
                                            {{ $session->tutor->name }}
                                        </div>
                                        <div class="text-sm text-gray-500">
                                            {{ $session->tutor->email }}
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <div class="text-sm text-gray-900">{{ $session->subject->name }}</div>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                @if($session->status === 'completed')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                        Selesai
                                    </span>
                                @elseif($session->status === 'rejected')
                                    <span class="inline-flex px-2 py-1 text-xs font-semibold rounded-full bg-red-100 text-red-800">
                                        Ditolak
                                    </span>
                                @endif
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                                Rp {{ number_format($session->price, 0, ',', '.') }}
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                <a href="{{ route('student.learning-history.show', $session) }}" 
                                   class="text-blue-600 hover:text-blue-900">
                                    Lihat Detail
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            
            <div class="bg-white px-4 py-3 border-t border-gray-200 sm:px-6">
                {{ $sessions->links() }}
            </div>
        </div>
    @else
        <div class="text-center py-12">
            <div class="mx-auto h-12 w-12 text-gray-400">
                <svg class="h-12 w-12" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
            </div>
            <h3 class="mt-2 text-sm font-medium text-gray-900">Belum ada riwayat pembelajaran</h3>
            <p class="mt-1 text-sm text-gray-500">Sesi pembelajaran yang telah selesai akan muncul di sini.</p>
            <div class="mt-6">
                <a href="{{ route('student.tutor-catalog.index') }}" 
                   class="inline-flex items-center px-4 py-2 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-blue-600 hover:bg-blue-700">
                    Cari Tutor
                </a>
            </div>
        </div>
    @endif
</div>
@endsection 