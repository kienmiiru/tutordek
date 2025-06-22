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
            <a href="{{ route('tutor.dashboard') }}"
                class="text-2xl font-bold text-white inline-block -mt-2 w-full bg-sky-400 p-5">TutorDek</a>

            <a href="{{ route('tutor.availabilities.index') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-calendar-alt w-6"></i>
                <span>Kelola Jadwal Ketersediaan</span>
            </a>
            <a href="{{ route('tutor.sessions.index') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-chalkboard-teacher w-6"></i>
                <span>Kelola Sesi Les</span>
            </a>
            <a href="{{ route('tutor.learning-history.index') }}" class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
                <i class="fas fa-history w-6"></i>
                <span>Riwayat Pembelajaran</span>
            </a>

            <a href="{{ route('account.settings') }}"
                class="flex items-center px-4 py-3 text-gray-700 hover:bg-gray-100">
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
