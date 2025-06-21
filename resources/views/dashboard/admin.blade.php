@extends('layouts.app')

@section('title', 'Admin Dashboard - TutorDek')

@section('sidebar')
<div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
    <div class="flex items-center justify-center h-16 bg-blue-600 text-white">
        <h1 class="text-xl font-bold">TutorDek Admin</h1>
    </div>
    
    <nav class="mt-8">
        <div class="px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 bg-blue-100 rounded-lg">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.sessions.index') }}" class="flex items-center px-4 py-2 text-gray-700 hover:bg-gray-100 rounded-lg">
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
        <h1 class="text-3xl font-bold text-gray-900">Admin Dashboard</h1>
        <div class="text-sm text-gray-500">
            Welcome back, {{ auth()->user()->name }}
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
                    <p class="text-sm font-medium text-gray-600">Total Sessions</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\TeachingSession::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-users text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Tutors</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\User::where('role', 'tutor')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pending Payments</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Payment::where('status', 'pending')->count() }}</p>
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
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Subject::count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Quick Actions</h3>
        </div>
        <div class="p-6">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <a href="{{ route('admin.sessions.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-calendar-check text-blue-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Manage Sessions</p>
                        <p class="text-sm text-gray-500">View and manage teaching sessions</p>
                    </div>
                </a>

                <a href="{{ route('admin.tutor-accounts.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-user-plus text-green-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Manage Tutors</p>
                        <p class="text-sm text-gray-500">Add, edit, or remove tutor accounts</p>
                    </div>
                </a>

                <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center p-4 border border-gray-200 rounded-lg hover:bg-gray-50">
                    <i class="fas fa-credit-card text-purple-600 mr-3"></i>
                    <div>
                        <p class="font-medium text-gray-900">Payment Settings</p>
                        <p class="text-sm text-gray-500">Configure payment methods</p>
                    </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Recent Sessions -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Recent Sessions</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Student</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Subject</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(\App\Models\TeachingSession::with(['student', 'tutor', 'subject'])->latest()->take(5)->get() as $session)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $session->student->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $session->tutor->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $session->subject->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $session->start_at->format('M d, Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($session->status === 'confirmed') bg-green-100 text-green-800
                                @elseif($session->status === 'pending_payment') bg-yellow-100 text-yellow-800
                                @elseif($session->status === 'completed') bg-blue-100 text-blue-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst(str_replace('_', ' ', $session->status)) }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 