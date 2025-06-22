<div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
    <div class="flex items-center justify-center h-16 bg-blue-600 text-white">
        <h1 class="text-xl font-bold">TutorDek Siswa</h1>
    </div>
    
    <nav class="mt-8">
        <div class="px-4 space-y-2">
            <a href="{{ route('student.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('student.dashboard') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('student.tutor-catalog.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('student.tutor-catalog.index') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-users mr-3"></i>
                Katalog Pengajar
            </a>
            <a href="{{ route('student.learning-history.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('student.learning-history.index') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-history mr-3"></i>
                Riwayat Pembelajaran
            </a>
            <a href="{{ route('student.payments.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('student.payments.index') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-credit-card mr-3"></i>
                Pembayaran
            </a>
                <a href="{{ route('account.settings') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('account.settings') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-cog mr-3"></i>
                Pengaturan Akun
            </a>
            <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </a>
        </div>
    </nav>
</div>