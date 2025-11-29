@extends('layouts.app')

@section('title', 'Detail Order')

@section('content')
<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Detail Order - {{ $order->order_code }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: '#2E8FFF',
                        secondary: '#32D98D'
                    }
                }
            }
        }
    </script>
    <style>
        @keyframes fadeInUp {
            from { opacity: 0; transform: translateY(22px); }
            to   { opacity: 1; transform: translateY(0); }
        }
        .fade-in-up { animation: fadeInUp 0.55s ease-out forwards; }
    </style>
</head>
<body class="bg-[#F7F8FA] min-h-screen">
    <nav class="fixed top-0 w-full bg-white/80 backdrop-blur-md shadow-sm z-50">
        <div class="container mx-auto px-6 py-4 flex items-center justify-between">
            <div class="flex items-center gap-3">
                <div class="bg-gradient-to-br from-blue-600 to-green-500 p-2.5 rounded-xl">
                    <svg class="w-6 h-6 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 7h18M3 12h18M3 17h18"/>
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

    <main class="pt-28 pb-16">
        <div class="max-w-6xl mx-auto px-6">

            <!-- Header -->
            <div class="rounded-3xl p-8 mb-8 shadow-2xl fade-in-up" style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%);">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white">Detail Order</h1>
                    <p class="text-white/80 mt-1">Informasi pesanan — kode <span class="font-semibold">{{ $order->order_code }}</span></p>
                </div>
            </div>

            <!-- Content grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Customer card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm fade-in-up hover:-translate-y-1 transform transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">🧑‍💼 Data Pelanggan</h2>
                        <span class="text-sm text-gray-500">{{ $order->user->name ?? '-' }}</span>
                    </div>

                    <div class="space-y-4 text-gray-700">
                        <div>
                            <p class="text-sm text-gray-500">Nama</p>
                            <p class="font-medium">{{ $order->user->name ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Email</p>
                            <p>{{ $order->user->email ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">WhatsApp</p>
                            <p>
                                <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $order->whatsapp ?? $order->user->whatsapp ?? '') }}"
                                   target="_blank" class="text-green-600 font-medium">
                                    {{ $order->whatsapp ?? $order->user->whatsapp ?? '-' }}
                                </a>
                            </p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p class="text-sm text-gray-700">{{ $order->address ?? $order->user->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order detail card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm fade-in-up hover:-translate-y-1 transform transition-shadow duration-200">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">📦 Detail Pesanan</h2>
                        <span class="text-sm text-gray-500">{{ optional($order->created_at)->format('d M Y H:i') }}</span>
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 text-gray-700">
                        <div>
                            <p class="text-sm text-gray-500">Kode Order</p>
                            <p class="font-medium">{{ $order->order_code }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Layanan</p>
                            <p class="font-medium">{{ ucfirst(str_replace('_',' ', $order->service_type)) }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Durasi (hari)</p>
                            <p>{{ $order->duration ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Pewangi</p>
                            <p>{{ $order->fragrance ?? '-' }}</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Berat</p>
                            <p>{{ $order->weight ?? 0 }} kg</p>
                        </div>

                        <div>
                            <p class="text-sm text-gray-500">Total Harga</p>
                            <p class="font-medium text-gray-800">Rp {{ number_format($order->total_price ?? 0,0,',','.') }}</p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Status</p>
                            @php
                                $statusLabels = [
                                    'baru'    => 'Baru',
                                    'proses'  => 'Sedang Diproses',
                                    'selesai' => 'Selesai',
                                    'diambil' => 'Sudah Diambil'
                                ];
                                $statusColors = [
                                    'baru'    => 'bg-yellow-100 text-yellow-800',
                                    'proses'  => 'bg-orange-100 text-orange-800',
                                    'selesai' => 'bg-green-100 text-green-800',
                                    'diambil' => 'bg-purple-100 text-purple-800'
                                ];
                                $key = $order->status ?? '';
                            @endphp
                            <div class="mt-2 flex items-center gap-3">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $statusColors[$key] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$key] ?? (ucfirst(str_replace('_',' ', $key)) ?: '-') }}
                                </span>
                            </div>
                        </div>

                        @if(!empty($order->notes))
                            <div class="md:col-span-2">
                                <p class="text-sm text-gray-500">Catatan</p>
                                <div class="mt-2 p-4 bg-gray-50 rounded-lg border border-gray-100 text-gray-700">
                                    {{ $order->notes }}
                                </div>
                            </div>
                        @endif
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('customer.dashboard') }}" class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:shadow-sm">
                            ← Kembali ke Dashboard
                        </a>

                        <a href="https://wa.me/{{ preg_replace('/[^0-9]/','', $order->whatsapp ?? $order->user->whatsapp ?? '') }}"
                           target="_blank"
                           class="inline-flex items-center px-4 py-2 rounded-full font-semibold text-white"
                           style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%);">
                            Hubungi via WhatsApp
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>

@endsection