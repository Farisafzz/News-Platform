@extends('layouts.app')

@section('content')
<!-- Hero Section - Premium Design -->
<div class="relative overflow-hidden mb-16">
    <!-- Background Elements -->
    <div class="absolute inset-0 bg-gradient-to-br from-purple-600 via-pink-600 to-purple-700 opacity-95"></div>
    <div class="absolute top-0 right-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    <div class="absolute bottom-0 left-0 w-96 h-96 bg-white/10 rounded-full blur-3xl"></div>
    
    <div class="relative z-10 max-w-7xl mx-auto px-4 py-20">
        <div class="text-center mb-12">
            <div class="inline-block mb-4">
                <span class="px-4 py-2 bg-white/20 text-white rounded-full text-sm font-bold backdrop-blur-lg border border-white/30">
                    <i class="fas fa-rocket mr-2"></i>Selamat Datang
                </span>
            </div>
            <h1 class="text-6xl md:text-7xl font-black text-white mb-6 leading-tight">
                Jelajahi Berita<br><span class="bg-gradient-to-r from-yellow-200 to-pink-200 bg-clip-text text-transparent">Terkini</span>
            </h1>
            <p class="text-xl text-purple-100 mb-10 max-w-2xl mx-auto leading-relaxed">
                Temukan informasi, berita mendalam, dan liputan eksklusif dari berbagai kategori yang menarik
            </p>
            
            <!-- Search Bar -->
            <div class="max-w-2xl mx-auto">
                <form class="flex gap-3" action="{{ route('home') }}" method="GET">
                    <div class="flex-1 relative">
                        <input 
                            class="w-full px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-yellow-300 bg-white shadow-xl placeholder:text-gray-400 font-medium" 
                            type="search" 
                            name="search" 
                            placeholder="Cari berita, kategori, atau penulis..." 
                            value="{{ request('search') }}"
                        >
                        <i class="fas fa-search absolute right-4 top-4 text-gray-400 text-xl"></i>
                    </div>
                    <button class="px-8 py-4 bg-yellow-400 hover:bg-yellow-300 text-gray-900 rounded-xl font-bold transition-all transform hover:scale-105 shadow-xl flex items-center gap-2 whitespace-nowrap" type="submit">
                        <i class="fas fa-search"></i> Cari
                    </button>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Category Filter - Modern Tabs -->
<div class="max-w-7xl mx-auto px-4 mb-16">
    <div class="bg-white rounded-2xl shadow-lg p-8 border-t-4 border-purple-600">
        <div class="flex items-center justify-between mb-8">
            <h2 class="text-3xl font-black text-gray-900 flex items-center gap-3">
                <div class="w-12 h-12 rounded-xl bg-gradient-purple flex items-center justify-center text-white text-xl">
                    <i class="fas fa-filter"></i>
                </div>
                Jelajahi Kategori
            </h2>
            <span class="text-sm font-bold text-gray-500 bg-gray-100 px-4 py-2 rounded-lg">
                <i class="fas fa-bookmark mr-2"></i>{{ count($tags) }} Kategori
            </span>
        </div>
        
        <div class="flex flex-wrap gap-3">
            <a href="{{ route('home') }}" class="group px-6 py-3 rounded-full font-bold transition-all transform hover:scale-110 flex items-center gap-2 whitespace-nowrap {{ !request('tag') ? 'bg-gradient-to-r from-purple-600 to-pink-600 text-white shadow-lg shadow-purple-500/50' : 'bg-gray-100 text-gray-900 hover:bg-gray-200 border-2 border-gray-300' }}">
                <i class="fas fa-star text-lg"></i>
                <span>Semua Berita</span>
                <span class="ml-2 text-sm font-semibold opacity-90">{{ count($news) }}</span>
            </a>
            
            @foreach($tags as $tag)
                <a href="{{ route('home', ['tag' => $tag->slug]) }}" class="group px-6 py-3 rounded-full font-bold transition-all transform hover:scale-110 flex items-center gap-2 whitespace-nowrap {{ request('tag') == $tag->slug ? 'bg-gradient-to-r from-blue-600 to-cyan-500 text-white shadow-lg shadow-blue-500/50' : 'bg-gray-100 text-gray-900 hover:bg-gray-200 border-2 border-gray-300' }}">
                    <i class="fas fa-tag text-lg group-hover:rotate-12 transition-transform"></i>
                    <span>{{ $tag->name }}</span>
                </a>
            @endforeach
        </div>
    </div>
</div>

