@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white text-center flex items-center justify-center gap-2">
                    <i class="fas fa-sign-in-alt"></i> Login
                </h2>
            </div>

            <!-- Body -->
            <div class="p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                        <div class="font-semibold mb-2"><i class="fas fa-exclamation-circle mr-2"></i> Login Failed</div>
                        @foreach($errors->all() as $error)
                            <div class="text-sm">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-envelope mr-2"></i>Email Address
                        </label>
                        <input 
                            type="email" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                            id="email" 
                            name="email" 
                            required 
                            value="{{ old('email') }}"
                            placeholder="you@example.com"
                        >
                    </div>

                    <div class="mb-6">
                        <label for="password" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2"></i>Password
                        </label>
                        <input 
                            type="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                            id="password" 
                            name="password" 
                            required
                            placeholder="••••••••"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <i class="fas fa-sign-in-alt"></i> Login
                    </button>
                </form>

                <hr class="my-4 border-gray-200">

                <!-- Links -->
                <div class="space-y-2 text-center text-sm">
                    <p class="text-gray-600">
                        Belum punya akun? 
                        <a href="{{ route('register') }}" class="text-purple-600 hover:text-purple-800 font-semibold">Daftar di sini</a>
                    </p>
                    <p>
                        <a href="{{ route('admin.login') }}" class="text-red-600 hover:text-red-800 font-semibold flex items-center justify-center gap-2">
                            <i class="fas fa-lock"></i> Admin Login
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection