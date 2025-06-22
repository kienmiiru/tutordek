@extends('layouts.app')

@section('title', 'Metode Pembayaran - Admin')

@section('sidebar')
    @include('components.admin-sidebar')
@endsection

@section('content')
<div class="space-y-6">
    <div class="flex justify-between items-center">
        <h1 class="text-3xl font-bold text-gray-900">Metode Pembayaran</h1>
        <a href="{{ route('admin.dashboard') }}" class="bg-gray-500 hover:bg-gray-600 text-white px-4 py-2 rounded-lg">
            <i class="fas fa-arrow-left mr-2"></i>Kembali ke Dashboard
        </a>
    </div>

    @if(session('success'))
        <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded">
            {{ session('success') }}
        </div>
    @endif

    <!-- Payment Method Configuration -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Konfigurasi Metode Pembayaran</h3>
            <p class="text-sm text-gray-600 mt-1">Konfigurasi metode pembayaran yang akan ditampilkan kepada siswa</p>
        </div>
        <div class="p-6">
            <form action="{{ route('admin.payment-methods.update') }}" method="POST">
                @csrf
                @method('PUT')
                
                <div class="mb-6">
                    <label for="payment_method" class="block text-sm font-medium text-gray-700 mb-2">
                        Detail Metode Pembayaran
                    </label>
                    <textarea 
                        id="payment_method" 
                        name="payment_method" 
                        rows="6"
                        class="w-full px-3 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500"
                        placeholder="Masukkan detail metode pembayaran (contoh: no. rek, e-wallet, dll.)"
                    >{{ $paymentMethod ? $paymentMethod->payment_method : '' }}</textarea>
                    <p class="text-sm text-gray-500 mt-1">
                        Informasi ini akan ditampilkan kepada siswa saat mereka perlu membayar sesi pengajaran.
                    </p>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white px-6 py-2 rounded-lg">
                        <i class="fas fa-save mr-2"></i>Update Metode Pembayaran
                    </button>
                </div>
            </form>
        </div>
    </div>

    <!-- Payment Statistics -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-blue-100 text-blue-600">
                    <i class="fas fa-credit-card text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Total Pembayaran</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Payment::count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-green-100 text-green-600">
                    <i class="fas fa-check text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pembayaran Terverifikasi</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Payment::where('status', 'verified')->count() }}</p>
                </div>
            </div>
        </div>

        <div class="bg-white rounded-lg shadow p-6">
            <div class="flex items-center">
                <div class="p-3 rounded-full bg-yellow-100 text-yellow-600">
                    <i class="fas fa-clock text-xl"></i>
                </div>
                <div class="ml-4">
                    <p class="text-sm font-medium text-gray-600">Pembayaran Pending</p>
                    <p class="text-2xl font-semibold text-gray-900">{{ \App\Models\Payment::where('status', 'pending')->count() }}</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Payments -->
    <div class="bg-white rounded-lg shadow">
        <div class="px-6 py-4 border-b border-gray-200">
            <h3 class="text-lg font-medium text-gray-900">Pembayaran Terbaru</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Siswa</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tutor</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Jumlah</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Status</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Tanggal</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @foreach(\App\Models\Payment::with(['teachingSession.student', 'teachingSession.tutor'])->latest()->take(5)->get() as $payment)
                    <tr>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $payment->teachingSession->student->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $payment->teachingSession->tutor->name }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                            Rp {{ number_format($payment->teachingSession->price, 0, ',', '.') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full 
                                @if($payment->status === 'verified') bg-green-100 text-green-800
                                @elseif($payment->status === 'pending') bg-yellow-100 text-yellow-800
                                @else bg-red-100 text-red-800
                                @endif">
                                {{ ucfirst($payment->status) }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $payment->created_at->format('M d, Y H:i') }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection 