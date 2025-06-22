<!DOCTYPE html>
<html lang="en" style="scroll-behavior: smooth">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tutordek</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <style>
        .image-container {
            position: relative;
            width: 400px;
            height: 300px;
            overflow: hidden;
        }

        .slide-image {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            transition: transform 0.8s cubic-bezier(0.4, 0, 0.2, 1), opacity 0.8s ease;
        }

        .slide-left {
            transform: translateX(100%);
            opacity: 0;
        }

        .slide-right {
            transform: translateX(-100%);
            opacity: 0;
        }

        .active {
            transform: translateX(0);
            opacity: 1;
        }

        @keyframes rotate {
            from {
                transform: rotate(0deg);
            }

            to {
                transform: rotate(360deg);
            }
        }

        .rotate-animation {
            animation: rotate 5s linear infinite;
            transform-origin: center;
            /* Pusat rotasi */
        }
    </style>
</head>

<body class="font-sans bg-gray-50">
    <!-- Navbar -->
    <nav class="bg-gradient-to-tr from-[#D8B4FE] to-[#E9D5FF] shadow-lg">
        <div class="max-w-6xl mx-auto px-4">
            <div class="flex justify-between">
                <div class="flex space-x-7">
                    <!-- Logo -->
                    <div>
                        <a href="#" class="flex items-center py-4 px-2">
                            <div class="p-1 mr-2 rounded bg-[#451a8b]">
                                <img src="{{ asset('logo.png') }}" class="h-10 w-10 -mt-1" alt="">
                            </div>
                            <span class="font-bold text-[#451a8b] text-lg">Tutordek</span>
                        </a>
                    </div>
                    <!-- Primary Navbar items -->
                    <div class="hidden md:flex items-center space-x-1">
                        <a href="#home"
                            class="py-4 px-2 text-[#451a8b] font-semibold hover:border-b-2 hover:border-b-white transition duration-75">Home</a>
                        <a href="#pricing"
                            class="py-4 px-2 text-[#451a8b] font-semibold  hover:border-b-2 hover:border-b-white transition duration-75">Pricing</a>
                        <a href="#about"
                            class="py-4 px-2 text-[#451a8b] font-semibold  hover:border-b-2 hover:border-b-white transition duration-75">About
                            Us</a>
                        <a href="#contact"
                            class="py-4 px-2 text-[#451a8b] font-semibold  hover:border-b-2 hover:border-b-white transition duration-75">Contact
                            Us</a>
                    </div>
                </div>
                <!-- Secondary Navbar items -->
                <div class="hidden md:flex items-center space-x-3">
                    <a href="{{ route('login') }}"
                        class="py-2 px-3 font-medium text-[#451a8b] cursor-pointer rounded z-10 hover:bg-[#baadcb] transition duration-300">
                        Log In
                    </a>
                    <a href="{{ route('register') }}"
                        class="py-2 px-3 font-medium text-white bg-[#5B21B6] rounded z-10 hover:bg-[#451a8b]  transition duration-300">
                        Sign Up
                    </a>
                </div>
                <!-- Mobile menu button -->
                <div class="md:hidden flex items-center">
                    <button class="outline-none mobile-menu-button">
                        <svg class="w-6 h-6 text-gray-500 hover:text-blue-500" x-show="!showMenu" fill="none"
                            stroke-linecap="round" stroke-linejoin="round" stroke-width="2" viewBox="0 0 24 24"
                            stroke="currentColor">
                            <path d="M4 6h16M4 12h16M4 18h16"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <!-- Mobile menu -->
        <div class="hidden mobile-menu transform transition-all duration-300 ease-in-out origin-top ">
            <ul class="">
                <li class="active">
                    <a href="#home" class="block text-sm px-2 py-4 text-white bg-blue-500 font-semibold">
                        Home
                    </a>
                </li>
                <li>
                    <a href="#pricing" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">
                        Pricing
                    </a>
                </li>
                <li>
                    <a href="#about" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">
                        About Us
                    </a>
                </li>
                <li>
                    <a href="#contact" class="block text-sm px-2 py-4 hover:bg-blue-500 transition duration-300">
                        Contact Us
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <section id="home" class="py-[8rem] bg-gradient-to-br from-[#D8B4FE] to-[#E9D5FF] text-white">
        <div class="container mx-auto px-6">
            <div class="flex flex-col md:flex-row items-center gap-8">
                <!-- Konten teks di sebelah kiri -->
                <div class="md:w-1/2 -ml-14 lg:-ml-2 text-center lg:text-left pl-16">
                    <h1 class="text-[#5B21B6] text-4xl font-bold mb-6">Platform #1 untuk Guru Freelance dan Siswa
                        Berprestasi</h1>
                    <p class="text-[#6D28D9] text-xl mb-7 max-w-5xl">
                        Platform terbaik untuk guru freelance yang ingin dapat murid lebih banyak, dan siswa yang butuh
                        bimbingan belajar terpercaya. Fitur lengkap, aman, dan fleksibel!
                    </p>
                    <button
                        class="bg-[#5922b1] hover:bg-[#3c1678] text-[#f6f4fa] font-bold rounded-2xl py-3 px-8 shadow-lg transition duration-300">
                        GET STARTED
                    </button>
                </div>

                <!-- Elemen tambahan di sebelah kanan -->
                <div class="hidden md:block md:w-1/6">
                    <svg id="sw-js-blob-svg" class="top-2 right-8 absolute" width="550" height="550"
                        viewBox="0 0 100 100" xmlns="http://www.w3.org/2000/svg" version="1.1">
                        <defs>
                            <linearGradient id="sw-gradient" x1="0" x2="1" y1="1"
                                y2="0">
                                <stop id="stop1" stop-color="rgba(216, 180, 254, 1)" offset="0%"></stop>
                                <stop id="stop2" stop-color="rgba(60, 22, 120, 1)" offset="100%"></stop>
                            </linearGradient>
                        </defs>
                        <path fill="url(#sw-gradient)"
                            d="M18.6,-21.9C24.5,-17.3,29.9,-11.7,32.7,-4.4C35.6,2.9,36.1,12,32.8,20.3C29.6,28.6,22.8,36.1,14.1,39.8C5.4,43.5,-5.2,43.3,-13.4,39.3C-21.6,35.2,-27.5,27.3,-31.5,18.9C-35.5,10.5,-37.6,1.8,-36.5,-6.8C-35.4,-15.3,-31.1,-23.7,-24.5,-28.1C-17.9,-32.6,-8.9,-33.3,-1.3,-31.8C6.4,-30.3,12.8,-26.5,18.6,-21.9Z"
                            width="100%" height="100%" transform="translate(50 50)" stroke-width="0"
                            style="transition: 0.3s;"></path>
                    </svg>
                    <img src="{{ asset('adek.png') }}" alt="Hero Image"
                        class="h-[32rem] top-[5.3rem] right-32 absolute drop-shadow-[0_10px_15px_rgba(251,207,232,0.5)]">
                </div>
            </div>
        </div>
    </section>

    <section id="features" class="py-20 bg-gray-50">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-4">Fitur Unggulan Sistem Kami</h2>
            <p class="text-center text-gray-600 max-w-2xl mx-auto mb-12">Solusi lengkap untuk kebutuhan belajar dan
                kolaborasi Anda.</p>

            <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                <!-- Fitur 1: Platform Kolaboratif -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Platform Kolaboratif</h3>
                    <p class="text-gray-600">
                        Ruang diskusi real-time, berbagi dokumen, dan proyek kelompok dengan fitur whiteboard digital.
                    </p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Diskusi forum & chat grup</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Kolaborasi dokumen bersama</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Video meeting terintegrasi</span>
                        </li>
                    </ul>
                </div>

                <!-- Fitur 2: Akses Mudah Layanan Belajar -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-pink-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-pink-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Akses Mudah Belajar</h3>
                    <p class="text-gray-600">
                        Materi pembelajaran terstruktur, kuis interaktif, dan rekaman kelas yang bisa diakses kapan saja
                        dari perangkat apa pun.
                    </p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>1000+ modul belajar</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Bank soal & latihan</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Progress tracking</span>
                        </li>
                    </ul>
                </div>

                <!-- Fitur 3: Jadwal Fleksibel -->
                <div class="bg-white p-8 rounded-xl shadow-md hover:shadow-lg transition-shadow">
                    <div class="w-14 h-14 bg-purple-100 rounded-lg flex items-center justify-center mb-6">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-600" fill="none"
                            viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M8 7V3m8 4V3m-9 8h10M5 21h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v12a2 2 0 002 2z" />
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-800 mb-3">Jadwal Fleksibel</h3>
                    <p class="text-gray-600">
                        Belajar sesuai ritme Anda dengan sistem booking kelas dan sesi ulang tanpa
                        biaya tambahan.
                    </p>
                    <ul class="mt-4 space-y-2">
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Booking kelas 24/7</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Reschedule gratis</span>
                        </li>
                        <li class="flex items-start">
                            <svg class="w-5 h-5 text-green-500 mt-0.5 mr-2 flex-shrink-0" fill="none"
                                stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M5 13l4 4L19 7"></path>
                            </svg>
                            <span>Rekaman kelas tersedia</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </section>

    <!-- About Us Section -->
    <section id="about" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">About Us</h2>
            <div class="flex flex-col md:flex-row items-center">
                <div
                    class="image-container overflow-hidden object-cover rounded-lg shadow-lg w-full transition-opacity ease-in-out duration-300 mb-8 mr-6 md:w-1/2 md:mb-0 md:pr-8">


                </div>
                <div class="-mt-3 md:w-1/2">
                    <h3 class="text-2xl font-bold text-gray-800 mb-4">Apa Itu Tutordek?</h3>
                    <p class="text-gray-600 mb-4">
                        Tutordek adalah platform inovatif yang menghubungkan guru freelance dengan siswa yang
                        membutuhkan bimbingan belajar.
                    </p>
                    <p class="text-gray-600 mb-6">
                        Aplikasi ini memudahkan tutor untuk menemukan murid sesuai
                        keahlian mereka, sementara siswa dapat mencari pengajar berkualitas dengan fleksibilitas penuh.
                        Dengan fitur pencarian cerdas, sistem ulasan, dan manajemen jadwal, Tutordek menjadi solusi
                        terbaik untuk pembelajaran personal yang efektif.
                    </p>
                    <button
                        class="bg-[#6D28D9] text-white py-2 px-6 -mt-2 rounded-lg font-semibold hover:bg-[#3c1678] transition duration-300">Learn
                        More</button>
                </div>
            </div>
        </div>
    </section>

    <!-- Contact Us Section -->
    <section id="contact" class="py-20 bg-gray-100">
        <div class="container mx-auto px-6 max-w-4xl">
            <h2 class="text-3xl font-bold text-center text-gray-800 mb-12">Contact Us</h2>
            <div class="bg-white rounded-lg shadow-lg p-8">
                <form>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="name" class="block text-gray-700 font-medium mb-2">Name</label>
                            <input type="text" id="name"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div>
                            <label for="email" class="block text-gray-700 font-medium mb-2">Email</label>
                            <input type="email" id="email"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="subject" class="block text-gray-700 font-medium mb-2">Subject</label>
                            <input type="text" id="subject"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500">
                        </div>
                        <div class="md:col-span-2">
                            <label for="message" class="block text-gray-700 font-medium mb-2">Message</label>
                            <textarea id="message" rows="5"
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <button type="submit"
                                class="w-full bg-[#6D28D9] text-white py-3 rounded-lg font-semibold hover:bg-[#3c1678] transition duration-300">Send
                                Message</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-800 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8">
                <div>
                    <h3 class="text-xl font-bold mb-4">Tutordek</h3>
                    <p class="text-gray-400">
                        Tutordek adalah platform inovatif yang menghubungkan guru freelance dengan siswa yang
                        membutuhkan bimbingan belajar.
                    </p>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Quick Links</h4>
                    <ul class="space-y-2">
                        <li><a href="#home" class="text-gray-400 hover:text-white transition duration-300">Home</a>
                        </li>
                        <li><a href="#pricing"
                                class="text-gray-400 hover:text-white transition duration-300">Pricing</a></li>
                        <li><a href="#about" class="text-gray-400 hover:text-white transition duration-300">About
                                Us</a></li>
                        <li><a href="#contact" class="text-gray-400 hover:text-white transition duration-300">Contact
                                Us</a></li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Contact Info</h4>
                    <ul class="space-y-2 text-gray-400">
                        <li class="flex items-center">
                            <i class="fas fa-map-marker-alt mr-2"></i>
                            <span>123 Street, City, Country</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-phone mr-2"></i>
                            <span>+1 234 567 890</span>
                        </li>
                        <li class="flex items-center">
                            <i class="fas fa-envelope mr-2"></i>
                            <span>info@example.com</span>
                        </li>
                    </ul>
                </div>
                <div>
                    <h4 class="text-lg font-semibold mb-4">Follow Us</h4>
                    <div class="flex space-x-4">
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-facebook-f text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-twitter text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-instagram text-xl"></i>
                        </a>
                        <a href="#" class="text-gray-400 hover:text-white transition duration-300">
                            <i class="fab fa-linkedin-in text-xl"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="border-t border-gray-700 mt-8 pt-8 text-center text-gray-400">
                <p>&copy; 2025 Tutordek. All rights reserved.</p>
            </div>
        </div>
    </footer>



    <!-- JavaScript for mobile menu -->
    <script>
        const btn = document.querySelector("button.mobile-menu-button");
        const menu = document.querySelector(".mobile-menu");

        btn.addEventListener("click", () => {
            menu.classList.toggle("hidden");
        });

        const images = [
            "bg/latar(1).jpg",
            "bg/latar(2).jpg",
            "bg/latar(3).jpg",
            "bg/latar(4).jpg"
        ];

        const container = document.querySelector('.image-container');
        const shape = document.querySelector('#sw-js-blob-svg');
        let currentIndex = 0;

        function rotate() => {}

        shape.classList.add('rotate-animation');

        // setInterval(() => {

        //     shape.style.transform = 'rotate(45deg)';
        //     shape.style.transformOrigin = '50% 50%';
        // }, 2000);

        // Buat elemen gambar
        images.forEach((src, index) => {
            const img = document.createElement('img');
            img.src = src;
            img.alt = `Slide ${index + 1}`;
            img.classList.add('slide-image');

            if (index === 0) {
                img.classList.add('active');
            } else {
                img.classList.add('slide-right');
            }

            container.appendChild(img);
        });

        function nextSlide() {
            const currentImg = container.querySelector('.active');
            const nextIndex = (currentIndex + 1) % images.length;
            const nextImg = container.children[nextIndex];

            // Atur posisi awal untuk gambar berikutnya
            nextImg.classList.remove('slide-left', 'slide-right');
            nextImg.classList.add('slide-right');

            // Trigger reflow
            void nextImg.offsetWidth;

            // Mulai transisi
            currentImg.classList.remove('active');
            currentImg.classList.add('slide-left');

            nextImg.classList.remove('slide-right');
            nextImg.classList.add('active');

            currentIndex = nextIndex;
        }

        // Ganti gambar setiap 3 detik
        setInterval(nextSlide, 3000);
    </script>
</body>

</html>
