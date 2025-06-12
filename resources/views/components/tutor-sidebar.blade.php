<div class="w-64 bg-white shadow-lg">
    <div class="p-4">
        <h1 class="text-2xl font-bold text-gray-800">TutorDek</h1>
        <p class="text-gray-600">Dashboard</p>
    </div>
    <nav class="mt-4">
        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-calendar-alt w-6"></i>
            <span>Kelola Jadwal Ketersediaan</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-chalkboard-teacher w-6"></i>
            <span>Kelola Sesi Les</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-history w-6"></i>
            <span>Riwayat Pembelajaran</span>
        </a>
        <a href="#" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
            <i class="fas fa-money-bill-wave w-6"></i>
            <span>Kelola Pembayaran</span>
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