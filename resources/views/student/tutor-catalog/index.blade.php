@extends('layouts.app')

@section('title', 'Katalog Pengajar - TutorDek')

@section('sidebar')
    <x-student-sidebar />
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <h2 class="text-2xl font-semibold mb-6">Katalog Pengajar</h2>
        @if (session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                <span class="block sm:inline">{{ session('success') }}</span>
            </div>
        @endif
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                @forelse($availabilities as $availability)
                    <div class="bg-white border rounded-lg shadow-sm p-6">
                        <div class="flex items-center mb-4">
                            <div class="flex-shrink-0">
                                <img class="h-12 w-12 rounded-full" src="{{ $availability->tutor->profile_photo_url }}" alt="{{ $availability->tutor->name }}">
                            </div>
                            <div class="ml-4">
                                <h3 class="text-lg font-medium text-gray-900">{{ $availability->tutor->name }}</h3>
                                <p class="text-sm text-gray-500">{{ $availability->subject->name }}</p>
                            </div>
                        </div>

                        <div class="space-y-2">
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                </svg>
                                {{ $availability->day_of_week }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                {{ $availability->start_time->format('H:i') }} - {{ $availability->end_time->format('H:i') }}
                            </div>
                            <div class="flex items-center text-sm text-gray-600">
                                <svg class="h-5 w-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                                </svg>
                                Rp {{ number_format($availability->price, 0, ',', '.') }} per sesi
                            </div>
                        </div>

                        <div class="mt-6">
                            <a href="{{ route('student.tutor-catalog.booking', $availability) }}" 
                               class="w-full inline-flex justify-center items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Pilih Jadwal
                            </a>
                        </div>
                    </div>
                @empty
                    <div class="col-span-full text-center py-12">
                        <p class="text-gray-500">Belum ada jadwal pengajar yang tersedia.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection 