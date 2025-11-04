@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <h2 class="text-2xl font-bold mb-6">Login</h2>
    <form method="POST" action="{{ route('login') }}">
        @csrf
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full border px-3 py-2" required autofocus>
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-1">Password</label>
            <input type="password" name="password" id="password" class="w-full border px-3 py-2" required>
        </div>
        @if($errors->any())
            <div class="mb-4 text-red-500">
                {{ $errors->first() }}
            </div>
        @endif
        <button type="submit" class="btn btn-primary w-full">Login</button>
    </form>
</div>
@endsection