<!-- Featured News -->
@if($news->count() > 0)
<div class="max-w-7xl mx-auto px-4 mb-16">
    @php $featured = $news->first(); @endphp
    <div class="bg-white rounded-2xl shadow-2xl overflow-hidden hover-lift group">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-0">
            <!-- Featured Image -->
            <div class="relative h-96 lg:h-full overflow-hidden">
                @if($featured->image)
                    <img src="{{ asset('storage/' . $featured->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $featured->title }}">
                @else
                    <div class="w-full h-full gradient-purple flex items-center justify-center">
                        <i class="fas fa-image text-white/30 text-7xl"></i>
                    </div>
                @endif
                <div class="absolute inset-0 bg-gradient-to-t from-black/50 to-transparent opacity-0 group-hover:opacity-100 transition-opacity"></div>
            </div>
            
            <!-- Featured Content -->
            <div class="p-10 lg:p-12 flex flex-col justify-center">
                <div class="flex items-center gap-3 mb-4">
                    <span class="px-4 py-2 bg-gradient-pink text-white rounded-full text-xs font-bold">
                        <i class="fas fa-star mr-1"></i>FEATURED
                    </span>
                    <span class="text-sm font-bold text-gray-500">{{ $featured->published_at?->format('d M Y') }}</span>
                </div>
                
                <h2 class="text-4xl lg:text-5xl font-black text-gray-900 mb-4 leading-tight group-hover:text-purple-600 transition-colors line-clamp-3">
                    {{ $featured->title }}
                </h2>
                
                <p class="text-gray-600 text-lg mb-6 line-clamp-3 leading-relaxed">
                    {{ $featured->summary ?? Str::limit(strip_tags($featured->content), 150) }}
                </p>
                
                <!-- Featured Tags -->
                @if($featured->tags && $featured->tags->count() > 0)
                <div class="flex flex-wrap gap-2 mb-6">
                    @foreach($featured->tags as $tag)
                        <a href="{{ route('home', ['tag' => $tag->slug]) }}" class="inline-flex items-center gap-1 px-3 py-1 bg-purple-100 text-purple-700 text-xs font-bold rounded-lg hover:bg-purple-200 transition-all">
                            <i class="fas fa-tag text-xs"></i>{{ $tag->name }}
                        </a>
                    @endforeach
                </div>
                @endif
                
                <!-- Featured Meta -->
                <div class="flex items-center gap-6 mb-8 pb-8 border-b-2 border-gray-200">
                    <div class="flex items-center gap-2 text-sm">
                        <div class="w-8 h-8 rounded-full bg-gradient-purple flex items-center justify-center text-white">
                            <i class="fas fa-user text-xs"></i>
                        </div>
                        <span class="font-bold text-gray-900">{{ $featured->author->name }}</span>
                    </div>
                    <div class="flex items-center gap-2 text-sm text-gray-600">
                        <i class="fas fa-eye"></i>
                        <span class="font-bold">{{ number_format($featured->views) }} views</span>
                    </div>
                </div>
                
                <a href="{{ route('news.show', $featured->slug) }}" class="inline-block px-8 py-4 bg-gradient-purple text-white rounded-xl font-bold hover:shadow-lg hover:shadow-purple-500/50 transition-all transform hover:scale-105">
                    Baca Selengkapnya <i class="fas fa-arrow-right ml-2"></i>
                </a>
            </div>
        </div>
    </div>
</div>
@endif

