@extends('layouts.app')

@section('title', 'Upload Bukti Pembayaran - TutorDek')

@section('sidebar')
    <x-student-sidebar />
@endsection

@section('content')
    <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
        <div class="p-6 text-gray-900">
            <div class="max-w-2xl mx-auto">
                <h2 class="text-2xl font-semibold mb-6">Upload Bukti Pembayaran</h2>

                <div class="bg-gray-50 rounded-lg p-6 mb-8">
                    <div class="space-y-4">
                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Detail Pembayaran</h3>
                            <div class="mt-2 space-y-2">
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Pengajar:</span> {{ $payment->teachingSession->tutor->name }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Mata Pelajaran:</span> {{ $payment->teachingSession->subject->name }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Tanggal:</span> {{ $payment->teachingSession->start_at->format('d F Y') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Waktu:</span> {{ $payment->teachingSession->start_at->format('H:i') . '-' . $payment->teachingSession->end_at->format('H:i') }}
                                </p>
                                <p class="text-sm text-gray-600">
                                    <span class="font-medium">Jumlah:</span> Rp {{ number_format($payment->teachingSession->price, 0, ',', '.') }}
                                </p>
                            </div>
                        </div>

                        <div>
                            <h3 class="text-lg font-medium text-gray-900">Metode Pembayaran</h3>
                            <div class="mt-2">
                                <p class="text-sm text-gray-600">
                                    {{ $paymentMethod->payment_method }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <form action="{{ route('student.payments.update', $payment) }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="mb-6">
                        <label for="payment_proof" class="block text-sm font-medium text-gray-700 mb-2">
                            Upload Bukti Pembayaran
                        </label>
                        <input type="file" name="payment_proof" id="payment_proof" required
                               class="block w-full text-sm text-gray-500
                                      file:mr-4 file:py-2 file:px-4
                                      file:rounded-md file:border-0
                                      file:text-sm file:font-semibold
                                      file:bg-indigo-50 file:text-indigo-700
                                      hover:file:bg-indigo-100">
                        <p class="mt-1 text-sm text-gray-500">
                            Format yang didukung: JPG, JPEG, PNG. Maksimal ukuran file: 2MB
                        </p>
                        @error('payment_proof')
                            <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <a href="{{ route('student.payments.index') }}" class="text-sm text-gray-600 hover:text-gray-900">
                            Kembali ke Daftar Pembayaran
                        </a>
                        <button type="submit" class="inline-flex justify-center py-2 px-4 border border-transparent shadow-sm text-sm font-medium rounded-md text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                            Upload Bukti
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection 