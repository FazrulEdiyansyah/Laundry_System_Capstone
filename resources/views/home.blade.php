<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TempatCuciIbuk - Laundry Modern & Terpercaya</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb', // Blue
                        secondary: '#10b981', // Green
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
        .delay-300 { animation-delay: 0.3s; }
        .delay-400 { animation-delay: 0.4s; }
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50" id="navbar">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-blue-600 to-green-500 p-2.5 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">TempatCuciIbuk</span>
                </div>
                
                <div class="hidden md:flex items-center space-x-8">
                    <a href="#" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Beranda</a>
                    <a href="#layanan" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Layanan</a>
                    <a href="#tentang" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Tentang</a>
                    @auth
                        <a href="{{ route('customer.dashboard') }}" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-lg transition-all">
                            Dashboard
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Masuk</a>
                        <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-lg transition-all">
                            Daftar
                        </a>
                    @endauth
                </div>

                <!-- Mobile Menu Button -->
                <button class="md:hidden text-gray-700" onclick="toggleMobileMenu()">
                    <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16"></path>
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu -->
        <div id="mobileMenu" class="hidden md:hidden bg-white border-t">
            <div class="container mx-auto px-6 py-4 space-y-4">
                <a href="#" class="block text-gray-700 hover:text-blue-600">Beranda</a>
                <a href="#layanan" class="block text-gray-700 hover:text-blue-600">Layanan</a>
                <a href="#tentang" class="block text-gray-700 hover:text-blue-600">Tentang</a>
                @auth
                    <a href="{{ route('customer.dashboard') }}" class="block bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-2.5 rounded-full text-center">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="block text-blue-600">Masuk</a>
                    <a href="{{ route('register') }}" class="block bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-2.5 rounded-full text-center">Daftar</a>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="space-y-6 opacity-0 fade-in-up">
                    <div class="inline-block bg-blue-100 text-blue-700 px-4 py-2 rounded-full text-sm font-semibold">
                        🚀 Laundry Modern & Terpercaya
                    </div>
                    <h1 class="text-5xl md:text-6xl font-bold text-gray-900 leading-tight">
                        Cucian Bersih, <br>
                        <span class="bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">Hidup Lebih Fresh</span>
                    </h1>
                    <p class="text-xl text-gray-600 leading-relaxed">
                        Layanan laundry profesional dengan teknologi modern. Kami jaga pakaian Anda seperti milik sendiri.
                    </p>
                    <div class="flex flex-wrap gap-4">
                        @auth
                            <a href="{{ route('customer.dashboard') }}" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all transform hover:scale-105">
                                Mulai Order
                            </a>
                        @else
                            <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-8 py-4 rounded-full font-semibold hover:shadow-xl transition-all transform hover:scale-105">
                                Daftar Sekarang
                            </a>
                        @endauth
                        <a href="tel:08123456789" class="border-2 border-blue-600 text-blue-600 px-8 py-4 rounded-full font-semibold hover:bg-blue-50 transition-all">
                            📞 Hubungi Kami
                        </a>
                    </div>

                    <!-- Stats -->
                    <div class="grid grid-cols-3 gap-6 pt-8">
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600" data-count="1000">0</div>
                            <div class="text-sm text-gray-600 mt-1">Pelanggan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-green-500" data-count="24">0</div>
                            <div class="text-sm text-gray-600 mt-1">Jam Layanan</div>
                        </div>
                        <div class="text-center">
                            <div class="text-3xl font-bold text-blue-600" data-count="99">0</div>
                            <div class="text-sm text-gray-600 mt-1">% Puas</div>
                        </div>
                    </div>
                </div>

                <!-- Hero Image -->
                <div class="relative opacity-0 fade-in-up delay-200">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-green-400 rounded-3xl transform rotate-6"></div>
                    <div class="relative bg-white p-8 rounded-3xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1582735689369-4fe89db7114c?w=600&h=700&fit=crop" alt="Laundry Service" class="rounded-2xl w-full h-96 object-cover">
                        <div class="absolute -bottom-6 -right-6 bg-white p-6 rounded-2xl shadow-xl">
                            <div class="flex items-center space-x-3">
                                <div class="bg-green-100 p-3 rounded-full">
                                    <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-gray-900">Pickup Gratis</div>
                                    <div class="text-sm text-gray-600">Antar-Jemput</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Services Section -->
    <section id="layanan" class="py-20 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-16 opacity-0 fade-in-up">
                <h2 class="text-4xl font-bold text-gray-900 mb-4">Layanan Kami</h2>
                <p class="text-xl text-gray-600">Berbagai pilihan layanan untuk kebutuhan Anda</p>
            </div>

            <div class="grid md:grid-cols-4 gap-6">
                <!-- Service Card 1 -->
                <div class="service-card group bg-gradient-to-br from-blue-50 to-white p-6 rounded-2xl hover:shadow-xl transition-all cursor-pointer opacity-0 fade-in-up delay-100" onclick="handleServiceClick()">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-400 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Cuci Kering</h3>
                    <p class="text-gray-600 text-sm">Cuci bersih tanpa setrika</p>
                </div>

                <!-- Service Card 2 -->
                <div class="service-card group bg-gradient-to-br from-green-50 to-white p-6 rounded-2xl hover:shadow-xl transition-all cursor-pointer opacity-0 fade-in-up delay-200" onclick="handleServiceClick()">
                    <div class="bg-gradient-to-br from-green-600 to-green-400 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Cuci Setrika</h3>
                    <p class="text-gray-600 text-sm">Lengkap dengan setrika rapi</p>
                </div>

                <!-- Service Card 3 -->
                <div class="service-card group bg-gradient-to-br from-blue-50 to-white p-6 rounded-2xl hover:shadow-xl transition-all cursor-pointer opacity-0 fade-in-up delay-300" onclick="handleServiceClick()">
                    <div class="bg-gradient-to-br from-blue-600 to-blue-400 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Express</h3>
                    <p class="text-gray-600 text-sm">Selesai dalam 24 jam</p>
                </div>

                <!-- Service Card 4 -->
                <div class="service-card group bg-gradient-to-br from-green-50 to-white p-6 rounded-2xl hover:shadow-xl transition-all cursor-pointer opacity-0 fade-in-up delay-400" onclick="handleServiceClick()">
                    <div class="bg-gradient-to-br from-green-600 to-green-400 w-16 h-16 rounded-2xl flex items-center justify-center mb-4 group-hover:scale-110 transition-transform">
                        <svg class="w-8 h-8 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20 7l-8-4-8 4m16 0l-8 4m8-4v10l-8 4m0-10L4 7m8 4v10M4 7v10l8 4"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Dry Clean</h3>
                    <p class="text-gray-600 text-sm">Untuk pakaian premium</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section id="tentang" class="py-20 bg-gradient-to-br from-blue-50 via-white to-green-50">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-2 gap-12 items-center">
                <div class="opacity-0 fade-in-up">
                    <img src="https://images.unsplash.com/photo-1517677208171-0bc6725a3e60?w=600&h=600&fit=crop" alt="Modern Laundry" class="rounded-3xl shadow-2xl">
                </div>
                <div class="space-y-8 opacity-0 fade-in-up delay-200">
                    <h2 class="text-4xl font-bold text-gray-900">Kenapa Pilih Kami?</h2>
                    
                    <div class="space-y-6">
                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-100 p-3 rounded-xl flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Teknologi Modern</h3>
                                <p class="text-gray-600">Mesin cuci berteknologi tinggi untuk hasil maksimal</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-green-100 p-3 rounded-xl flex-shrink-0">
                                <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Pengerjaan Cepat</h3>
                                <p class="text-gray-600">Proses cepat tanpa mengurangi kualitas</p>
                            </div>
                        </div>

                        <div class="flex items-start space-x-4">
                            <div class="bg-blue-100 p-3 rounded-xl flex-shrink-0">
                                <svg class="w-6 h-6 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                </svg>
                            </div>
                            <div>
                                <h3 class="text-xl font-bold text-gray-900 mb-2">Terjamin Aman</h3>
                                <p class="text-gray-600">Pakaian Anda dijaga dengan sistem pelacakan</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="py-20 bg-gradient-to-r from-blue-600 to-green-500">
        <div class="container mx-auto px-6 text-center">
            <h2 class="text-4xl font-bold text-white mb-6">Siap Mencoba Layanan Kami?</h2>
            <p class="text-xl text-blue-100 mb-8 max-w-2xl mx-auto">Daftar sekarang dan dapatkan diskon 20% untuk order pertama Anda!</p>
            @auth
                <a href="{{ route('customer.dashboard') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-full font-bold hover:shadow-2xl transition-all transform hover:scale-105">
                    Mulai Order Sekarang
                </a>
            @else
                <a href="{{ route('register') }}" class="inline-block bg-white text-blue-600 px-8 py-4 rounded-full font-bold hover:shadow-2xl transition-all transform hover:scale-105">
                    Daftar Gratis
                </a>
            @endauth
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-12">
        <div class="container mx-auto px-6">
            <div class="grid md:grid-cols-4 gap-8">
                <div>
                    <div class="flex items-center space-x-3 mb-4">
                        <div class="bg-gradient-to-br from-blue-600 to-green-500 p-2 rounded-xl">
                            <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                            </svg>
                        </div>
                        <span class="text-xl font-bold">TempatCuciIbuk</span>
                    </div>
                    <p class="text-gray-400">Laundry modern untuk kehidupan yang lebih fresh</p>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Layanan</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Cuci Kering</a></li>
                        <li><a href="#" class="hover:text-white">Cuci Setrika</a></li>
                        <li><a href="#" class="hover:text-white">Express</a></li>
                        <li><a href="#" class="hover:text-white">Dry Clean</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Perusahaan</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="#" class="hover:text-white">Tentang Kami</a></li>
                        <li><a href="#" class="hover:text-white">Kontak</a></li>
                        <li><a href="#" class="hover:text-white">Karir</a></li>
                        <li><a href="#" class="hover:text-white">Blog</a></li>
                    </ul>
                </div>
                <div>
                    <h3 class="font-bold mb-4">Hubungi Kami</h3>
                    <ul class="space-y-2 text-gray-400">
                        <li>📞 0812-3456-789</li>
                        <li>📧 info@tempatcuciibuk.com</li>
                        <li>📍 Jakarta, Indonesia</li>
                    </ul>
                </div>
            </div>
            <div class="border-t border-gray-800 mt-12 pt-8 text-center text-gray-400">
                <p>&copy; {{ date('Y') }} TempatCuciIbuk. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        // Intersection Observer for fade-in animations
        const observerOptions = {
            threshold: 0.1,
            rootMargin: '0px 0px -50px 0px'
        };

        const observer = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    entry.target.style.opacity = '1';
                    observer.unobserve(entry.target);
                }
            });
        }, observerOptions);

        document.querySelectorAll('.fade-in-up').forEach(el => {
            observer.observe(el);
        });

        // Counter animation
        function animateCounter(element) {
            const target = parseInt(element.dataset.count);
            const duration = 2000;
            const step = target / (duration / 16);
            let current = 0;

            const timer = setInterval(() => {
                current += step;
                if (current >= target) {
                    element.textContent = target + (element.textContent.includes('%') ? '%' : '+');
                    clearInterval(timer);
                } else {
                    element.textContent = Math.floor(current);
                }
            }, 16);
        }

        // Start counter when visible
        const counterObserver = new IntersectionObserver((entries) => {
            entries.forEach(entry => {
                if (entry.isIntersecting) {
                    animateCounter(entry.target);
                    counterObserver.unobserve(entry.target);
                }
            });
        });

        document.querySelectorAll('[data-count]').forEach(el => {
            counterObserver.observe(el);
        });

        // Smooth scroll
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function (e) {
                e.preventDefault();
                const target = document.querySelector(this.getAttribute('href'));
                if (target) {
                    target.scrollIntoView({ behavior: 'smooth', block: 'start' });
                }
            });
        });

        // Navbar scroll effect
        window.addEventListener('scroll', () => {
            const navbar = document.getElementById('navbar');
            if (window.scrollY > 50) {
                navbar.classList.add('shadow-lg');
            } else {
                navbar.classList.remove('shadow-lg');
            }
        });

        // Mobile menu toggle
        function toggleMobileMenu() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
        }

        // Service click handler
        function handleServiceClick() {
            @auth
                window.location.href = "{{ route('customer.dashboard') }}";
            @else
                if (confirm('Silakan login atau daftar untuk mengakses layanan ini')) {
                    window.location.href = "{{ route('login') }}";
                }
            @endauth
        }

        // Add hover effect to service cards
        document.querySelectorAll('.service-card').forEach(card => {
            card.addEventListener('mouseenter', function() {
                this.style.transform = 'translateY(-8px)';
            });
            card.addEventListener('mouseleave', function() {
                this.style.transform = 'translateY(0)';
            });
        });
    </script>
</body>
</html>