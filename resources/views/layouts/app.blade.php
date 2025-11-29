<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laundry System') }}</title>
    <link rel="stylesheet" href="{{ asset('resources/css/app.css') }}">
    {{-- Hapus @vite jika tidak pakai Vite --}}
</head>
<body class="bg-gray-100 min-h-screen antialiased">
    <nav class="bg-white shadow mb-6">
        <div class="container mx-auto px-4 py-3 flex justify-between items-center">
            <a href="{{ url('/') }}" class="font-bold text-lg text-blue-600">{{ config('app.name', 'Laundry System') }}</a>
            <div>
                @auth
                    <span class="mr-4">Halo, {{ Auth::user()->name }}</span>
                    <form action="{{ route('logout') }}" method="POST" class="inline">
                        @csrf
                        <button type="submit" class="btn btn-danger">Logout</button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn btn-primary mr-2">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                @endauth
            </div>
        </div>
    </nav>
    <main>
        @yield('content')
    </main>
    <footer class="bg-gray-900 text-white py-8">
        <div class="container mx-auto px-6 text-center">
            <p>&copy; {{ date('Y') }} TempatCuciIbuk. All rights reserved.</p>
        </div>
    </footer>
    <script>
        // Tulis JS langsung di sini
        console.log('Hello from inline JS!');
    </script>
</body>
</html>