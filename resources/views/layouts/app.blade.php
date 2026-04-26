<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
            min-height: 100vh;
        }
        .gradient-purple {
            background: linear-gradient(135deg, #7c3aed 0%, #db2777 50%, #a855f7 100%);
        }
        .gradient-blue {
            background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
        }
        .gradient-pink {
            background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
        }
        .gradient-emerald {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-10px);
            box-shadow: 0 25px 50px rgba(124, 58, 237, 0.15);
        }
        .glass-effect {
            background: rgba(255, 255, 255, 0.7);
            backdrop-filter: blur(10px);
        }
        .content img {
            max-width: 100%;
            height: auto;
            border-radius: 12px;
            margin: 20px 0;
        }
    </style>
</head>
<body>
    <nav class="sticky top-0 z-50 bg-gradient-to-r from-purple-600 via-purple-700 to-purple-800 text-white shadow-lg">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between h-16">
                <!-- Logo -->
                <a href="{{ route('home') }}" class="flex items-center gap-3">
                    <div class="w-10 h-10 bg-white bg-opacity-20 rounded-lg flex items-center justify-center backdrop-blur-sm">
                        <i class="fas fa-newspaper text-yellow-300 text-lg"></i>
                    </div>
                    <span class="text-xl font-bold">Web Berita</span>
                </a>

                <!-- Navigation Items - Desktop -->
                <div class="hidden md:flex items-center gap-1">
                    <a href="{{ route('news.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all hover:bg-white hover:bg-opacity-10">
                        <i class="fas fa-newspaper"></i>
                        <span>Berita</span>
                    </a>
                    @auth
                        <a href="{{ route('news.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg transition-all hover:bg-white hover:bg-opacity-10">
                            <i class="fas fa-pen-fancy"></i>
                            <span>Tulis Berita</span>
                        </a>
                    @endauth
                </div>

                <!-- Right Menu -->
                <div class="flex items-center gap-3">
                    @auth
                        @if(auth()->user()->role === 'admin')
                            <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex items-center gap-2 px-4 py-2 bg-yellow-400 text-gray-900 hover:bg-yellow-300 rounded-lg font-semibold transition-all transform hover:scale-105">
                                <i class="fas fa-lock"></i> Admin
                            </a>
                        @endif
                        <div class="relative group">
                            <button class="flex items-center gap-2 px-3 py-2 rounded-lg hover:bg-white hover:bg-opacity-10 transition-all">
                                <div class="w-8 h-8 bg-white bg-opacity-20 rounded-full flex items-center justify-center">
                                    <i class="fas fa-user text-sm"></i>
                                </div>
                                <span class="hidden sm:flex text-sm font-medium">{{ auth()->user()->name }}</span>
                                <i class="fas fa-chevron-down text-xs"></i>
                            </button>
                            <!-- Dropdown Menu -->
                            <div class="hidden group-hover:block absolute right-0 mt-0 w-48 bg-white text-gray-800 rounded-lg shadow-xl z-50">
                                <a href="{{ route('home') }}" class="flex items-center gap-3 px-4 py-3 hover:bg-gray-100 rounded-t-lg transition-all">
                                    <i class="fas fa-home text-purple-600"></i>
                                    <span>Beranda</span>
                                </a>
                                @if(auth()->user()->role === 'admin')
                                    <a href="{{ route('admin.dashboard') }}" class="flex md:hidden items-center gap-3 px-4 py-3 hover:bg-gray-100 transition-all">
                                        <i class="fas fa-lock text-purple-600"></i>
                                        <span>Admin Panel</span>
                                    </a>
                                @endif
                                <form method="POST" action="{{ route('logout') }}" class="block">
                                    @csrf
                                    <button type="submit" class="w-full flex items-center gap-3 px-4 py-3 text-red-600 hover:bg-red-50 rounded-b-lg transition-all text-left">
                                        <i class="fas fa-sign-out-alt"></i>
                                        <span>Logout</span>
                                    </button>
                                </form>
                            </div>
                        </div>
                    @else
                        <a href="{{ route('login') }}" class="hidden sm:flex items-center gap-2 px-4 py-2 text-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-all">
                            <i class="fas fa-sign-in-alt"></i> Login
                        </a>
                        <a href="{{ route('register') }}" class="hidden sm:flex items-center gap-2 px-4 py-2 bg-yellow-400 text-gray-900 hover:bg-yellow-300 rounded-lg font-semibold transition-all transform hover:scale-105">
                            <i class="fas fa-user-plus"></i> Register
                        </a>
                        <a href="{{ route('admin.login') }}" class="hidden sm:flex items-center gap-2 px-3 py-2 text-white border-2 border-white hover:bg-white hover:bg-opacity-10 rounded-lg transition-all">
                            <i class="fas fa-lock text-sm"></i> Admin
                        </a>
                    @endauth

                    <!-- Mobile Menu Button -->
                    <button onclick="document.getElementById('mobile-menu').classList.toggle('hidden')" class="md:hidden text-white hover:bg-white hover:bg-opacity-10 p-2 rounded-lg">
                        <i class="fas fa-bars text-xl"></i>
                    </button>
                </div>
            </div>

            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden md:hidden pb-4 space-y-2">
                <a href="{{ route('news.index') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-10 block">
                    <i class="fas fa-newspaper"></i> Berita
                </a>
                @auth
                    <a href="{{ route('news.create') }}" class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-white hover:bg-opacity-10 block">
                        <i class="fas fa-pen-fancy"></i> Tulis Berita
                    </a>
                @else
                    <a href="{{ route('login') }}" class="flex items-center gap-2 px-4 py-2 hover:bg-white hover:bg-opacity-10 block">
                        <i class="fas fa-sign-in-alt"></i> Login
                    </a>
                    <a href="{{ route('register') }}" class="flex items-center gap-2 px-4 py-2 bg-yellow-400 text-gray-900 rounded-lg font-semibold block">
                        <i class="fas fa-user-plus"></i> Register
                    </a>
                @endauth
            </div>
        </div>
    </nav>
        </div>
    </nav>

    <main class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
        @if(session('success'))
            <div class="mb-4 p-4 bg-green-50 border border-green-200 rounded-lg text-green-700 flex justify-between items-center">
                <span><i class="fas fa-check-circle"></i> {{ session('success') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-green-700 hover:text-green-900"><i class="fas fa-times"></i></button>
            </div>
        @endif
        @if(session('error'))
            <div class="mb-4 p-4 bg-red-50 border border-red-200 rounded-lg text-red-700 flex justify-between items-center">
                <span><i class="fas fa-exclamation-circle"></i> {{ session('error') }}</span>
                <button onclick="this.parentElement.style.display='none'" class="text-red-700 hover:text-red-900"><i class="fas fa-times"></i></button>
            </div>
        @endif
        @yield('content')
    </main>

    <footer class="bg-gradient-to-r from-gray-900 to-gray-800 text-white py-12 mt-20">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">
                <div>
                    <h5 class="text-xl font-bold mb-4"><i class="fas fa-newspaper"></i> Web Berita</h5>
                    <p class="text-gray-400">Platform berita terpercaya dengan informasi terkini dan terpercaya.</p>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">Link Cepat</h5>
                    <ul class="space-y-2 text-gray-400">
                        <li><a href="{{ route('home') }}" class="hover:text-white transition"><i class="fas fa-home"></i> Beranda</a></li>
                        <li><a href="{{ route('news.index') }}" class="hover:text-white transition"><i class="fas fa-newspaper"></i> Berita</a></li>
                        @auth
                        <li><a href="{{ route('news.create') }}" class="hover:text-white transition"><i class="fas fa-pen-fancy"></i> Tulis Berita</a></li>
                        @endauth
                    </ul>
                </div>
                <div>
                    <h5 class="text-xl font-bold mb-4">Kontak</h5>
                    <p class="text-gray-400 flex items-center gap-2"><i class="fas fa-envelope"></i> info@webberita.com</p>
                    <p class="text-gray-400 flex items-center gap-2"><i class="fas fa-phone"></i> +62 123 456 789</p>
                </div>
            </div>
            <div class="border-t border-gray-700 pt-8 text-center text-gray-400">
                <p>&copy; 2026 Web Berita. All rights reserved.</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const alerts = document.querySelectorAll('[data-alert]');
            alerts.forEach(alert => {
                setTimeout(() => {
                    alert.style.display = 'none';
                }, 5000);
            });
        });
    </script>
</body>
</html>