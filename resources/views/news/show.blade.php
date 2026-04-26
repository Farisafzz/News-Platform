@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 mb-8 text-sm">
        <a href="{{ route('home') }}" class="text-purple-600 hover:text-purple-700 font-medium transition flex items-center gap-1">
            <i class="fas fa-home text-xs"></i>Home
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-600 truncate">{{ Str::limit($news->title, 50) }}</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Main Article -->
        <div class="lg:col-span-2">
            <article class="bg-white rounded-2xl shadow-lg overflow-hidden hover-lift">
                @if($news->image)
                    <div class="relative h-96 overflow-hidden group">
                        <img src="{{ asset('storage/' . $news->image) }}" class="w-full h-full object-cover group-hover:scale-110 transition-transform duration-500" alt="{{ $news->title }}">
                        <div class="absolute inset-0 bg-black bg-opacity-0 group-hover:bg-opacity-10 transition-all duration-300"></div>
                    </div>
                @else
                    <div class="w-full h-96 gradient-purple flex items-center justify-center">
                        <i class="fas fa-image text-white/30 text-6xl"></i>
                    </div>
                @endif

                <div class="p-8 md:p-10">
                    <!-- Status Badge -->
                    <div class="flex items-center gap-3 mb-4">
                        @if($news->status == 'published')
                            <span class="inline-flex items-center gap-1 px-4 py-1.5 bg-gradient-emerald text-white text-xs font-bold rounded-full shadow-md">
                                <i class="fas fa-check-circle"></i> Published
                            </span>
                        @else
                            <span class="inline-flex items-center gap-1 px-4 py-1.5 bg-yellow-400 text-yellow-900 text-xs font-bold rounded-full shadow-md">
                                <i class="fas fa-pencil"></i> Draft
                            </span>
                        @endif
                        <span class="text-xs text-gray-500 font-medium">Updated {{ $news->updated_at->diffForHumans() }}</span>
                    </div>

                    <!-- Title -->
                    <h1 class="text-4xl md:text-5xl font-bold text-gray-900 mb-6 leading-tight">{{ $news->title }}</h1>

                    <!-- Meta Info -->
                    <div class="flex flex-wrap gap-6 text-sm mb-8 pb-8 border-b-2 border-gray-100">
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-purple flex items-center justify-center text-white">
                                <i class="fas fa-user text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Author</p>
                                <p class="font-semibold text-gray-900">{{ $news->author->name }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full bg-gradient-blue flex items-center justify-center text-white">
                                <i class="fas fa-calendar text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Published</p>
                                <p class="font-semibold text-gray-900">{{ $news->published_at ? $news->published_at->format('d M Y') : 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="flex items-center gap-3">
                            <div class="w-10 h-10 rounded-full gradient-pink flex items-center justify-center text-white">
                                <i class="fas fa-eye text-sm"></i>
                            </div>
                            <div>
                                <p class="text-xs text-gray-500 font-medium">Views</p>
                                <p class="font-semibold text-gray-900">{{ number_format($news->views) }}</p>
                            </div>
                        </div>
                    </div>

                    <!-- Content -->
                    <div class="prose prose-lg max-w-none text-gray-700 leading-relaxed mb-8 space-y-4">
                        {!! $news->content !!}
                    </div>

                    <!-- Tags Section -->
                    @if($news->tags->count() > 0)
                    <div class="pt-8 border-t-2 border-gray-100">
                        <h3 class="text-sm font-bold text-gray-700 mb-4 uppercase tracking-wider">
                            <i class="fas fa-tags mr-2 text-purple-600"></i>Tags
                        </h3>
                        <div class="flex flex-wrap gap-3">
                            @foreach($news->tags as $tag)
                                <a href="{{ route('home', ['tag' => $tag->slug]) }}" class="inline-flex items-center gap-2 px-4 py-2 bg-gradient-to-r from-purple-50 to-purple-100 text-purple-700 text-sm font-bold rounded-full border-2 border-purple-200 hover:shadow-lg hover:scale-105 transition-all duration-300">
                                    <i class="fas fa-tag text-xs"></i>{{ $tag->name }}
                                </a>
                            @endforeach
                        </div>
                    </div>
                    @endif
                </div>
            </article>
        </div>

        <!-- Sidebar -->
        <div class="lg:col-span-1 space-y-6">
            <!-- Share Section -->
            <div class="bg-gradient-to-br from-purple-600 to-pink-600 rounded-2xl shadow-lg p-6 text-white hover-lift">
                <h3 class="text-lg font-bold mb-4 flex items-center gap-2">
                    <i class="fas fa-share-nodes"></i> Bagikan Berita
                </h3>
                <div class="space-y-2">
                    <button onclick="window.open('https://facebook.com/share.php?u=' + window.location.href)" class="w-full p-3 bg-white/20 hover:bg-white/30 rounded-lg transition-all font-medium flex items-center gap-2 group">
                        <i class="fab fa-facebook group-hover:scale-110 transition-transform"></i> Facebook
                    </button>
                    <button onclick="window.open('https://twitter.com/intent/tweet?url=' + window.location.href + '&text=' + document.title)" class="w-full p-3 bg-white/20 hover:bg-white/30 rounded-lg transition-all font-medium flex items-center gap-2 group">
                        <i class="fab fa-twitter group-hover:scale-110 transition-transform"></i> Twitter
                    </button>
                    <button onclick="window.open('https://linkedin.com/sharing/share-offsite/?url=' + window.location.href)" class="w-full p-3 bg-white/20 hover:bg-white/30 rounded-lg transition-all font-medium flex items-center gap-2 group">
                        <i class="fab fa-linkedin group-hover:scale-110 transition-transform"></i> LinkedIn
                    </button>
                </div>
            </div>

            <!-- Author Info -->
            <div class="bg-white rounded-2xl shadow-lg p-6 hover-lift">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-user-circle text-purple-600"></i> Tentang Author
                </h3>
                <div class="text-center">
                    <div class="w-16 h-16 rounded-full gradient-purple mx-auto mb-3 flex items-center justify-center text-white text-2xl">
                        <i class="fas fa-user"></i>
                    </div>
                    <h4 class="font-bold text-gray-900 mb-2">{{ $news->author->name }}</h4>
                    <p class="text-sm text-gray-500 mb-4">{{ $news->author->email }}</p>
                    <p class="text-xs text-gray-600 leading-relaxed">
                        Professional journalist dengan pengalaman menulis berita berkualitas
                    </p>
                </div>
            </div>

            <!-- Reading Time & Info -->
            <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                    <i class="fas fa-info-circle text-blue-600"></i> Info Berita
                </h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Jumlah Kata:</span>
                        <span class="font-bold text-gray-900">{{ str_word_count(strip_tags($news->content)) }}</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <span class="text-sm text-gray-600">Estimated Read:</span>
                        <span class="font-bold text-gray-900">{{ max(1, ceil(str_word_count(strip_tags($news->content)) / 200)) }} min</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection