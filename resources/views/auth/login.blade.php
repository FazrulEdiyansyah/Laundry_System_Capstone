<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login - TempatCuciIbuk</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2563eb',
                        secondary: '#10b981',
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
    </style>
</head>
<body class="bg-gradient-to-br from-blue-50 via-white to-green-50 min-h-screen">
    <!-- Navigation -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
        <div class="container mx-auto px-6 py-4">
            <div class="flex justify-between items-center">
                <div class="flex items-center space-x-3">
                    <div class="bg-gradient-to-br from-blue-600 to-green-500 p-2.5 rounded-xl">
                        <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                    <a href="{{ url('/') }}" class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">TempatCuciIbuk</a>
                </div>
                
                <div class="flex items-center space-x-6">
                    <a href="{{ url('/') }}" class="text-gray-700 hover:text-blue-600 transition-colors font-medium">Beranda</a>
                    <a href="{{ route('register') }}" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-lg transition-all">
                        Daftar
                    </a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                <!-- Left Side - Login Form -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 opacity-0 fade-in-up">
                    <div class="text-center mb-8">
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">Selamat Datang</h1>
                        <p class="text-gray-600">Masuk ke akun TempatCuciIbuk Anda</p>
                    </div>

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <p class="text-red-700 font-semibold">{{ $errors->first() }}</p>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('login') }}" class="space-y-6">
                        @csrf
                        
                        <!-- Email Field -->
                        <div class="space-y-2">
                            <label for="email" class="block text-sm font-semibold text-gray-700">Email</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 12a4 4 0 10-8 0 4 4 0 008 0zm0 0v1.5a2.5 2.5 0 005 0V12a9 9 0 10-9 9m4.5-1.206a8.959 8.959 0 01-4.5 1.207"></path>
                                    </svg>
                                </div>
                                <input type="email" name="email" id="email" value="{{ old('email') }}" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    placeholder="nama@email.com" required autofocus>
                            </div>
                        </div>

                        <!-- Password Field -->
                        <div class="space-y-2">
                            <label for="password" class="block text-sm font-semibold text-gray-700">Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password" id="password" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    placeholder="Masukkan password" required>
                            </div>
                        </div>

                        <!-- Remember Me -->
                        <div class="flex items-center justify-between">
                            <label class="flex items-center">
                                <input type="checkbox" name="remember" class="w-4 h-4 text-blue-600 border-gray-300 rounded focus:ring-blue-500">
                                <span class="ml-2 text-sm text-gray-600">Ingat saya</span>
                            </label>
                            <a href="#" class="text-sm text-blue-600 hover:text-blue-700 font-semibold">Lupa password?</a>
                        </div>

                        <!-- Login Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-green-500 text-white py-3 rounded-lg font-semibold hover:shadow-xl transition-all transform hover:scale-105">
                            Masuk
                        </button>

                        <!-- Divider -->
                        <div class="relative my-6">
                            <div class="absolute inset-0 flex items-center">
                                <div class="w-full border-t border-gray-300"></div>
                            </div>
                            <div class="relative flex justify-center text-sm">
                                <span class="px-2 bg-white text-gray-500">atau</span>
                            </div>
                        </div>

                        <!-- Register Link -->
                        <div class="text-center">
                            <p class="text-gray-600">
                                Belum punya akun? 
                                <a href="{{ route('register') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Daftar sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>

                <!-- Right Side - Illustration -->
                <div class="relative opacity-0 fade-in-up delay-200">
                    <div class="absolute inset-0 bg-gradient-to-br from-blue-400 to-green-400 rounded-3xl transform rotate-3"></div>
                    <div class="relative bg-white p-8 rounded-3xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1558618666-5e0b85c1d4b4?w=600&h=700&fit=crop" alt="Laundry Service" class="rounded-2xl w-full h-96 object-cover">
                        
                        <!-- Feature Cards -->
                        <div class="absolute -top-6 -left-6 bg-white p-4 rounded-2xl shadow-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-900">100% Aman</div>
                                    <div class="text-xs text-gray-600">Data terlindungi</div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-2xl shadow-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-900">24/7 Service</div>
                                    <div class="text-xs text-gray-600">Layanan kapan saja</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 opacity-0 fade-in-up">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Kenapa Pilih TempatCuciIbuk?</h2>
                <p class="text-gray-600">Bergabung dengan ribuan pelanggan yang sudah merasakan kemudahan kami</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 opacity-0 fade-in-up delay-100">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Pickup Gratis</h3>
                    <p class="text-gray-600">Antar jemput gratis di area Jakarta</p>
                </div>

                <div class="text-center p-6 opacity-0 fade-in-up delay-200">
                    <div class="bg-gradient-to-br from-green-100 to-green-50 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Hasil Terjamin</h3>
                    <p class="text-gray-600">Garansi 100% puas atau gratis cuci ulang</p>
                </div>

                <div class="text-center p-6 opacity-0 fade-in-up delay-300">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Proses Cepat</h3>
                    <p class="text-gray-600">Selesai dalam 24-48 jam</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} TempatCuciIbuk. All rights reserved.</p>
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

        // Form focus effects
        const inputs = document.querySelectorAll('input[type="email"], input[type="password"]');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });
    </script>
</body>
</html>