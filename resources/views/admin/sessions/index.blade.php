@extends('layouts.app')

@section('title', 'Manage Sessions - Admin')

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
            <a href="{{ route('admin.sessions.index') }}" class="flex items-center px-4 py-2 text-gray-700 bg-blue-100 rounded-lg">
                <i class="fas fa-calendar-alt mr-3"></i>
                Sessions
            </a>
            <a href="{{ route('admin.availabilities.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
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
        <h1 class="text-3xl font-bold text-gray-900">Manage Sessions</h1>
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
    <div class="grid grid-cols-1 md:grid-cols-4 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-calendar-alt text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Sessions</p>
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
                    <p class="text-sm font-medium text-gray-600">Pending Verification</p>
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
                    <p class="text-sm font-medium text-gray-600">Confirmed</p>
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
                    <p class="text-sm font-medium text-gray-600">Rejected</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ $sessions->where('status', 'rejected')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Sessions Table -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">All Sessions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date & Time</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Price</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Payment Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Session Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
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
                                    No Payment
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
                            @if($session->payment && $session->payment->status === 'pending')
                                <form action="{{ route('admin.sessions.update-payment-status', $session) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="verified">
                                    <button type="submit" class="text-green-600 hover:text-green-900 mr-2" 
                                            onclick="return confirm('Verify this payment?')">
                                        <i class="fas fa-check"></i> Verify
                                    </button>
                                </form>
                                <form action="{{ route('admin.sessions.update-payment-status', $session) }}" method="POST" class="inline">
                                    @csrf
                                    @method('PUT')
                                    <input type="hidden" name="status" value="rejected">
                                    <button type="submit" class="text-red-600 hover:text-red-900" 
                                            onclick="return confirm('Reject this payment?')">
                                        <i class="fas fa-times"></i> Reject
                                    </button>
                                </form>
                            @endif
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="8" class="px-6 py-4 text-center text-gray-500">
                            No sessions found.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 