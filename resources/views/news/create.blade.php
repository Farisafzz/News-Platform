@extends('layouts.app')

@section('content')
<div class="max-w-7xl mx-auto px-4 py-8">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 mb-8 text-sm">
        <a href="{{ route('home') }}" class="text-purple-600 hover:text-purple-700 font-medium flex items-center gap-1">
            <i class="fas fa-home text-xs"></i>Home
        </a>
        <span class="text-gray-300">/</span>
        <span class="text-gray-600">Tulis Berita Baru</span>
    </nav>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Form Section -->
        <div class="lg:col-span-2">
            <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
                <!-- Header -->
                <div class="gradient-purple text-white p-6 flex items-center gap-3">
                    <i class="fas fa-pen-fancy text-2xl"></i>
                    <div>
                        <h2 class="text-3xl font-bold">Tulis Berita Baru</h2>
                        <p class="text-purple-100 text-sm">Bagikan cerita menarik Anda</p>
                    </div>
                </div>
                
                <form method="POST" action="{{ route('news.store') }}" enctype="multipart/form-data" class="p-8">
                    @csrf
                    
                    <!-- Title -->
                    <div class="mb-7">
                        <label for="title" class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-heading text-purple-600"></i>Judul Berita
                        </label>
                        <input 
                            type="text" 
                            class="w-full px-5 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400"
                            id="title" 
                            name="title" 
                            required 
                            placeholder="Masukkan judul berita yang menarik..."
                        >
                        @error('title')
                            <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Summary -->
                    <div class="mb-7">
                        <label for="summary" class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-align-left text-blue-600"></i>Ringkasan
                        </label>
                        <textarea 
                            class="w-full px-5 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 resize-none"
                            id="summary" 
                            name="summary" 
                            rows="3" 
                            placeholder="Tulis ringkasan singkat berita Anda..."
                        ></textarea>
                        @error('summary')
                            <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Content -->
                    <div class="mb-7">
                        <label for="content" class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-file-alt text-emerald-600"></i>Konten Lengkap
                        </label>
                        <textarea 
                            class="w-full px-5 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-emerald-500 focus:border-transparent transition-all duration-300 placeholder:text-gray-400 resize-none font-mono text-sm"
                            id="content" 
                            name="content" 
                            rows="18" 
                            required 
                            placeholder="Tulis konten berita lengkap Anda di sini..."
                        ></textarea>
                        @error('content')
                            <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Image -->
                    <div class="mb-7">
                        <label for="image" class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-image text-pink-600"></i>Featured Image
                        </label>
                        <div class="relative">
                            <input 
                                type="file" 
                                class="w-full px-5 py-3 border-2 border-dashed border-gray-300 rounded-lg focus:outline-none focus:border-pink-500 transition-all duration-300 cursor-pointer"
                                id="image" 
                                name="image" 
                                accept="image/*"
                            >
                            <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                                <i class="fas fa-info-circle"></i>Format: JPG, PNG, WebP (Max 5MB)
                            </p>
                        </div>
                        @error('image')
                            <p class="text-red-600 text-sm mt-2 flex items-center gap-1"><i class="fas fa-exclamation-circle"></i> {{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Tags -->
                    <div class="mb-8">
                        <label for="tags" class="block text-sm font-bold text-gray-700 mb-3 flex items-center gap-2">
                            <i class="fas fa-tags text-orange-600"></i>Kategori/Tags
                        </label>
                        <select 
                            class="w-full px-5 py-3 border-2 border-gray-200 rounded-lg focus:outline-none focus:ring-2 focus:ring-orange-500 focus:border-transparent transition-all duration-300"
                            id="tags" 
                            name="tags[]" 
                            multiple 
                            style="min-height: 120px;"
                        >
                            @foreach($tags as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->name }}</option>
                            @endforeach
                        </select>
                        <p class="text-xs text-gray-500 mt-2 flex items-center gap-1">
                            <i class="fas fa-keyboard"></i>Gunakan Ctrl+Click (Cmd+Click pada Mac) untuk memilih multiple
                        </p>
                    </div>

                    <!-- Buttons -->
                    <div class="flex gap-4 pt-6 border-t-2 border-gray-100">
                        <button 
                            type="submit" 
                            class="px-8 py-3 gradient-purple text-white rounded-lg hover:shadow-lg hover:shadow-purple-500/30 transition-all duration-300 font-bold flex items-center gap-2 transform hover:scale-105"
                        >
                            <i class="fas fa-paper-plane"></i> Publikasikan
                        </button>
                        <a 
                            href="{{ route('home') }}" 
                            class="px-8 py-3 border-2 border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-all duration-300 font-bold flex items-center gap-2"
                        >
                            <i class="fas fa-arrow-left"></i> Kembali
                        </a>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tips Section -->
        <div class="lg:col-span-1">
            <div class="sticky top-6 space-y-4">
                <!-- Writing Tips Card -->
                <div class="bg-gradient-to-br from-amber-50 to-orange-50 rounded-2xl shadow-lg p-6 border-l-4 border-orange-500 hover-lift">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-lightbulb text-orange-500"></i> Tips Menulis
                    </h3>
                    <ul class="space-y-3">
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-500 text-white flex items-center justify-center text-xs font-bold flex-shrink-0">1</div>
                            <span class="text-sm text-gray-700">Judul harus menarik dan deskriptif</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-500 text-white flex items-center justify-center text-xs font-bold flex-shrink-0">2</div>
                            <span class="text-sm text-gray-700">Ringkasan singkat namun informatif</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-500 text-white flex items-center justify-center text-xs font-bold flex-shrink-0">3</div>
                            <span class="text-sm text-gray-700">Konten terstruktur dengan paragraf jelas</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-500 text-white flex items-center justify-center text-xs font-bold flex-shrink-0">4</div>
                            <span class="text-sm text-gray-700">Gambar berkualitas tinggi</span>
                        </li>
                        <li class="flex items-start gap-3">
                            <div class="w-6 h-6 rounded-full bg-orange-500 text-white flex items-center justify-center text-xs font-bold flex-shrink-0">5</div>
                            <span class="text-sm text-gray-700">Tag relevan untuk SEO</span>
                        </li>
                    </ul>
                </div>

                <!-- Progress Card -->
                <div class="bg-gradient-to-br from-blue-50 to-indigo-50 rounded-2xl shadow-lg p-6 border-l-4 border-blue-500">
                    <h3 class="text-lg font-bold text-gray-800 mb-4 flex items-center gap-2">
                        <i class="fas fa-chart-line text-blue-600"></i> Panduan Kualitas
                    </h3>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center mb-2">
                            <span class="text-xs font-bold text-gray-600">Panjang Konten</span>
                            <span class="text-xs text-blue-600">Target: 500+ kata</span>
                        </div>
                        <div class="w-full h-2 bg-gray-200 rounded-full overflow-hidden">
                            <div class="h-full bg-gradient-to-r from-blue-400 to-blue-600 rounded-full" style="width: 75%;"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection