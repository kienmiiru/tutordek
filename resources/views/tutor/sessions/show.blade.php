@extends('layouts.app')

@section('title', 'Detail Sesi Les - TutorDek')

@section('sidebar')
    <x-tutor-sidebar />
@endsection

@section('content')
<div class="container mx-auto px-4 py-8">
    <div class="mb-6">
        <a href="{{ route('tutor.sessions.index') }}" class="text-indigo-600 hover:text-indigo-900">
            &larr; Kembali ke Daftar Sesi
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('success') }}</span>
        </div>
    @endif

    @if(session('error'))
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4" role="alert">
            <span class="block sm:inline">{{ session('error') }}</span>
        </div>
    @endif

    <div class="bg-white shadow-md rounded-lg overflow-hidden">
        <div class="p-6">
            <h1 class="text-2xl font-bold text-gray-800 mb-6">Detail Sesi Les</h1>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Sesi</h2>
                    <dl class="space-y-4">
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Siswa</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $session->student->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Mata Pelajaran</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $session->subject->name }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Jadwal</dt>
                            <dd class="mt-1 text-sm text-gray-900">{{ $session->start_at->format('d M Y H:i') }}</dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Status</dt>
                            <dd class="mt-1">
                                <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                    @if($session->status === 'confirmed') bg-green-100 text-green-800
                                    @elseif($session->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                    @elseif($session->status === 'awaiting_verification') bg-blue-100 text-blue-800
                                    @else bg-gray-100 text-gray-800
                                    @endif">
                                    {{ str_replace('_', ' ', ucfirst($session->status)) }}
                                </span>
                            </dd>
                        </div>
                        <div>
                            <dt class="text-sm font-medium text-gray-500">Bahan Ajar</dt>
                            <dd class="mt-1">
                                @if($session->material)
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-green-100 text-green-800">
                                        Tersedia
                                    </span>
                                @else
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-gray-100 text-gray-800">
                                        Belum diupload
                                    </span>
                                @endif
                            </dd>
                        </div>
                    </dl>
                </div>

                <div>
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Informasi Pembayaran</h2>
                    @if($session->payment)
                        <dl class="space-y-4">
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Status Pembayaran</dt>
                                <dd class="mt-1">
                                    <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                        @if($session->payment->status === 'verified') bg-green-100 text-green-800
                                        @elseif($session->payment->status === 'pending') bg-yellow-100 text-yellow-800
                                        @else bg-red-100 text-red-800
                                        @endif">
                                        {{ ucfirst($session->payment->status) }}
                                    </span>
                                </dd>
                            </div>
                            <div>
                                <dt class="text-sm font-medium text-gray-500">Jumlah</dt>
                                <dd class="mt-1 text-sm text-gray-900">Rp {{ number_format($session->price, 0, ',', '.') }}</dd>
                            </div>
                            @if($session->payment->payment_proof_path)
                                <div>
                                    <dt class="text-sm font-medium text-gray-500">Bukti Pembayaran</dt>
                                    <dd class="mt-1">
                                        <a href="{{ Storage::url($session->payment->payment_proof_path) }}" 
                                           target="_blank"
                                           class="text-indigo-600 hover:text-indigo-900">
                                            Lihat Bukti Pembayaran
                                        </a>
                                    </dd>
                                </div>
                            @endif
                        </dl>
                    @else
                        <p class="text-gray-500">Belum ada pembayaran</p>
                    @endif
                </div>
            </div>

            @if($session->status === 'confirmed')
                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Link Meeting</h2>
                    @if($session->meeting_link)
                        <div class="flex items-center space-x-4">
                            <a href="{{ $session->meeting_link }}" target="_blank" 
                               class="text-indigo-600 hover:text-indigo-900">
                                {{ $session->meeting_link }}
                            </a>
                            <button onclick="showMeetingLinkForm()" 
                                    class="text-sm text-gray-600 hover:text-gray-900">
                                Ubah
                            </button>
                        </div>
                    @else
                        <button onclick="showMeetingLinkForm()"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Tambah Link Meeting
                        </button>
                    @endif
                </div>

                <div class="mt-8">
                    <h2 class="text-lg font-semibold text-gray-700 mb-4">Bahan Ajar</h2>
                    @if($session->material)
                        <div class="flex items-center space-x-4">
                            <a href="{{ Storage::url($session->material) }}" target="_blank" 
                               class="text-indigo-600 hover:text-indigo-900">
                                Lihat Bahan Ajar
                            </a>
                            <button onclick="showMaterialForm()" 
                                    class="text-sm text-gray-600 hover:text-gray-900">
                                Ubah
                            </button>
                            <form action="{{ route('tutor.sessions.delete-material', $session) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('Apakah Anda yakin ingin menghapus bahan ajar ini?')"
                                        class="text-sm text-red-600 hover:text-red-900">
                                    Hapus
                                </button>
                            </form>
                        </div>
                    @else
                        <button onclick="showMaterialForm()"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700">
                            Upload Bahan Ajar
                        </button>
                    @endif
                </div>

                <div class="mt-8">
                    <form action="{{ route('tutor.sessions.update-session-status', $session) }}" method="POST">
                        @csrf
                        @method('PUT')
                        <button type="submit" name="status" value="completed"
                                class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md text-white bg-green-600 hover:bg-green-700">
                            Tandai Sesi Selesai
                        </button>
                    </form>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Modal for Meeting Link -->
<div id="meetingLinkModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('tutor.sessions.update-meeting-link', $session) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{ $session->meeting_link ? 'Ubah Link Meeting' : 'Tambah Link Meeting' }}
                            </h3>
                            <div class="mt-4">
                                <label for="meeting_link" class="block text-sm font-medium text-gray-700">Link Meeting</label>
                                <input type="url" name="meeting_link" id="meeting_link" 
                                       value="{{ $session->meeting_link }}"
                                       class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm"
                                       required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Simpan
                    </button>
                    <button type="button" onclick="hideMeetingLinkForm()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal for Material Upload -->
<div id="materialModal" class="fixed z-10 inset-0 overflow-y-auto hidden" aria-labelledby="modal-title" role="dialog" aria-modal="true">
    <div class="flex items-end justify-center min-h-screen pt-4 px-4 pb-20 text-center sm:block sm:p-0">
        <div class="inline-block align-bottom bg-white rounded-lg text-left overflow-hidden shadow-xl transform transition-all sm:my-8 sm:align-middle sm:max-w-lg sm:w-full">
            <form action="{{ route('tutor.sessions.update-material', $session) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="bg-white px-4 pt-5 pb-4 sm:p-6 sm:pb-4">
                    <div class="sm:flex sm:items-start">
                        <div class="mt-3 text-center sm:mt-0 sm:ml-4 sm:text-left w-full">
                            <h3 class="text-lg leading-6 font-medium text-gray-900" id="modal-title">
                                {{ $session->material ? 'Ubah Bahan Ajar' : 'Upload Bahan Ajar' }}
                            </h3>
                            <div class="mt-4">
                                <label for="material" class="block text-sm font-medium text-gray-700">File Bahan Ajar</label>
                                <input type="file" name="material" id="material" 
                                       class="mt-1 block w-full text-sm text-gray-500
                                              file:mr-4 file:py-2 file:px-4
                                              file:rounded-md file:border-0
                                              file:text-sm file:font-semibold
                                              file:bg-indigo-50 file:text-indigo-700
                                              hover:file:bg-indigo-100"
                                       required>
                                <p class="mt-1 text-sm text-gray-500">
                                    Format yang didukung: PDF, DOC, DOCX, PPT, PPTX. Maksimal ukuran file: 2MB
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-gray-50 px-4 py-3 sm:px-6 sm:flex sm:flex-row-reverse">
                    <button type="submit"
                            class="w-full inline-flex justify-center rounded-md border border-transparent shadow-sm px-4 py-2 bg-indigo-600 text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:ml-3 sm:w-auto sm:text-sm">
                        Upload
                    </button>
                    <button type="button" onclick="hideMaterialForm()"
                            class="mt-3 w-full inline-flex justify-center rounded-md border border-gray-300 shadow-sm px-4 py-2 bg-white text-base font-medium text-gray-700 hover:bg-gray-50 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500 sm:mt-0 sm:ml-3 sm:w-auto sm:text-sm">
                        Batal
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function showMeetingLinkForm() {
    document.getElementById('meetingLinkModal').classList.remove('hidden');
}

function hideMeetingLinkForm() {
    document.getElementById('meetingLinkModal').classList.add('hidden');
}

function showMaterialForm() {
    document.getElementById('materialModal').classList.remove('hidden');
}

function hideMaterialForm() {
    document.getElementById('materialModal').classList.add('hidden');
}
</script>
@endsection 