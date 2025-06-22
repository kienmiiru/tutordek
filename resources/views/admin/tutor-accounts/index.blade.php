@extends('layouts.app')

@section('title', 'Kelola Akun Tutor - Admin')

@section('sidebar')
    @include('components.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Kelola Akun Tutor</h1>
        <div class="flex space-x-3">
            <button onclick="openCreateModal()" class="bg-blue-600 hover:bg-blue-700 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-plus mr-2"></i>Tambah Tutor Baru
            </button>
            <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
                <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
            </a>
        </div>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Statistics Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Tutor</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $tutors->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-calendar-check text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Sesi Aktif</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\TeachingSession::whereIn('tutor_id', $tutors->pluck('id'))->where('status', 'confirmed')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Ketersediaan</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Availability::whereIn('tutor_id', $tutors->pluck('id'))->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Tutors Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Semua Akun Tutor</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nama</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal Bergabung</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($tutors as $tutor)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $tutor->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $tutor->email }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $tutor->created_at->format('M d, Y') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openEditModal({{ $tutor->id }}, '{{ $tutor->name }}')" 
                                    class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i> Edit Tutor
                            </button>
                            <form action="{{ route('admin.tutor-accounts.destroy', $tutor) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-900" 
                                        onclick="return confirm('Apakah Anda yakin ingin menghapus tutor ini? Aksi ini tidak dapat dibatalkan.')">
                                    <i class="fas fa-trash"></i> Hapus
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Tidak ada akun tutor yang ditemukan.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Create Tutor Modal -->
<div id="createModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Tambah Tutor Baru</h3>
            <form action="{{ route('admin.tutor-accounts.create') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="create_name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" id="create_name" name="name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="create_email" class="block text-sm font-medium text-gray-700 mb-2">Email</label>
                    <input type="email" id="create_email" name="email" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="mb-4">
                    <label for="create_password" class="block text-sm font-medium text-gray-700 mb-2">Password</label>
                    <input type="password" id="create_password" name="password" required minlength="8"
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeCreateModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Tambah Tutor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Tutor Modal -->
<div id="editModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Edit Tutor</h3>
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="edit_name" class="block text-sm font-medium text-gray-700 mb-2">Nama</label>
                    <input type="text" id="edit_name" name="name" required
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closeEditModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Batal
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update Tutor
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openCreateModal() {
    document.getElementById('createModal').classList.remove('hidden');
}

function closeCreateModal() {
    document.getElementById('createModal').classList.add('hidden');
}

function openEditModal(tutorId, tutorName) {
    document.getElementById('edit_name').value = tutorName;
    document.getElementById('editForm').action = `/admin/tutors/${tutorId}`;
    document.getElementById('editModal').classList.remove('hidden');
}

function closeEditModal() {
    document.getElementById('editModal').classList.add('hidden');
}

// Close modals when clicking outside
document.getElementById('createModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeCreateModal();
    }
});

document.getElementById('editModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closeEditModal();
    }
});
</script>
@endsection 