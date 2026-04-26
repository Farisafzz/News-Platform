@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden border-t-4 border-red-600">
            <!-- Header -->
            <div class="bg-gradient-to-r from-red-600 to-red-700 px-6 py-4">
                <h2 class="text-2xl font-bold text-white text-center flex items-center justify-center gap-2">
                    <i class="fas fa-lock"></i> Admin Panel Login
                </h2>
            </div>

            <!-- Body -->
            <div class="p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                        <div class="font-semibold mb-2"><i class="fas fa-exclamation-circle mr-2"></i> Login Error</div>
                        @foreach($errors->all() as $error)
                            <div class="text-sm">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <!-- Info Alert -->
                <div class="mb-4 p-4 bg-blue-50 border border-blue-200 text-blue-700 rounded-lg text-sm">
                    <i class="fas fa-info-circle mr-2 font-semibold"></i>
                    <p>Halaman login khusus untuk admin. Hanya akun dengan role admin yang dapat mengakses panel admin.</p>
                </div>

                <form method="POST" action="{{ route('admin.login.post') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Email Admin
                        </label>
                        <input 
                            type="email" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" 
                            id="email" 
                            name="email" 
                            required 
                            value="{{ old('email') }}"
                            autofocus
                            placeholder="admin@example.com"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input 
                            type="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-red-500 focus:border-transparent" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="••••••••"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-2 bg-gradient-to-r from-red-600 to-red-700 text-white font-semibold rounded-lg hover:from-red-700 hover:to-red-800 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <i class="fas fa-sign-in-alt"></i> Login ke Admin Panel
                    </button>
                </form>

                <hr class="my-4 border-gray-200">

                <!-- Link -->
                <p class="text-center text-sm text-gray-600">
                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 font-semibold flex items-center justify-center gap-2">
                        <i class="fas fa-arrow-left"></i> Login sebagai User Biasa
                    </a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
