@extends('layouts.app')

@section('content')
<div class="container mx-auto max-w-md mt-10">
    <h2 class="text-2xl font-bold mb-6">Register</h2>
    <form method="POST" action="{{ route('register') }}">
        @csrf
        <div class="mb-4">
            <label for="name" class="block mb-1">Name</label>
            <input type="text" name="name" id="name" class="w-full border px-3 py-2" required autofocus>
        </div>
        <div class="mb-4">
            <label for="email" class="block mb-1">Email</label>
            <input type="email" name="email" id="email" class="w-full border px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="password" class="block mb-1">Password</label>
            <input type="password" name="password" id="password" class="w-full border px-3 py-2" required>
        </div>
        <div class="mb-4">
            <label for="password_confirmation" class="block mb-1">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="w-full border px-3 py-2" required>
        </div>
        @if($errors->any())
            <div class="mb-4 text-red-500">
                {{ $errors->first() }}
            </div>
        @endif
        <button type="submit" class="btn btn-primary w-full">Register</button>
    </form>
</div>
@endsection