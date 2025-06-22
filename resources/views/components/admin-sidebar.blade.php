<div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
    <div class="flex items-center justify-center h-16 bg-blue-600 text-white">
        <h1 class="text-xl font-bold">TutorDek Admin</h1>
    </div>
    
    <nav class="mt-8">
        <div class="px-4 space-y-2">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('admin.dashboard') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
            <a href="{{ route('admin.sessions.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('admin.sessions.index') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-calendar-alt mr-3"></i>
                Sesi
            </a>
            <a href="{{ route('admin.availabilities.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('admin.availabilities.index') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-clock mr-3"></i>
                Ketersediaan
            </a>
            <a href="{{ route('admin.tutor-accounts.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('admin.tutor-accounts.index') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-users mr-3"></i>
                Akun Tutor
            </a>
            <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg {{ request()->routeIs('admin.payment-methods.index') ? 'bg-blue-100' : 'hover:bg-gray-100' }}">
                <i class="fas fa-credit-card mr-3"></i>
                Metode Pembayaran
            </a>
            <a href="{{ route('logout') }}" class="flex items-center px-4 py-2 text-gray-700 rounded-lg hover:bg-gray-100">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </a>
        </div>
    </nav>
</div>