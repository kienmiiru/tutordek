@extends('layouts.app')

@section('title', 'Pilih Tanggal Sesi - TutorDek')

@section('sidebar')
    <x-student-sidebar />
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-semibold mb-6">Pilih Tanggal Sesi</h2>

                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="flex items-center mb-4">
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
                </div>

                <form action="{{ route('student.tutor-catalog.store-booking', $availability) }}" method="POST">
                    @csrf
                    <div class="mb-6">
                        <label for="date" class="block text-sm font-medium text-gray-700 mb-2">Pilih Tanggal</label>
                        <select name="date" id="date" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Pilih Tanggal</option>
                            @foreach($availableDates as $date)
                                <option value="{{ $date }}">{{ \Carbon\Carbon::parse($date)->format('d F Y') }}</option>
                            @endforeach
                        </select>
                        @error('date')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('student.tutor-catalog.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Kembali ke Katalog
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Ajukan Sesi
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 