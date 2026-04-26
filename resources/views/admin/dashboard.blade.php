@extends('admin.layout')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<!-- Welcome Banner -->
<div class="px-6 py-8 bg-gradient-to-r from-purple-600 via-pink-600 to-purple-600 rounded-2xl mb-8 text-white shadow-lg">
    <div class="flex justify-between items-start">
        <div>
            <h1 class="text-3xl font-bold mb-2">Selamat Datang, {{ auth()->user()->name }}! 👋</h1>
            <p class="text-purple-100">Kelola konten berita Anda dari sini. Lihat ringkasan dashboard di bawah.</p>
        </div>
        <div class="text-6xl opacity-30">
            <i class="fas fa-chart-line"></i>
        </div>
    </div>
</div>

<!-- Stats Grid -->
<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
    <!-- Total News Card -->
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all hover-lift overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-blue-400 to-blue-600"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                    <i class="fas fa-newspaper text-2xl text-blue-600"></i>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-blue-100 text-blue-700 rounded-full">Total</span>
            </div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total Berita</p>
            <p class="text-4xl font-bold text-gray-900">{{ $newsCount ?? 0 }}</p>
            <p class="text-xs text-gray-400 mt-2"><i class="fas fa-arrow-up text-green-500"></i> Semua berita</p>
        </div>
    </div>

    <!-- Published News Card -->
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all hover-lift overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-green-400 to-emerald-600"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-green-100 to-emerald-200 flex items-center justify-center">
                    <i class="fas fa-check-circle text-2xl text-green-600"></i>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-green-100 text-green-700 rounded-full">Published</span>
            </div>
            <p class="text-gray-500 text-sm font-medium mb-1">Berita Dipublikasi</p>
            <p class="text-4xl font-bold text-gray-900">{{ $publishedNews ?? 0 }}</p>
            <p class="text-xs text-green-600 mt-2"><i class="fas fa-check mr-1"></i> Aktif</p>
        </div>
    </div>

    <!-- Users Card -->
    <div class="bg-white rounded-2xl shadow-lg hover:shadow-2xl transition-all hover-lift overflow-hidden">
        <div class="h-1 bg-gradient-to-r from-purple-400 to-purple-600"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-gradient-to-br from-purple-100 to-purple-200 flex items-center justify-center">
                    <i class="fas fa-users text-2xl text-purple-600"></i>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-purple-100 text-purple-700 rounded-full">Users</span>
            </div>
            <p class="text-gray-500 text-sm font-medium mb-1">Total User</p>
            <p class="text-4xl font-bold text-gray-900">{{ $userCount ?? 0 }}</p>
            <p class="text-xs text-purple-600 mt-2"><i class="fas fa-users mr-1"></i> Terdaftar</p>
        </div>
    </div>

    <!-- Info Card -->
    <div class="bg-gradient-to-br from-orange-500 to-red-500 rounded-2xl shadow-lg hover:shadow-2xl transition-all hover-lift overflow-hidden text-white">
        <div class="h-1 bg-red-700"></div>
        <div class="p-6">
            <div class="flex items-center justify-between mb-4">
                <div class="w-14 h-14 rounded-xl bg-white/20 flex items-center justify-center">
                    <i class="fas fa-fire text-2xl"></i>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-white/20 rounded-full">Active</span>
            </div>
            <p class="text-orange-100 text-sm font-medium mb-1">Status</p>
            <p class="text-4xl font-bold">{{ $publishedNews ?? 0 }}</p>
            <p class="text-xs text-orange-100 mt-2"><i class="fas fa-zap mr-1"></i> Content ready</p>
        </div>
    </div>
</div>

<!-- Quick Actions -->
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Recent Activity -->
    <div class="lg:col-span-2 bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i class="fas fa-clock text-purple-600"></i> Aktivitas Terbaru
        </h3>
        <div class="space-y-4">
            @for($i = 0; $i < 3; $i++)
            <div class="flex items-center gap-4 p-4 hover:bg-gray-50 rounded-lg transition-colors">
                <div class="w-12 h-12 rounded-full bg-gradient-purple flex items-center justify-center text-white">
                    <i class="fas fa-pen"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900">Berita baru dipublikasikan</p>
                    <p class="text-sm text-gray-500">Beberapa waktu lalu</p>
                </div>
                <span class="text-xs font-bold px-3 py-1 bg-green-100 text-green-700 rounded-full whitespace-nowrap">Baru</span>
            </div>
            @endfor
        </div>
    </div>

    <!-- Quick Links -->
    <div class="bg-white rounded-2xl shadow-lg p-6">
        <h3 class="text-xl font-bold text-gray-900 mb-6 flex items-center gap-2">
            <i class="fas fa-link text-blue-600"></i> Akses Cepat
        </h3>
        <div class="space-y-3">
            <a href="{{ route('admin.news') }}" class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-blue-100 flex items-center justify-center group-hover:bg-blue-200 transition-colors">
                    <i class="fas fa-newspaper text-blue-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 text-sm">Kelola Berita</p>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-gray-600"></i>
            </a>
            <a href="{{ route('admin.users') }}" class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-purple-100 flex items-center justify-center group-hover:bg-purple-200 transition-colors">
                    <i class="fas fa-users text-purple-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 text-sm">Kelola User</p>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-gray-600"></i>
            </a>
            <a href="{{ route('admin.tags') }}" class="flex items-center gap-3 p-3 hover:bg-gray-50 rounded-lg transition-colors group">
                <div class="w-10 h-10 rounded-lg bg-green-100 flex items-center justify-center group-hover:bg-green-200 transition-colors">
                    <i class="fas fa-tags text-green-600"></i>
                </div>
                <div class="flex-1 min-w-0">
                    <p class="font-semibold text-gray-900 text-sm">Kelola Tags</p>
                </div>
                <i class="fas fa-arrow-right text-gray-400 group-hover:text-gray-600"></i>
            </a>
        </div>
    </div>
</div>

@endsection