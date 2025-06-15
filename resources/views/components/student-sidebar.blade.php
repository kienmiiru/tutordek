<div class="w-64 bg-white shadow-lg">
    <div class="p-4">
        <h1 class="text-2xl font-bold text-gray-800">TutorDek</h1>
        <p class="text-gray-600">Dashboard</p>
    </div>
    <nav class="mt-4">
        <a href="{{ route('student.tutor-catalog.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-book-open w-6"></i>
            <span>Katalog Pengajar</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-history w-6"></i>
            <span>Riwayat Pembelajaran</span>
        </a>
        <a href="{{ route('student.payments.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-credit-card w-6"></i>
            <span>Pembayaran</span>
        </a>
        <a href="{{ route('account.settings') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-cog w-6"></i>
            <span>Pengaturan Akun</span>
        </a>
        <a href="{{ route('logout') }}" class="flex items-center px-4 py-3 text-red-600 hover:bg-gray-100">
            <i class="fas fa-sign-out-alt w-6"></i>
            <span>Logout</span>
        </a>
    </nav>
</div> 