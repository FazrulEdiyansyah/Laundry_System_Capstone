<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Daftar - TempatCuciIbuk</title>
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
                    <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Masuk</a>
                </div>
            </div>
        </div>
    </nav>

    <!-- Register Section -->
    <section class="pt-32 pb-20 px-6">
        <div class="container mx-auto">
            <div class="grid md:grid-cols-2 gap-12 items-center max-w-6xl mx-auto">
                <!-- Left Side - Illustration -->
                <div class="relative opacity-0 fade-in-up order-2 md:order-1">
                    <div class="absolute inset-0 bg-gradient-to-br from-green-400 to-blue-400 rounded-3xl transform -rotate-3"></div>
                    <div class="relative bg-white p-8 rounded-3xl shadow-2xl">
                        <img src="https://images.unsplash.com/photo-1556909114-f6e7ad7d3136?w=600&h=700&fit=crop" alt="Join Laundry Service" class="rounded-2xl w-full h-96 object-cover">
                        
                        <!-- Feature Cards -->
                        <div class="absolute -top-6 -left-6 bg-white p-4 rounded-2xl shadow-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-green-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-900">Diskon 20%</div>
                                    <div class="text-xs text-gray-600">Member baru</div>
                                </div>
                            </div>
                        </div>

                        <div class="absolute -bottom-6 -right-6 bg-white p-4 rounded-2xl shadow-lg">
                            <div class="flex items-center space-x-3">
                                <div class="bg-blue-100 p-2 rounded-full">
                                    <svg class="w-5 h-5 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"></path>
                                    </svg>
                                </div>
                                <div>
                                    <div class="font-bold text-sm text-gray-900">1000+</div>
                                    <div class="text-xs text-gray-600">Member aktif</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Right Side - Register Form -->
                <div class="bg-white rounded-3xl shadow-2xl p-8 opacity-0 fade-in-up delay-200 order-1 md:order-2">
                    <div class="text-center mb-8">
                        <h1 class="text-4xl font-bold text-gray-900 mb-2">Bergabung Sekarang</h1>
                        <p class="text-gray-600">Daftar dan nikmati kemudahan laundry modern</p>
                    </div>

                    @if($errors->any())
                        <div class="mb-6 bg-red-50 border border-red-200 rounded-lg p-4">
                            <div class="flex items-center space-x-2">
                                <svg class="w-5 h-5 text-red-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4m0 4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                </svg>
                                <div>
                                    @foreach($errors->all() as $error)
                                        <p class="text-red-700 text-sm">{{ $error }}</p>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('register') }}" class="space-y-5">
                        @csrf
                        
                        <!-- Name Field -->
                        <div class="space-y-2">
                            <label for="name" class="block text-sm font-semibold text-gray-700">Nama Lengkap</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                                    </svg>
                                </div>
                                <input type="text" name="name" id="name" value="{{ old('name') }}" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    placeholder="Masukkan nama lengkap" required autofocus>
                            </div>
                        </div>

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
                                    placeholder="nama@email.com" required>
                            </div>
                        </div>

                        <!-- WhatsApp Field -->
                        <div class="space-y-2">
                            <label for="whatsapp" class="block text-sm font-semibold text-gray-700">Nomor WhatsApp</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 18h.01M8 21h8a2 2 0 002-2V5a2 2 0 00-2-2H8a2 2 0 00-2 2v14a2 2 0 002 2z"></path>
                                    </svg>
                                </div>
                                <input type="tel" name="whatsapp" id="whatsapp" value="{{ old('whatsapp') }}" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    placeholder="08123456789" required>
                            </div>
                        </div>

                        <!-- Address Field -->
                        <div class="space-y-2">
                            <label for="address" class="block text-sm font-semibold text-gray-700">Alamat</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 pt-3 pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z"></path>
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 11a3 3 0 11-6 0 3 3 0 016 0z"></path>
                                    </svg>
                                </div>
                                <textarea name="address" id="address" rows="3" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all resize-none" 
                                    placeholder="Masukkan alamat lengkap" required>{{ old('address') }}</textarea>
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
                                    placeholder="Minimal 6 karakter" required>
                            </div>
                        </div>

                        <!-- Confirm Password Field -->
                        <div class="space-y-2">
                            <label for="password_confirmation" class="block text-sm font-semibold text-gray-700">Konfirmasi Password</label>
                            <div class="relative">
                                <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                    <svg class="w-5 h-5 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                                    </svg>
                                </div>
                                <input type="password" name="password_confirmation" id="password_confirmation" 
                                    class="w-full pl-10 pr-4 py-3 border border-gray-300 rounded-lg focus:ring-2 focus:ring-blue-500 focus:border-blue-500 transition-all" 
                                    placeholder="Ulangi password" required>
                            </div>
                        </div>

                        <!-- Terms & Conditions -->
                        <div class="flex items-start space-x-3">
                            <input type="checkbox" id="terms" required class="w-5 h-5 text-blue-600 border-gray-300 rounded focus:ring-blue-500 mt-1">
                            <label for="terms" class="text-sm text-gray-600">
                                Saya setuju dengan <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Syarat & Ketentuan</a> 
                                dan <a href="#" class="text-blue-600 hover:text-blue-700 font-semibold">Kebijakan Privasi</a>
                            </label>
                        </div>

                        <!-- Register Button -->
                        <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-green-500 text-white py-3 rounded-lg font-semibold hover:shadow-xl transition-all transform hover:scale-105">
                            Daftar Sekarang
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

                        <!-- Login Link -->
                        <div class="text-center">
                            <p class="text-gray-600">
                                Sudah punya akun? 
                                <a href="{{ route('login') }}" class="text-blue-600 hover:text-blue-700 font-semibold">Masuk sekarang</a>
                            </p>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Benefits Section -->
    <section class="py-16 bg-white">
        <div class="container mx-auto px-6">
            <div class="text-center mb-12 opacity-0 fade-in-up">
                <h2 class="text-3xl font-bold text-gray-900 mb-4">Keuntungan Menjadi Member</h2>
                <p class="text-gray-600">Dapatkan berbagai benefit eksklusif sebagai member TempatCuciIbuk</p>
            </div>
            
            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center p-6 opacity-0 fade-in-up delay-100">
                    <div class="bg-gradient-to-br from-green-100 to-green-50 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8c-1.657 0-3 .895-3 2s1.343 2 3 2 3 .895 3 2-1.343 2-3 2m0-8c1.11 0 2.08.402 2.599 1M12 8V7m0 1v8m0 0v1m0-1c-1.11 0-2.08-.402-2.599-1"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Diskon 20%</h3>
                    <p class="text-gray-600">Diskon khusus untuk order pertama member baru</p>
                </div>

                <div class="text-center p-6 opacity-0 fade-in-up delay-200">
                    <div class="bg-gradient-to-br from-blue-100 to-blue-50 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Prioritas Pickup</h3>
                    <p class="text-gray-600">Antar jemput didahulukan untuk member</p>
                </div>

                <div class="text-center p-6 opacity-0 fade-in-up delay-300">
                    <div class="bg-gradient-to-br from-green-100 to-green-50 w-16 h-16 rounded-2xl mx-auto mb-4 flex items-center justify-center">
                        <svg class="w-8 h-8 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                        </svg>
                    </div>
                    <h3 class="text-xl font-bold text-gray-900 mb-2">Point Reward</h3>
                    <p class="text-gray-600">Kumpulkan poin setiap order untuk reward menarik</p>
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
        const inputs = document.querySelectorAll('input, textarea');
        inputs.forEach(input => {
            input.addEventListener('focus', function() {
                this.parentElement.style.transform = 'scale(1.02)';
            });
            
            input.addEventListener('blur', function() {
                this.parentElement.style.transform = 'scale(1)';
            });
        });

        // Password confirmation validation
        const password = document.getElementById('password');
        const confirmPassword = document.getElementById('password_confirmation');

        function validatePassword() {
            if (password.value !== confirmPassword.value) {
                confirmPassword.setCustomValidity("Password tidak cocok");
            } else {
                confirmPassword.setCustomValidity('');
            }
        }

        password.addEventListener('change', validatePassword);
        confirmPassword.addEventListener('keyup', validatePassword);

        // WhatsApp number formatting
        const whatsappInput = document.getElementById('whatsapp');
        whatsappInput.addEventListener('input', function() {
            let value = this.value.replace(/\D/g, '');
            if (value.startsWith('0')) {
                value = '62' + value.substring(1);
            } else if (!value.startsWith('62')) {
                value = '62' + value;
            }
            this.value = value;
        });
    </script>
</body>
</html>