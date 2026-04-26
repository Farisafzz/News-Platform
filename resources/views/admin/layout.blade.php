<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Admin Panel') - {{ config('app.name') }}</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    <style>
        * {
            font-family: 'Inter', sans-serif;
        }
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #f1f5f9 100%);
        }
        .sidebar-open #sidebar {
            transform: translateX(0);
        }
        .sidebar {
            transform: translateX(-100%);
            transition: transform 0.3s ease;
        }
        @media (min-width: 768px) {
            .sidebar {
                transform: translateX(0);
            }
        }
        .transition-all {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .gradient-purple {
            background: linear-gradient(135deg, #7c3aed 0%, #db2777 50%, #a855f7 100%);
        }
        .gradient-emerald {
            background: linear-gradient(135deg, #10b981 0%, #34d399 100%);
        }
        .hover-lift {
            transition: all 0.3s cubic-bezier(0.4, 0, 0.2, 1);
        }
        .hover-lift:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 40px rgba(124, 58, 237, 0.15);
        }
    </style>
</head>
<body class="bg-gray-50">
    <div id="app" class="flex h-screen bg-gray-100">
        <!-- Sidebar -->
        <div id="sidebar" class="fixed inset-y-0 left-0 z-40 w-64 bg-gradient-to-b from-gray-900 via-gray-800 to-gray-900 shadow-lg md:relative md:translate-x-0">
            <div class="flex flex-col h-full">
                <!-- Logo -->
                <div class="flex items-center justify-center h-20 bg-black bg-opacity-50 border-b border-gray-700">
                    <h1 class="text-2xl font-bold text-white flex items-center gap-2">
                        <i class="fas fa-shield-alt text-purple-500"></i> Admin
                    </h1>
                </div>

                <!-- Navigation -->
                <nav class="flex-1 px-4 py-8 space-y-2 overflow-y-auto">
                    <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.dashboard') ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700' }}">
                        <i class="fas fa-chart-line"></i> <span>Dashboard</span>
                    </a>
                    <a href="{{ route('admin.news') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.news*') ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700' }}">
                        <i class="fas fa-newspaper"></i> <span>Kelola Berita</span>
                    </a>
                    <a href="{{ route('admin.tags') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.tags*') ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700' }}">
                        <i class="fas fa-tags"></i> <span>Kelola Tags</span>
                    </a>
                    <a href="{{ route('admin.users') }}" class="flex items-center gap-3 px-4 py-3 rounded-lg transition-all {{ request()->routeIs('admin.users*') ? 'bg-purple-600 text-white shadow-lg' : 'text-gray-300 hover:bg-gray-700' }}">
                        <i class="fas fa-users"></i> <span>Kelola User</span>
                    </a>
                </nav>

                <!-- User Section -->
                <div class="px-4 py-6 border-t border-gray-700">
                    <div class="flex items-center gap-3 mb-4 p-3 bg-gray-700 rounded-lg">
                        <div class="w-10 h-10 bg-purple-500 rounded-full flex items-center justify-center text-white">
                            <i class="fas fa-user"></i>
                        </div>
                        <div class="flex-1 min-w-0">
                            <p class="text-sm font-semibold text-white truncate">{{ auth()->user()->name }}</p>
                            <p class="text-xs text-gray-400">Admin</p>
                        </div>
                    </div>
                    <a href="{{ route('home') }}" class="flex items-center gap-2 w-full px-4 py-2 text-gray-300 hover:text-white hover:bg-gray-700 rounded-lg transition-all mb-2">
                        <i class="fas fa-globe"></i> <span>Kunjungi Situs</span>
                    </a>
                    <form method="POST" action="{{ route('logout') }}" class="w-full">
                        @csrf
                        <button type="submit" class="flex items-center gap-2 w-full px-4 py-2 text-red-400 hover:text-red-300 hover:bg-red-900 hover:bg-opacity-20 rounded-lg transition-all">
                            <i class="fas fa-sign-out-alt"></i> <span>Logout</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Main Content -->
        <div class="flex-1 flex flex-col overflow-hidden">
            <!-- Top Bar -->
            <header class="bg-white border-b border-gray-200 shadow-sm">
                <div class="flex items-center justify-between h-20 px-6">
                    <button onclick="document.getElementById('app').classList.toggle('sidebar-open')" class="md:hidden text-gray-600 hover:text-gray-900">
                        <i class="fas fa-bars text-2xl"></i>
                    </button>
                    <h2 class="text-2xl font-semibold text-gray-900">@yield('page-title', 'Dashboard')</h2>
                    <div class="flex items-center gap-4">
                        <div class="hidden sm:flex items-center gap-2 px-4 py-2 bg-gray-100 rounded-lg">
                            <i class="fas fa-clock text-gray-500"></i>
                            <span class="text-sm text-gray-600" id="current-time"></span>
                        </div>
                    </div>
                </div>
            </header>

            <!-- Content Area -->
            <main class="flex-1 overflow-auto">
                <div class="p-6">
                    @if(session('success'))
                        <div class="mb-6 p-4 bg-green-50 border border-green-200 border-l-4 border-l-green-500 rounded-lg flex justify-between items-center">
                            <span class="text-green-700 flex items-center gap-2">
                                <i class="fas fa-check-circle"></i> {{ session('success') }}
                            </span>
                            <button onclick="this.parentElement.style.display='none'" class="text-green-700"><i class="fas fa-times"></i></button>
                        </div>
                    @endif
                    @if(session('error'))
                        <div class="mb-6 p-4 bg-red-50 border border-red-200 border-l-4 border-l-red-500 rounded-lg flex justify-between items-center">
                            <span class="text-red-700 flex items-center gap-2">
                                <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                            </span>
                            <button onclick="this.parentElement.style.display='none'" class="text-red-700"><i class="fas fa-times"></i></button>
                        </div>
                    @endif

                    @yield('content')
                </div>
            </main>
        </div>
    </div>

    <script>
        // Update time
        function updateTime() {
            const now = new Date();
            document.getElementById('current-time').textContent = now.toLocaleTimeString('id-ID', {
                hour: '2-digit',
                minute: '2-digit'
            });
        }
        updateTime();
        setInterval(updateTime, 1000);

        // Close sidebar when clicking outside on mobile
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleBtn = event.target.closest('button');
            
            if (!toggleBtn?.matches('[onclick*="sidebar"]') && 
                !sidebar.contains(event.target) && 
                window.innerWidth < 768) {
                document.getElementById('app').classList.remove('sidebar-open');
            }
        });
    </script>
</body>
</html>