<!-- News Grid Section -->
<div class="max-w-7xl mx-auto px-4 mb-16">
    <h2 class="text-3xl font-black text-gray-900 mb-8 flex items-center gap-3">
        <div class="w-12 h-12 rounded-xl bg-gradient-blue flex items-center justify-center text-white text-xl">
            <i class="fas fa-bolt"></i>
        </div>
        Berita Terbaru
    </h2>
    
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @forelse($news as $item)
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift group transition-all duration-300">
                <!-- Card Image -->
                <div class="relative h-48 overflow-hidden bg-gradient-to-br from-gray-300 to-gray-400">
                    @if($item->image)
                        <img src="{{ asset('storage/' . $item->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $item->title }}">
                    @else
                        <div class="w-full h-full flex items-center justify-center text-gray-400">
                            <i class="fas fa-image text-5xl opacity-40"></i>
                        </div>
                    @endif
                    
                    <!-- Overlay on Hover -->
                    <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent opacity-0 group-hover:opacity-100 transition-opacity duration-300"></div>
                    
                    <!-- Category Badge -->
                    @if($item->tags && $item->tags->count() > 0)
                    <div class="absolute top-4 left-4 opacity-0 group-hover:opacity-100 transition-all duration-300">
                        <span class="inline-block px-3 py-1 bg-gradient-pink text-white text-xs font-bold rounded-lg">
                            {{ $item->tags->first()->name }}
                        </span>
                    </div>
                    @endif
                </div>
                
                <!-- Card Content -->
                <div class="p-6 flex flex-col h-full">
                    <!-- Title -->
                    <h3 class="text-lg font-black text-gray-900 mb-3 line-clamp-2 group-hover:text-purple-600 transition-colors">
                        <a href="{{ route('news.show', $item->slug) }}">{{ $item->title }}</a>
                    </h3>
                    
                    <!-- Summary - 4 lines -->
                    <p class="text-gray-600 text-sm mb-4 line-clamp-4 flex-grow leading-relaxed">
                        {{ $item->summary ?? Str::limit(strip_tags($item->content), 150) }}
                    </p>
                    
                    <!-- Tags - Di Bawah -->
                    @if($item->tags && $item->tags->count() > 0)
                    <div class="flex flex-wrap gap-2 mb-4 pb-4 border-b-2 border-gray-100">
                        @foreach($item->tags as $tag)
                            <a href="{{ route('home', ['tag' => $tag->slug]) }}" class="inline-flex items-center gap-1 px-3 py-1.5 bg-gradient-to-r from-blue-50 to-blue-100 text-blue-700 text-xs font-bold rounded-lg hover:from-blue-100 hover:to-blue-200 hover:shadow-md transition-all border border-blue-200">
                                <i class="fas fa-tag text-xs"></i>{{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                    @else
                    <div class="text-xs text-gray-400 italic flex items-center gap-1 mb-4 pb-4 border-b-2 border-gray-100">
                        <i class="fas fa-circle-info"></i>Belum ada tag
                    </div>
                    @endif
                    
                    <!-- Meta Info - Date, Views, Author -->
                    <div class="flex items-center justify-between text-xs font-bold text-gray-500">
                        <div class="flex items-center gap-2 min-w-0">
                            <div class="w-6 h-6 rounded-full bg-gradient-purple flex items-center justify-center text-white text-xs flex-shrink-0">
                                <i class="fas fa-user"></i>
                            </div>
                            <span class="text-gray-900 truncate">{{ $item->author->name }}</span>
                        </div>
                        <a href="{{ route('news.show', $item->slug) }}" class="w-8 h-8 rounded-lg bg-gradient-purple text-white flex items-center justify-center hover:shadow-lg transition-all transform hover:scale-110">
                            <i class="fas fa-arrow-right text-sm"></i>
                        </a>
                    </div>
                </div>
            </article>
        @empty
            <div class="md:col-span-2 lg:col-span-3">
                <div class="text-center py-16 bg-white rounded-2xl shadow-lg">
                    <i class="fas fa-inbox text-6xl text-gray-300 mb-4 block"></i>
                    <h4 class="text-2xl font-black text-gray-600 mb-2">Tidak ada berita ditemukan</h4>
                    <p class="text-gray-500 mb-6">Coba ubah kriteria pencarian atau kategori untuk menemukan berita yang Anda cari</p>
                    <a href="{{ route('home') }}" class="inline-block px-6 py-3 bg-gradient-purple text-white rounded-xl font-bold hover:shadow-lg transition-all">
                        Lihat Semua Berita
                    </a>
                </div>
            </div>
        @endforelse
    </div>
    
    <!-- Pagination -->
    @if($news->hasPages())
    <div class="mt-12 flex justify-center">
        {{ $news->appends(request()->query())->links() }}
    </div>
    @endif
</div>

<!-- Engagement Sections -->
<div class="max-w-7xl mx-auto px-4 mb-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
        <!-- Newsletter Card -->
        <div class="bg-gradient-to-br from-blue-600 to-indigo-600 rounded-2xl shadow-2xl p-10 text-white hover-lift">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h3 class="text-3xl font-black mb-2">Newsletter</h3>
                    <p class="text-blue-100">Dapatkan update berita terbaru setiap hari</p>
                </div>
                <i class="fas fa-envelope-open text-5xl opacity-30"></i>
            </div>
            
            <form class="space-y-3">
                <input 
                    type="email" 
                    placeholder="Masukkan email Anda" 
                    class="w-full px-6 py-4 rounded-xl text-gray-900 focus:outline-none focus:ring-2 focus:ring-blue-300 bg-white/90 placeholder:text-gray-500 font-medium"
                    required
                >
                <button 
                    type="submit" 
                    class="w-full px-6 py-4 bg-yellow-400 hover:bg-yellow-300 text-gray-900 rounded-xl font-bold transition-all transform hover:scale-105"
                >
                    <i class="fas fa-paper-plane mr-2"></i>Subscribe Sekarang
                </button>
            </form>
            <p class="text-sm text-blue-100 mt-4">
                <i class="fas fa-check-circle mr-2"></i>Gratis, tanpa spam, bisa berhenti kapan saja
            </p>
        </div>
        
        <!-- Join Community Card -->
        <div class="bg-gradient-to-br from-emerald-600 to-green-600 rounded-2xl shadow-2xl p-10 text-white hover-lift">
            <div class="flex items-start justify-between mb-6">
                <div>
                    <h3 class="text-3xl font-black mb-2">Bergabung</h3>
                    <p class="text-emerald-100">Jadilah bagian dari komunitas penulis kami</p>
                </div>
                <i class="fas fa-users text-5xl opacity-30"></i>
            </div>
            
            <p class="mb-8 leading-relaxed text-lg">
                Bagikan berita dan cerita Anda dengan ribuan pembaca. Dapatkan penghasilan dari konten Anda.
            </p>
            
            <div class="flex gap-3">
                <a href="{{ route('register') }}" class="flex-1 px-6 py-4 bg-white text-emerald-600 rounded-xl font-bold hover:bg-gray-50 transition-all text-center">
                    Daftar Sekarang
                </a>
                <a href="{{ route('login') }}" class="flex-1 px-6 py-4 bg-white/20 border-2 border-white text-white rounded-xl font-bold hover:bg-white/30 transition-all text-center">
                    Login
                </a>
            </div>
        </div>
    </div>
</div>

<!-- Social Media Section -->
<div class="relative overflow-hidden rounded-2xl mb-16">
    <div class="bg-gradient-to-r from-purple-900 via-pink-900 to-purple-900 relative z-10">
        <div class="max-w-7xl mx-auto px-4 py-16">
            <div class="text-center">
                <h2 class="text-4xl font-black text-white mb-3">Ikuti Kami</h2>
                <p class="text-purple-200 mb-10 text-lg">Dapatkan update berita terbaru melalui media sosial kami</p>
                
                <div class="flex justify-center gap-4 flex-wrap">
                    <a href="#" class="group w-14 h-14 rounded-full bg-blue-600 text-white flex items-center justify-center hover:scale-125 transition-all duration-300 shadow-lg">
                        <i class="fab fa-facebook-f text-xl group-hover:-translate-y-1 transition-transform"></i>
                    </a>
                    <a href="#" class="group w-14 h-14 rounded-full bg-blue-400 text-white flex items-center justify-center hover:scale-125 transition-all duration-300 shadow-lg">
                        <i class="fab fa-twitter text-xl group-hover:-translate-y-1 transition-transform"></i>
                    </a>
                    <a href="#" class="group w-14 h-14 rounded-full bg-pink-600 text-white flex items-center justify-center hover:scale-125 transition-all duration-300 shadow-lg">
                        <i class="fab fa-instagram text-xl group-hover:-translate-y-1 transition-transform"></i>
                    </a>
                    <a href="#" class="group w-14 h-14 rounded-full bg-red-600 text-white flex items-center justify-center hover:scale-125 transition-all duration-300 shadow-lg">
                        <i class="fab fa-youtube text-xl group-hover:-translate-y-1 transition-transform"></i>
                    </a>
                    <a href="#" class="group w-14 h-14 rounded-full bg-orange-600 text-white flex items-center justify-center hover:scale-125 transition-all duration-300 shadow-lg">
                        <i class="fab fa-rss text-xl group-hover:-translate-y-1 transition-transform"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Back to Top Button -->
<button 
    id="back-to-top" 
    class="fixed bottom-8 right-8 w-14 h-14 bg-gradient-purple text-white rounded-full shadow-2xl hover:shadow-purple-500/50 transition-all opacity-0 invisible transform hover:scale-110 flex items-center justify-center"
    onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
    title="Kembali ke atas"
>
    <i class="fas fa-arrow-up text-lg"></i>
</button>

<!-- CSS for gradient pink -->
<style>
    .gradient-pink {
        background: linear-gradient(135deg, #ec4899 0%, #f472b6 100%);
    }
    .gradient-blue {
        background: linear-gradient(135deg, #3b82f6 0%, #06b6d4 100%);
    }
</style>

<script>
    window.addEventListener('scroll', function(){
        const btn = document.getElementById('back-to-top');
        if(window.pageYOffset > 300){
            btn.classList.remove('opacity-0', 'invisible');
        } else {
            btn.classList.add('opacity-0', 'invisible');
        }
    });
</script>

@endsection
