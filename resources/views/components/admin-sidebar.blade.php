<!-- <div class="fixed inset-y-0 left-0 z-50 w-64 bg-white shadow-lg">
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
</div> -->

<div x-data="{
    open: false,
    isMobile: window.innerWidth < 1024,
    init() {
        this.$watch('isMobile', (value) => {
            if (!value) this.open = false;
        });
        window.addEventListener('resize', () => {
            this.isMobile = window.innerWidth < 1024;
        });
    }
}" @resize.window="isMobile = window.innerWidth < 1024">
    <!-- Navbar Mobile -->
    <nav class="flex w-screen fixed p-3 bg-sky-400  lg:hidden">
        <button @click="open = !open" class="focus:outline-none">
            <!-- Burger Icon (default visible) -->
            <svg x-show="!open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6 text-white">
                <path stroke-linecap="round" stroke-linejoin="round" d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>

            <!-- Close Icon (visible when sidebar open) -->
            <svg x-show="open" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5"
                stroke="currentColor" class="size-6">
                <path stroke-linecap="round" stroke-linejoin="round" d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>

        <div class="flex items-center bg-sky-400">
            <span class="text-xl font-bold text-white -mt-1 ml-3">TutorDek</span>
        </div>
    </nav>

    <!-- Overlay (Mobile only) -->
    <div x-show="open && isMobile" @click="open = false" x-transition.opacity.duration.300ms
        class="fixed inset-0 bg-black/50 z-40 lg:hidden">
    </div>

    <!-- Single Sidebar for Both Mobile and Desktop -->
    <aside x-show="!isMobile || open" x-transition:enter="transition-transform duration-300 ease-out"
        x-transition:enter-start="-translate-x-full lg:translate-x-0" x-transition:enter-end="translate-x-0"
        x-transition:leave="transition-transform duration-300 ease-in" x-transition:leave-start="translate-x-0"
        x-transition:leave-end="-translate-x-full lg:translate-x-0"
        :class="{
            'fixed flex flex-col justify-between inset-y-0 left-0 w-64 bg-white shadow-lg z-50 transform': isMobile,
            'hidden lg:flex flex-col justify-between lg:fixed lg:inset-y-0 lg:left-0 lg:w-64 lg:bg-white lg:shadow-lg lg:z-50':
                !isMobile
        }">

        <div class="mt-2">
            <a href="{{ route('admin.dashboard') }}"
                class="text-2xl font-bold text-white inline-block -mt-2 w-full bg-sky-400 p-5">TutorDek</a>

            <a href="{{ route('admin.sessions.index') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-calendar-alt w-6"></i>
                <span>Sesi</span>
            </a>
            <a href="{{ route('admin.availabilities.index') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-clock w-6"></i>
                <span>Kelola Ketersediaan</span>
            </a>
            <a href="{{ route('admin.tutor-accounts.index') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-users w-6"></i>
                <span>Kelola Tutor</span>
            </a>
            <a href="{{ route('admin.payment-methods.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-credit-card w-6"></i>
                <span>Metode Pembayaran</span>
            </a>
            <a href="{{ route('account.settings') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-cog w-6"></i>
                <span>Pengaturan Akun</span>
            </a>
        </div>

        <div class="">
            <a href="{{ route('logout') }}" class="flex items-center px-4 py-3 text-red-600 hover:bg-gray-100">
                <i class="fas fa-sign-out-alt w-6"></i>
                <span>Logout</span>
            </a>
        </div>
    </aside>

</div>
