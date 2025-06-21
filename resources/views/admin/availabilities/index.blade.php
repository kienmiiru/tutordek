@extends('layouts.app')

@section('title', 'Manage Availabilities - Admin')

@section('sidebar')
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
    <div class="flex items-center justify-center h-16 bg-blue-600 text-white">
        <h1 class="text-xl font-bold">TutorDek Admin</h1>
    </div>
    
    <nav class="mt-8">
        <div class="px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.sessions.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-calendar-alt mr-3"></i>
                Sessions
            </a>
            <a href="{{ route('admin.availabilities.index') }}" class="flex items-center px-4 py-2 text-gray-700 bg-blue-100 rounded-lg">
                <i class="fas fa-clock mr-3"></i>
                Availabilities
            </a>
            <a href="{{ route('admin.tutor-accounts.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-users mr-3"></i>
                Tutor Accounts
            </a>
            <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
                <i class="fas fa-credit-card mr-3"></i>
                Payment Methods
            </a>
        </div>
    </nav>
</div>
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Manage Availabilities</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-2"></i>Back to Dashboard
        </a>
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
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Availabilities</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $availabilities->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Active Tutors</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $availabilities->unique('tutor_id')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-purple-100 text-purple-600">
                    <i class="fas fa-book text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Subjects</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $availabilities->unique('subject_id')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Availabilities Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">All Availabilities</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Day</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Current Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($availabilities as $availability)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $availability->tutor->name }}</div>
                            <div class="text-sm text-gray-500">{{ $availability->tutor->email }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $availability->subject->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ ucfirst($availability->day) }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            {{ $availability->start_time }} - {{ $availability->end_time }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($availability->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                            <button onclick="openPriceModal({{ $availability->id }}, {{ $availability->price }})" 
                                    class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i> Update Price
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No availabilities found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Price Update Modal -->
<div id="priceModal" class="fixed inset-0 bg-gray-600 bg-opacity-50 overflow-y-auto h-full w-full hidden z-50">
    <div class="relative top-20 mx-auto p-5 border w-96 shadow-lg rounded-md bg-white">
        <div class="mt-3">
            <h3 class="text-lg font-medium text-gray-900 mb-4">Update Price</h3>
            <form id="priceForm" method="POST">
                @csrf
                @method('PUT')
                <div class="mb-4">
                    <label for="price" class="block text-sm font-medium text-gray-700 mb-2">New Price (Rp)</label>
                    <input type="number" id="price" name="price" min="0" step="1000" 
                           class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>
                <div class="flex justify-end space-x-3">
                    <button type="button" onclick="closePriceModal()" 
                            class="px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="px-4 py-2 bg-blue-600 text-white rounded-md hover:bg-blue-700">
                        Update Price
                    </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
function openPriceModal(availabilityId, currentPrice) {
    document.getElementById('price').value = currentPrice;
    document.getElementById('priceForm').action = `/admin/availabilities/${availabilityId}/price`;
    document.getElementById('priceModal').classList.remove('hidden');
}

function closePriceModal() {
    document.getElementById('priceModal').classList.add('hidden');
}

// Close modal when clicking outside
document.getElementById('priceModal').addEventListener('click', function(e) {
    if (e.target === this) {
        closePriceModal();
    }
});
</script>
@endsection 