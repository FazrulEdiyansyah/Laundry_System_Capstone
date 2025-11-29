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
            from { opacity: 0; transform: translateY(30px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.6s ease-out forwards; }
        .delay-100 { animation-delay: 0.1s; }
        .delay-200 { animation-delay: 0.2s; }
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
    <section class="pt-32 pb-6 px-6">
        <div class="container mx-auto">
            <div class="bg-gradient-to-r from-blue-600 to-green-500 rounded-3xl p-8 text-white shadow-2xl opacity-0 fade-in-up">
                <div class="flex flex-col md:flex-row justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Dashboard Customer</h1>
                        <p class="text-blue-100">Kelola pesanan laundry Anda dengan mudah</p>
                    </div>
                    <div class="mt-4 md:mt-0">
                        <button onclick="openPickupModal()" class="bg-white text-blue-600 px-6 py-2 rounded-full font-bold hover:shadow-2xl transition-all transform hover:scale-105 inline-flex items-center space-x-2">
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

    <!-- Active Orders List -->
    <section class="py-6 px-6">
        <div class="container mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-6 opacity-0 fade-in-up delay-100">
                <div class="flex items-center justify-between mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">📦 Pesanan Aktif</h2>
                    <span class="text-sm text-gray-600">{{ $activeOrders->count() }} pesanan</span>
                </div>

                @if($activeOrders->count() > 0)
                    <div class="space-y-4">
                        @foreach($activeOrders as $order)
                            <div class="bg-white rounded-xl border border-gray-200 p-4 flex items-center justify-between gap-4 hover:-translate-y-1 transform transition shadow-sm">
                                <div class="flex-1 min-w-0">
                                    <p class="text-sm text-gray-500">Order Code</p>
                                    <p class="text-lg font-semibold text-blue-600 mb-1">{{ $order->order_code }}</p>

                                    <div class="flex flex-wrap text-sm text-gray-600 gap-4">
                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/></svg>
                                            <span>{{ $order->service_type == 'cuci_setrika' ? 'Cuci + Setrika' : 'Setrika Lipat' }}</span>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3"/></svg>
                                            <span>ETA: {{ $order->duration ?? '3' }} hari</span>
                                        </div>

                                        <div class="flex items-center gap-2">
                                            <svg class="w-4 h-4 text-gray-400" fill="none" stroke="currentColor" viewBox="0 0 24 24"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"/></svg>
                                            <span>
                                                <span class="inline-block px-3 py-1 rounded-full text-xs font-semibold
                                                {{ $order->status == 'pending' ? 'bg-yellow-100 text-yellow-700' :
                                                   ($order->status == 'collected' ? 'bg-blue-100 text-blue-700' :
                                                   ($order->status == 'in_treatment' ? 'bg-purple-100 text-purple-700' : 'bg-green-100 text-green-700')) }}">
                                                    @if($order->status == 'pending') Waiting PickUp
                                                    @elseif($order->status == 'collected') Collected
                                                    @elseif($order->status == 'in_treatment') In Treatment
                                                    @elseif($order->status == 'finish') Finish
                                                    @else {{ ucfirst(str_replace('_',' ',$order->status)) }} @endif
                                                </span>
                                            </span>
                                        </div>
                                    </div>
                                </div>

                                <div class="flex-shrink-0">
                                    <a href="{{ route('customer.orders.show', $order->id) }}" class="inline-flex items-center px-4 py-2 rounded-full font-semibold text-white"
                                       style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%);">
                                        Lihat Detail
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-xl">
                        <div class="text-6xl mb-4">🧺</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Pesanan Aktif</h3>
                        <p class="text-gray-500 mb-6">Mulai request pick-up laundry pertama Anda!</p>
                        <button onclick="openPickupModal()" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-2 rounded-full font-semibold hover:shadow-xl transition-all">
                            Request Pick-Up Sekarang
                        </button>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Order History Section (ringkas) -->
    <section class="py-6 px-6 pb-20">
        <div class="container mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-6 opacity-0 fade-in-up delay-200">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-2xl font-bold text-gray-900">📋 Riwayat Order</h2>
                </div>

                @if($orderHistory->count() > 0)
                    <div class="space-y-3">
                        @foreach($orderHistory as $order)
                            <div class="border border-gray-200 rounded-lg p-3 flex items-center justify-between hover:-translate-y-1 transform transition">
                                <div>
                                    <p class="font-semibold text-gray-800">{{ $order->order_code }}</p>
                                    <p class="text-sm text-gray-600">{{ $order->service_type == 'cuci_setrika' ? 'Cuci + Setrika' : 'Setrika Lipat' }} • {{ $order->created_at->format('d M Y') }}</p>
                                </div>
                                <a href="{{ route('customer.orders.show', $order->id) }}" class="text-blue-600 font-semibold">Detail →</a>
                            </div>
                        @endforeach
                    </div>
                @else
                    <div class="text-center py-8 bg-gray-50 rounded-xl">
                        <p class="text-gray-500">Order yang sudah selesai akan muncul di sini</p>
                    </div>
                @endif
            </div>
        </div>
    </section>

    <!-- Pickup Modal (existing) -->
    <div id="pickupModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white rounded-2xl shadow-2xl w-full max-w-2xl p-8 relative max-h-[90vh] overflow-y-auto">
            <button onclick="closePickupModal()" class="absolute top-4 right-4 text-gray-400 hover:text-red-500 text-3xl font-bold">&times;</button>
            
            <h2 class="text-3xl font-bold mb-6 text-gray-900 text-center">🚚 Request Pick-Up</h2>
            <!-- form tetap seperti sebelumnya (tidak diubah) -->
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
                </div>

                <!-- Submit Button -->
                <button type="submit" class="w-full bg-gradient-to-r from-blue-600 to-green-500 text-white py-3 rounded-lg font-bold hover:shadow-xl transition-all">
                    📦 Submit Request Pick-Up
                </button>
            </form>
        </div>
    </div>

    <script>
        function openPickupModal(){ document.getElementById('pickupModal').classList.remove('hidden'); }
        function closePickupModal(){ document.getElementById('pickupModal').classList.add('hidden'); }
        document.getElementById('pickupModal').addEventListener('click', function(e){ if(e.target===this) closePickupModal(); });

        const observerOptions = { threshold: 0.1, rootMargin: '0px 0px -50px 0px' };
        const observer = new IntersectionObserver((entries)=>{ entries.forEach(entry=>{ if(entry.isIntersecting){ entry.target.style.opacity='1'; observer.unobserve(entry.target); } }); }, observerOptions);
        document.querySelectorAll('.fade-in-up').forEach(el=>observer.observe(el));
    </script>
</body>
</html>
@endsection