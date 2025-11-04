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
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-4xl font-bold mb-2">Dashboard Customer</h1>
                        <p class="text-blue-100">Kelola pesanan laundry Anda dengan mudah</p>
                    </div>
                    <div class="hidden md:block">
                        <svg class="w-24 h-24 opacity-20" fill="currentColor" viewBox="0 0 24 24">
                            <path d="M5 3v4M3 5h4M6 17v4m-2-2h4m5-16l2.286 6.857L21 12l-5.714 2.143L13 21l-2.286-6.857L5 12l5.714-2.143L13 3z"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Active Order Section -->
    <section class="py-8 px-6">
        <div class="container mx-auto">
            <div class="bg-white rounded-2xl shadow-xl p-8 opacity-0 fade-in-up delay-100">
                <div class="flex items-center justify-between mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">📦 Status Laundry Aktif</h2>
                    <a href="{{ route('customer.order.create') }}" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-6 py-2.5 rounded-full font-semibold hover:shadow-lg transition-all">
                        + Order Baru
                    </a>
                </div>
                
                @if($activeOrder)
                    <div class="bg-gradient-to-br from-blue-50 to-green-50 rounded-xl p-6 border-2 border-blue-200">
                        <div class="grid md:grid-cols-3 gap-6">
                            <div>
                                <p class="text-sm text-gray-600 mb-1">No. Pesanan</p>
                                <p class="text-2xl font-bold text-blue-600">{{ $activeOrder->order_code }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Jenis Layanan</p>
                                <p class="text-xl font-semibold text-gray-900">{{ ucfirst($activeOrder->service_type) }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 mb-1">Status</p>
                                <div class="flex items-center space-x-2">
                                    <span class="px-4 py-2 rounded-full text-sm font-semibold 
                                        {{ $activeOrder->status == 'collected' ? 'bg-yellow-100 text-yellow-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ ucfirst(str_replace('_', ' ', $activeOrder->status)) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="mt-6 flex justify-end">
                            <a href="{{ route('customer.order.tracking', $activeOrder->id) }}" class="bg-blue-600 text-white px-6 py-3 rounded-lg font-semibold hover:bg-blue-700 transition-all flex items-center space-x-2">
                                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2"></path>
                                </svg>
                                <span>Tracking Detail</span>
                            </a>
                        </div>
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-xl">
                        <div class="text-6xl mb-4">🧺</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Order Aktif</h3>
                        <p class="text-gray-500 mb-6">Mulai order laundry pertama Anda sekarang!</p>
                        <a href="{{ route('customer.order.create') }}" class="bg-gradient-to-r from-blue-600 to-green-500 text-white px-8 py-3 rounded-full font-semibold hover:shadow-xl transition-all inline-block">
                            Buat Order Sekarang
                        </a>
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
                    <form method="GET" class="flex gap-3">
                        <select name="status" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                            <option value="">Semua Status</option>
                            <option value="collected">Collected</option>
                            <option value="in_treatment">In Treatment</option>
                            <option value="finish">Finish</option>
                        </select>
                        <input type="date" name="date" class="border border-gray-300 rounded-lg px-4 py-2 focus:ring-2 focus:ring-blue-500 focus:border-blue-500">
                        <button type="submit" class="bg-blue-600 text-white px-6 py-2 rounded-lg font-semibold hover:bg-blue-700 transition-all">
                            Filter
                        </button>
                    </form>
                </div>

                @if($orders->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gradient-to-r from-blue-50 to-green-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">No. Pesanan</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Layanan</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Status</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Tanggal</th>
                                    <th class="px-6 py-4 text-left text-sm font-bold text-gray-700">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-200">
                                @foreach($orders as $order)
                                <tr class="hover:bg-blue-50 transition-colors">
                                    <td class="px-6 py-4 font-semibold text-blue-600">{{ $order->order_code }}</td>
                                    <td class="px-6 py-4 text-gray-900">{{ ucfirst($order->service_type) }}</td>
                                    <td class="px-6 py-4">
                                        <span class="px-4 py-2 rounded-full text-sm font-semibold
                                            {{ $order->status == 'finish' ? 'bg-green-100 text-green-700' : 
                                               ($order->status == 'in_treatment' ? 'bg-blue-100 text-blue-700' : 'bg-yellow-100 text-yellow-700') }}">
                                            {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                        </span>
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $order->created_at->format('d M Y') }}</td>
                                    <td class="px-6 py-4">
                                        <a href="{{ route('customer.order.show', $order->id) }}" class="text-blue-600 hover:text-blue-800 font-semibold flex items-center space-x-1">
                                            <span>Lihat Detail</span>
                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7"></path>
                                            </svg>
                                        </a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="text-center py-12 bg-gray-50 rounded-xl">
                        <div class="text-6xl mb-4">📦</div>
                        <h3 class="text-xl font-semibold text-gray-700 mb-2">Belum Ada Riwayat Order</h3>
                        <p class="text-gray-500">Order pertama Anda akan muncul di sini</p>
                    </div>
                @endif
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
    </script>
</body>
</html>
@endsection