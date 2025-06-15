@extends('layouts.app')

@section('title', 'Kelola Jadwal Ketersediaan - TutorDek')

@section('sidebar')
    <x-tutor-sidebar />
@endsection

@section('content')
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    @if (session('success'))
                        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
                            <span class="block sm:inline">{{ session('success') }}</span>
                        </div>
                    @endif

                    <!-- Form Tambah Jadwal -->
                    <form action="{{ route('tutor.availabilities.store') }}" method="POST" class="mb-8">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
                            <div>
                                <label for="subject_id" class="block text-sm font-medium text-gray-700">Mata Pelajaran</label>
                                <select name="subject_id" id="subject_id" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Pilih Mata Pelajaran</option>
                                    @foreach($subjects as $subject)
                                        <option value="{{ $subject->id }}">{{ $subject->name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="day_of_week" class="block text-sm font-medium text-gray-700">Hari</label>
                                <select name="day_of_week" id="day_of_week" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                                    <option value="">Pilih Hari</option>
                                    @foreach(App\Models\Availability::DAYS_OF_WEEK as $day)
                                        <option value="{{ $day }}">{{ $day }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div>
                                <label for="start_time" class="block text-sm font-medium text-gray-700">Waktu Mulai</label>
                                <input type="time" name="start_time" id="start_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="end_time" class="block text-sm font-medium text-gray-700">Waktu Selesai</label>
                                <input type="time" name="end_time" id="end_time" required class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>

                            <div>
                                <label for="price" class="block text-sm font-medium text-gray-700">Harga per Sesi (Rp)</label>
                                <input type="number" name="price" id="price" required min="0" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            </div>
                        </div>

                        <div class="mt-4">
                            <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                Tambah Jadwal
                            </button>
                        </div>
                    </form>

                    <!-- Tabel Jadwal -->
                    <div class="mt-8">
                        <h3 class="text-lg font-medium text-gray-900 mb-4">Jadwal Ketersediaan</h3>
                        <div class="overflow-x-auto">
                            <table class="min-w-full divide-y divide-gray-200">
                                <thead class="bg-gray-50">
                                    <tr>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Mata Pelajaran</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Hari</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Waktu</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Harga per Sesi</th>
                                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                                    </tr>
                                </thead>
                                <tbody class="bg-white divide-y divide-gray-200">
                                    @forelse($availabilities as $availability)
                                        <tr>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $availability->subject->name }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $availability->day_of_week }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">{{ $availability->start_time->format('H:i') }} - {{ $availability->end_time->format('H:i') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap">Rp {{ number_format($availability->price, 0, ',', '.') }}</td>
                                            <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                                                <form action="{{ route('tutor.availabilities.destroy', $availability) }}" method="POST" class="inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="text-red-600 hover:text-red-900" onclick="return confirm('Apakah Anda yakin ingin menghapus jadwal ini?')">
                                                        Hapus
                                                    </button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                                                Belum ada jadwal ketersediaan
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection 