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

    <main class="pt-28 pb-16">
        <div class="max-w-6xl mx-auto px-6">

            <!-- Header -->
            <div class="rounded-3xl p-8 mb-8 shadow-2xl fade-in-up"
                 style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%); animation-delay:0.05s;">
                <div>
                    <h1 class="text-3xl md:text-4xl font-bold text-white">Detail Order</h1>
                    <p class="text-white/80 mt-1">
                        Informasi lengkap untuk kode
                        <span class="font-semibold">{{ $order->order_code }}</span>
                    </p>
                </div>
            </div>

            <!-- Cards grid -->
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                <!-- Customer card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm fade-in-up
                            transition-transform transition-shadow duration-200 hover:-translate-y-1 hover:shadow-md"
                     style="animation-delay:0.10s;">
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
                            <p>{{ $order->whatsapp ?? $order->user->whatsapp ?? '-' }}</p>
                        </div>
                        <div>
                            <p class="text-sm text-gray-500">Alamat</p>
                            <p>{{ $order->address ?? $order->user->address ?? '-' }}</p>
                        </div>
                    </div>
                </div>

                <!-- Order detail card -->
                <div class="bg-white rounded-2xl border border-gray-200 p-8 shadow-sm fade-in-up
                            transition-transform transition-shadow duration-200 hover:-translate-y-1 hover:shadow-md"
                     style="animation-delay:0.15s;">
                    <div class="flex items-center justify-between mb-4">
                        <h2 class="text-lg font-semibold text-gray-800">📦 Detail Pesanan</h2>
                        <span class="text-sm text-gray-500">{{ $order->created_at->format('d M Y H:i') }}</span>
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
                            <p class="font-medium text-gray-800">
                                Rp {{ number_format($order->total_price ?? 0,0,',','.') }}
                            </p>
                        </div>

                        <div class="md:col-span-2">
                            <p class="text-sm text-gray-500">Status</p>
                            @php
                                $statusLabels = [
                                    'pending'      => 'Waiting PickUp',
                                    'collected'    => 'Collected',
                                    'in_treatment' => 'In Treatment',
                                    'finish'       => 'Finish',
                                ];

                                $colors = [
                                    'pending'      => 'bg-yellow-100 text-yellow-800',
                                    'collected'    => 'bg-blue-100 text-blue-800',
                                    'in_treatment' => 'bg-purple-100 text-purple-800',
                                    'finish'       => 'bg-green-100 text-green-800',
                                ];

                                $statusOptions = $statusLabels; // dipakai juga untuk select
                            @endphp
                            <div class="mt-2 flex flex-wrap items-center gap-3">
                                <span class="px-3 py-1 rounded-full text-sm font-semibold {{ $colors[$order->status] ?? 'bg-gray-100 text-gray-800' }}">
                                    {{ $statusLabels[$order->status] ?? ucfirst(str_replace('_',' ', $order->status)) }}
                                </span>

                                <form action="{{ route('admin.orders.update-status', $order->id) }}"
                                    method="POST"
                                    class="flex flex-wrap items-center gap-2">
                                    @csrf
                                    @method('PUT')

                                    <select name="status" class="px-3 py-2 border rounded-lg text-sm">
                                        <option value="">-- Ubah status --</option>
                                        @foreach($statusOptions as $value => $label)
                                            <option value="{{ $value }}" {{ $order->status === $value ? 'selected' : '' }}>
                                                {{ $label }}
                                            </option>
                                        @endforeach
                                    </select>

                                    <button type="submit"
                                            class="px-4 py-2 rounded-full text-sm font-semibold text-white shadow-sm"
                                            style="background:linear-gradient(90deg,#2E8FFF 0%,#32D98D 100%);">
                                        Update
                                    </button>
                                </form>
                            </div>
                        </div>


                        <div class="md:col-span-2 mt-4">
                            <p class="text-sm text-gray-500">Catatan</p>
                            <p class="text-gray-700">{{ $order->notes ?? '-' }}</p>
                        </div>
                    </div>

                    <div class="mt-6 flex gap-3">
                        <a href="{{ route('admin.dashboard', ['status' => request('status') ?? 'all']) }}"
                           class="inline-block px-4 py-2 rounded-full text-sm font-semibold text-gray-700 bg-white border border-gray-200 hover:bg-gray-50">
                            ← Kembali ke Dashboard
                        </a>
                    </div>
                </div>
            </div>

        </div>
    </main>
</body>
</html>
@endsection
