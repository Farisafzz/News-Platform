@extends('layouts.app')

@section('content')
<div class="min-h-screen flex items-center justify-center px-4 py-12">
    <div class="w-full max-w-md">
        <div class="bg-white rounded-lg shadow-lg overflow-hidden">
            <!-- Header -->
            <div class="bg-gradient-to-r from-purple-600 to-pink-600 px-6 py-4">
                <h2 class="text-2xl font-bold text-white text-center flex items-center justify-center gap-2">
                    <i class="fas fa-user-plus"></i> Register
                </h2>
            </div>

            <!-- Body -->
            <div class="p-6">
                @if($errors->any())
                    <div class="mb-4 p-4 bg-red-50 border border-red-200 text-red-700 rounded-lg">
                        <div class="font-semibold mb-2"><i class="fas fa-exclamation-circle mr-2"></i> Registration Error</div>
                        @foreach($errors->all() as $error)
                            <div class="text-sm">{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <div class="mb-4">
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-user mr-2"></i>Full Name
                        </label>
                        <input 
                            type="text" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                            id="name" 
                            name="name" 
                            required 
                            value="{{ old('name') }}"
                            placeholder="Your name"
                        >
                    </div>

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

                    <div class="mb-4">
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

                    <div class="mb-6">
                        <label for="password_confirmation" class="block text-sm font-semibold text-gray-700 mb-2">
                            <i class="fas fa-lock mr-2"></i>Confirm Password
                        </label>
                        <input 
                            type="password" 
                            class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" 
                            id="password_confirmation" 
                            name="password_confirmation" 
                            required
                            placeholder="••••••••"
                        >
                    </div>

                    <button 
                        type="submit" 
                        class="w-full py-2 bg-gradient-to-r from-purple-600 to-pink-600 text-white font-semibold rounded-lg hover:from-purple-700 hover:to-pink-700 transition-all duration-200 flex items-center justify-center gap-2"
                    >
                        <i class="fas fa-user-plus"></i> Create Account
                    </button>
                </form>

                <hr class="my-4 border-gray-200">

                <!-- Link -->
                <p class="text-center text-sm text-gray-600">
                    Sudah punya akun? 
                    <a href="{{ route('login') }}" class="text-purple-600 hover:text-purple-800 font-semibold">Login di sini</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection