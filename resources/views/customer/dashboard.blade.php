@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dashboard - TempatCuciIbuk</title>
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
        .delay-400 { animation-delay: 0.4s; }
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
                    <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">TempatCuciIbuk</span>
                </div>
                
                <div class="flex items-center space-x-6">
                    <span class="text-gray-700">Halo, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span></span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Logout</button>
                    </form>
                </div>
            </div>
        </div>
    </nav>

    <!-- Hero Section -->
    <section class="pt-32 pb-12 px-6">
        <div class="container mx-auto">
            <div class="bg-gradient-to-r from-blue-600 to-green-500 rounded-3xl p-8 text-white shadow-2xl opacity-0 fade-in-up">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Dashboard Customer</h1>
                        <p class="text-blue-100">Kelola pesanan laundry Anda dengan mudah</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button onclick="openPickupModal()" class="bg-white text-blue-600 px-8 py-3 rounded-full font-bold hover:shadow-2xl transition-all transform hover:scale-105 inline-flex items-center space-x-2">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                            </svg>
                            <span>Request Pick-Up</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Active Orders Section -->
    <section class="py-8 px-6">
        <div class="container mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 opacity-0 fade-in-up delay-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">📦 Pesanan Aktif</h2>
                    <span class="text-sm text-gray-600">{{ $activeOrders->count() }} pesanan</span>
                </div>
                
                @if($activeOrders->count() > 0)
                    <div class="grid md:grid-cols-{{ $activeOrders->count() > 2 ? '3' : $activeOrders->count() }} gap-6">
                        @foreach($activeOrders as $order)
                            <div class="bg-gradient-to-br from-blue-50 to-green-50 rounded-xl p-6 border-2 border-blue-200 hover:shadow-lg transition-all">
                                <div class="flex justify-between items-start mb-4">
                                    <div>
                                        <p class="text-sm text-gray-600 mb-1">Order Code</p>
                                        <p class="text-2xl font-bold text-blue-600">{{ $order->order_code }}</p>
                                    </div>
                                    <div class="bg-white p-2 rounded-lg">
                                        <svg class="w-12 h-12" viewBox="0 0 100 100">
                                            <!-- QR Code Placeholder -->
                                            <rect width="100" height="100" fill="#fff"/>
                                            <text x="50" y="50" text-anchor="middle" fill="#2563eb" font-size="12">QR</text>
                                        </svg>
                                    </div>
                                </div>

                                <div class="space-y-3 mb-4">
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 10v-5a1 1 0 011-1h2a1 1 0 011 1v5m-4 0h4"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700">
                                            <strong>Service:</strong> 
                                            {{ $order->service_type == 'cuci_setrika' ? 'Cuci + Setrika (Rp 7.000/Kg)' : 'Setrika Lipat (Rp 4.500/Kg)' }}
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700">
                                            <strong>ETA:</strong> 
                                            {{ $order->duration ?? '3' }} hari 
                                            @if(($order->duration ?? 3) < 3)
                                                <span class="text-orange-600">(+Rp {{ ($order->duration == 2 ? '1.000' : '2.000') }}/Kg)</span>
                                            @endif
                                        </span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700"><strong>Fragrance:</strong> {{ $order->fragrance ?? 'Fresh Bamboo 🎋' }}</span>
                                    </div>
                                    <div class="flex items-center space-x-2">
                                        <svg class="w-5 h-5 text-gray-500" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 6l3 1m0 0l-3 9a5.002 5.002 0 006.001 0M6 7l3 9M6 7l6-2m6 2l3-1m-3 1l-3 9a5.002 5.002 0 006.001 0M18 7l3 9m-3-9l-6-2m0-2v2m0 16V5m0 16H9m3 0h3"></path>
                                        </svg>
                                        <span class="text-sm text-gray-700"><strong>Berat:</strong> {{ $order->weight ?? '0' }} Kg</span>
                                    </div>
                                </div>

                                <div class="mb-4">
                                    <p class="text-sm text-gray-600 mb-2">Status</p>
                                    <span class="inline-block px-4 py-2 rounded-full text-sm font-semibold
                                        {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' : 
                                           ($order->status == 'collected' ? 'bg-blue-100 text-blue-700' : 'bg-purple-100 text-purple-700') }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </div>

                                <a href="{{ route('customer.order.tracking', $order->id) }}" class="w-full bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-3 rounded-lg font-semibold hover:shadow-lg transition-all flex items-center justify-center space-x-2">
                                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 19v-6a2 2 0 00-2-2H5a2 2 0 00-2 2v6a2 2 0 002 2h2a2 2 0 002-2zm0 0V9a2 2 0 012-2h2a2 2 0 012 2v10m-6 0a2 2 0 002 2h2a2 2 0 002-2m0 0V5a2 2 0 012-2h2a2 2 0 012 2v14a2 2 0 01-2 2h-2a2 2 0 01-2-2z"></path>
                                    </svg>
                                    <span>Track Progress</span>
                                </a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-16 bg-gray-50 rounded-xl">
                        <div class="text-6xl mb-4">🧺</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Pesanan Aktif</h3>
                        <p class="text-gray-500 mb-6">Mulai request pick-up laundry pertama Anda!</p>
                        <button onclick="openPickupModal()" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-xl transition-all inline-block">
                            Request Pick-Up Sekarang
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Order History Section -->
    <section class="py-8 px-6 pb-20">
        <div class="container mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 opacity-0 fade-in-up delay-200">
                <div class="flex justify-between items-center mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">📋 Riwayat Order</h2>
                </div>

                @if($orderHistory->count() > 0)
                    <div class="space-y-4">
                        @foreach($orderHistory as $order)
                            <div class="border border-gray-200 rounded-lg p-4 hover:shadow-md transition-all">
                                <div class="flex justify-between items-center">
                                    <div class="flex items-center space-x-4">
                                        <div class="bg-green-100 p-3 rounded-lg">
                                            <svg class="w-6 h-6 text-green-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                                            </svg>
                                        </div>
                                        <div>
                                            <p class="font-semibold text-gray-900">{{ $order->order_code }}</p>
                                            <p class="text-sm text-gray-600">
                                                {{ $order->service_type == 'cuci_setrika' ? 'Cuci + Setrika' : 'Setrika Lipat' }} • 
                                                {{ $order->fragrance ?? 'Fresh Bamboo 🎋' }} • 
                                                {{ $order->created_at->format('d M Y') }}
                                            </p>
                                        </div>
                                    </div>
                                    <div class="flex items-center space-x-4">
                                        <span class="px-4 py-2 rounded-full text-sm font-semibold bg-green-100 text-green-700">
                                            Selesai
                                        </span>
                                        <a href="{{ route('customer.order.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold">
                                            Detail →
                                        </a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-xl">
                        <div class="text-5xl mb-4">📦</div>
                        <h3 class="text-lg font-semibold text-gray-700 mb-2">Belum Ada Riwayat Order</h3>
                        <p class="text-gray-500">Order yang sudah selesai akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Pickup Modal -->
    <div id="pickupModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-8 relative max-h-[90vh] overflow-y-auto">
            <button onclick="closePickupModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-3xl font-bold">&times;</button>
            
            <h2 class="text-3xl font-bold mb-6 text-gray-900 text-center">🚚 Request Pick-Up</h2>
            
            <form method="POST" action="{{ route('customer.order.store') }}" class="space-y-6">
                @csrf
                
                <!-- Service Type -->
                <div>
                    <label class="block font-semibold mb-3 text-gray-700">Pilih Layanan</label>
                    <div class="grid grid-cols-2 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="service_type" value="cuci_setrika" class="peer sr-only" checked>
                            <div class="border-2 border-gray-300 peer-checked:border-blue-600 peer-checked:bg-blue-50 rounded-lg p-4 transition-all">
                                <div class="font-bold text-gray-900">Cuci + Setrika</div>
                                <div class="text-sm text-gray-600 mt-1">Rp 7.000/kg</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="service_type" value="setrika_lipat" class="peer sr-only">
                            <div class="border-2 border-gray-300 peer-checked:border-green-600 peer-checked:bg-green-50 rounded-lg p-4 transition-all">
                                <div class="font-bold text-gray-900">Setrika Lipat</div>
                                <div class="text-sm text-gray-600 mt-1">Rp 4.500/kg</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Durasi / ETA -->
                <div>
                    <label class="block font-semibold mb-3 text-gray-700">Durasi / ETA</label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="duration" value="3" class="peer sr-only" checked>
                            <div class="border-2 border-gray-300 peer-checked:border-blue-600 peer-checked:bg-blue-50 rounded-lg p-4 text-center transition-all">
                                <div class="font-bold text-gray-900">3 hari</div>
                                <div class="text-xs text-green-600 mt-1">Gratis</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="duration" value="2" class="peer sr-only">
                            <div class="border-2 border-gray-300 peer-checked:border-orange-600 peer-checked:bg-orange-50 rounded-lg p-4 text-center transition-all">
                                <div class="font-bold text-gray-900">2 hari</div>
                                <div class="text-xs text-orange-600 mt-1">+Rp 1.000/kg</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="duration" value="1" class="peer sr-only">
                            <div class="border-2 border-gray-300 peer-checked:border-red-600 peer-checked:bg-red-50 rounded-lg p-4 text-center transition-all">
                                <div class="font-bold text-gray-900">1 hari</div>
                                <div class="text-xs text-red-600 mt-1">+Rp 2.000/kg</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- Fragrance -->
                <div>
                    <label class="block font-semibold mb-3 text-gray-700">Pewangi (Gratis)</label>
                    <div class="grid grid-cols-3 gap-4">
                        <label class="relative cursor-pointer">
                            <input type="radio" name="fragrance" value="Sakura Blossom" class="peer sr-only" checked>
                            <div class="border-2 border-gray-300 peer-checked:border-pink-600 peer-checked:bg-pink-50 rounded-lg p-4 text-center transition-all">
                                <div class="text-2xl mb-1">🌸</div>
                                <div class="text-sm font-semibold text-gray-900">Sakura Blossom</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="fragrance" value="Fresh Bamboo" class="peer sr-only">
                            <div class="border-2 border-gray-300 peer-checked:border-green-600 peer-checked:bg-green-50 rounded-lg p-4 text-center transition-all">
                                <div class="text-2xl mb-1">🎋</div>
                                <div class="text-sm font-semibold text-gray-900">Fresh Bamboo</div>
                            </div>
                        </label>
                        <label class="relative cursor-pointer">
                            <input type="radio" name="fragrance" value="Morning Mist" class="peer sr-only">
                            <div class="border-2 border-gray-300 peer-checked:border-blue-600 peer-checked:bg-blue-50 rounded-lg p-4 text-center transition-all">
                                <div class="text-2xl mb-1">🌫️</div>
                                <div class="text-sm font-semibold text-gray-900">Morning Mist</div>
                            </div>
                        </label>
                    </div>
                </div>

                <!-- WhatsApp -->
                <div>
                    <label for="whatsapp" class="block font-semibold mb-2 text-gray-700">Nomor WhatsApp</label>
                    <input type="text" name="whatsapp" id="whatsapp" value="{{ Auth::user()->whatsapp }}" 
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-blue-600 focus:outline-none transition-all" 
                        required>
                </div>

                <!-- Alamat -->
                <div>
                    <label for="address" class="block font-semibold mb-2 text-gray-700">Alamat Pickup</label>
                    <textarea name="address" id="address" rows="3" 
                        class="w-full border-2 border-gray-300 rounded-lg px-4 py-3 focus:border-blue-600 focus:outline-none transition-all" 
                        required>{{ Auth::user()->address }}</textarea>
                    <span class="text-xs text-gray-500 mt-1 block">Ubah alamat jika ingin pickup di lokasi lain</span>
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-green-500 text-white py-4 rounded-lg font-bold text-lg hover:shadow-xl transition-all transform hover:scale-105">
                    📦 Submit Request Pick-Up
                </button>
            </form>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} TempatCuciIbuk. All rights reserved.</p>
        </div>
    </footer>

    <script>
        // Modal Functions
        function openPickupModal() {
            document.getElementById('pickupModal').classList.remove('hidden');
        }
        
        function closePickupModal() {
            document.getElementById('pickupModal').classList.add('hidden');
        }

        // Close modal when clicking outside
        document.getElementById('pickupModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closePickupModal();
            }
        });

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
    </script>
</body>
</html>
@endsection