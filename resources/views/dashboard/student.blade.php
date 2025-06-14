@extends('layouts.app')

@section('title', 'Dashboard - TutorDek')

@section('sidebar')
    @include('components.student-sidebar')
@endsection

@section('content')
    <div class="bg-white rounded-lg shadow-md p-6">
        <h2 class="text-2xl font-bold mb-4">Selamat Datang! Anda Login Sebagai {{ auth()->user()->name }}</h2>
        <p class="text-gray-600">Silakan pilih menu di sidebar untuk memulai.</p>
    </div>
@endsection 