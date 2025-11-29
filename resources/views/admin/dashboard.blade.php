@extends('layouts.app')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Admin Dashboard - TempatCuciIbuk</title>
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
            from { opacity: 0; transform: translateY(24px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up {
            animation: fadeInUp 0.6s ease-out forwards;
        }
    </style>
</head>
<body class="bg-[#F7F8FA] min-h-screen">
    <!-- Top nav (consistent with customer) -->
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-blue-600 to-green-500 p-2.5 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7"></path>
                    </svg>
                </div>
                <span class="text-2xl font-bold bg-gradient-to-r from-blue-600 to-green-500 bg-clip-text text-transparent">TempatCuciIbuk</span>
            </div>

            <div class="flex items-center gap-6">
                <span class="text-gray-700">Halo, <span class="font-semibold text-blue-600">{{ Auth::user()->name }}</span></span>
                <form action="{{ route('logout') }}" method="POST" class="inline">
                    @csrf
                    <button type="submit" class="text-red-600 hover:text-red-700 font-semibold">Logout</button>
                </form>
            </div>
        </div>
    </nav>

    <main class="pt-28 pb-20">
        <div class="max-w-6xl mx-auto px-6">

            <!-- Header card (gradient) -->
            <div
                class="rounded-[32px] p-10 mb-10 shadow-2xl fade-in-up"
                style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%); animation-delay:0.05s"
            >
                <div class="flex flex-col md:flex-row md:items-center md:justify-between gap-5">
                    <div>
                        <h1 class="text-3xl md:text-4xl font-bold text-white">Dashboard Admin</h1>
                        <p class="text-white/80 mt-2 text-base">
                            Pantau pesanan, status, dan aktivitas laundry dalam satu tampilan.
                        </p>
                    </div>
                    <div class="flex items-center gap-3">
                        <a href="{{ route('admin.dashboard') }}"
                           class="inline-flex items-center gap-2 px-6 py-3.5 rounded-full font-semibold text-white shadow-lg"
                           style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%);">
                            📊 Semua Ringkasan
                        </a>
                    </div>
                </div>
            </div>

            <!-- Summary cards -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-4 gap-7 mb-10">

                <!-- Total Order -->
                <div class="bg-white rounded-3xl border border-gray-200 px-7 py-8 shadow-sm fade-in-up"
                    style="animation-delay:0.10s">
                    <div class="flex flex-col space-y-1">
                        <p class="text-sm font-medium text-gray-500">Total Order</p>
                        <p class="text-4xl font-bold text-gray-900 leading-tight">
                            {{ $summary['total'] ?? 0 }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Semua pesanan yang tercatat
                        </p>
                    </div>
                </div>

                <!-- Order Baru -->
                <div class="bg-white rounded-3xl border border-gray-200 px-7 py-8 shadow-sm fade-in-up"
                    style="animation-delay:0.15s">
                    <div class="flex flex-col space-y-1">
                        <p class="text-sm font-medium text-gray-500">Order Baru</p>
                        <p class="text-4xl font-bold text-gray-900 leading-tight">
                            {{ $summary['pending'] ?? 0 }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Menunggu diproses
                        </p>
                    </div>
                </div>

                <!-- Sedang Diproses -->
                <div class="bg-white rounded-3xl border border-gray-200 px-7 py-8 shadow-sm fade-in-up"
                    style="animation-delay:0.20s">
                    <div class="flex flex-col space-y-1">
                        <p class="text-sm font-medium text-gray-500">Sedang Diproses</p>
                        <p class="text-4xl font-bold text-gray-900 leading-tight">
                            {{ $summary['proses'] ?? 0 }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Dalam tahap pencucian / pengeringan
                        </p>
                    </div>
                </div>

                <!-- Selesai / Diambil -->
                <div class="bg-white rounded-3xl border border-gray-200 px-7 py-8 shadow-sm fade-in-up"
                    style="animation-delay:0.25s">
                    <div class="flex flex-col space-y-1">
                        <p class="text-sm font-medium text-gray-500">Selesai / Diambil</p>
                        <p class="text-4xl font-bold text-gray-900 leading-tight">
                            {{ ($summary['selesai'] ?? 0) + ($summary['diambil'] ?? 0) }}
                        </p>
                        <p class="text-xs text-gray-400 mt-1">
                            Pesanan yang sudah beres
                        </p>
                    </div>
                </div>
            </div>

            <!-- Filters -->
            <div class="mb-8 flex flex-wrap gap-3 fade-in-up" style="animation-delay:0.30s">
                <a href="{{ route('admin.dashboard', ['status' => 'all']) }}"
                   class="px-5 py-2.5 rounded-full text-sm font-semibold transition
                          {{ !$status || $status === 'all'
                                ? 'bg-gradient-to-r from-blue-600 to-green-500 text-white shadow-sm'
                                : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50' }}">
                    Semua
                </a>

                @foreach($availableStatuses as $key => $label)
                    <a href="{{ route('admin.dashboard', ['status' => $key]) }}"
                       class="px-5 py-2.5 rounded-full text-sm font-semibold transition
                              {{ ($status === $key)
                                    ? 'bg-gradient-to-r from-blue-600 to-green-500 text-white shadow-sm'
                                    : 'bg-white text-gray-700 border border-gray-200 hover:bg-gray-50' }}">
                        {{ $label }}
                    </a>
                @endforeach
            </div>

            <!-- Orders list card -->
            <div class="bg-white rounded-[32px] border border-gray-200 shadow-md overflow-hidden fade-in-up"
                 style="animation-delay:0.35s">
                <div class="p-8">
                    <div class="flex items-center justify-between mb-6">
                        <h2 class="text-xl font-semibold text-gray-900 flex items-center gap-2">
                            📦 Daftar Order
                        </h2>
                        <p class="text-sm text-gray-500">{{ $orders->total() ?? 0 }} pesanan</p>
                    </div>

                    <div class="overflow-x-auto">
                        <table class="w-full text-left">
                            <thead class="text-xs font-semibold text-gray-500 uppercase tracking-wide border-b">
                                <tr>
                                    <th class="py-3.5 px-4">Kode</th>
                                    <th class="py-3.5 px-4">Pelanggan</th>
                                    <th class="py-3.5 px-4">Layanan</th>
                                    <th class="py-3.5 px-4">Berat</th>
                                    <th class="py-3.5 px-4">Total</th>
                                    <th class="py-3.5 px-4">Status</th>
                                    <th class="py-3.5 px-4">Aksi</th>
                                </tr>
                            </thead>
                            <tbody class="text-sm text-gray-800">
                                @forelse($orders as $order)
                                    <tr class="border-b last:border-0 hover:bg-gray-50 transition">
                                        <td class="py-3.5 px-4 font-semibold">{{ $order->order_code }}</td>
                                        <td class="py-3.5 px-4">
                                            <div class="flex flex-col">
                                                <span class="font-medium">{{ $order->user->name ?? '-' }}</span>
                                                <span class="text-xs text-gray-500">{{ $order->user->email ?? '' }}</span>
                                            </div>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            {{ ucfirst(str_replace('_',' ', $order->service_type)) }}
                                        </td>
                                        <td class="py-3.5 px-4">{{ $order->weight }} kg</td>
                                        <td class="py-3.5 px-4">
                                            Rp {{ number_format($order->total_price ?? 0,0,',','.') }}
                                        </td>
                                        <td class="py-3.5 px-4">
                                            @php
                                                $map = [
                                                    'baru'    => 'bg-yellow-100 text-yellow-800',
                                                    'proses'  => 'bg-orange-100 text-orange-800',
                                                    'selesai' => 'bg-green-100 text-green-800',
                                                    'diambil' => 'bg-purple-100 text-purple-800',
                                                ];
                                            @endphp
                                            <span class="px-3 py-1.5 rounded-full text-xs font-semibold {{ $map[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                                {{ $availableStatuses[$order->status] ?? ucfirst($order->status) }}
                                            </span>
                                        </td>
                                        <td class="py-3.5 px-4">
                                            <a href="{{ route('admin.orders.show', $order->id) }}"
                                               class="inline-flex items-center px-4 py-1.5 rounded-full text-xs font-semibold text-white shadow-sm"
                                               style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%);">
                                                Detail
                                            </a>
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="7" class="py-10 text-center text-gray-500 text-sm">
                                            Tidak ada order ditemukan
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <div class="mt-6">
                        {{ $orders->withQueryString()->links() }}
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
@endsection
