@extends('admin.layout')

@section('title', 'Edit Berita')
@section('page-title', 'Edit Berita')

@section('content')
<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- Form -->
    <div class="lg:col-span-2">
        <div class="bg-white rounded-lg shadow-sm p-8">
            <form method="POST" action="{{ route('admin.news.update', $news) }}">
                @csrf @method('PUT')
                
                <!-- Title -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-heading"></i> Judul Berita
                    </label>
                    <input type="text" name="title" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" value="{{ $news->title }}" required>
                    @error('title') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Content -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-edit"></i> Isi Konten
                    </label>
                    <textarea name="content" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" rows="12" required>{{ $news->content }}</textarea>
                    @error('content') <p class="text-red-500 text-sm mt-1">{{ $message }}</p> @enderror
                </div>

                <!-- Status -->
                <div class="grid grid-cols-2 gap-6 mb-6">
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            <i class="fas fa-info-circle"></i> Status
                        </label>
                        <select name="status" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" required>
                            <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft</option>
                            <option value="pending" {{ $news->status == 'pending' ? 'selected' : '' }}>Pending Review</option>
                            <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Published</option>
                            <option value="rejected" {{ $news->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>

                    <!-- Published At -->
                    <div>
                        <label class="block text-sm font-semibold text-gray-900 mb-2">
                            <i class="fas fa-calendar"></i> Tanggal Publikasi
                        </label>
                        <input type="datetime-local" name="published_at" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" value="{{ $news->published_at?->format('Y-m-d\TH:i') }}">
                    </div>
                </div>

                <!-- Tags -->
                <div class="mb-6">
                    <label class="block text-sm font-semibold text-gray-900 mb-2">
                        <i class="fas fa-tags"></i> Tags
                    </label>
                    <select name="tags[]" class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" multiple style="min-height: 120px;">
                        @foreach($tags as $tag)
                            <option value="{{ $tag->id }}" {{ $news->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                        @endforeach
                    </select>
                    <p class="text-sm text-gray-500 mt-2"><i class="fas fa-info-circle"></i> Tahan Ctrl untuk memilih multiple tags</p>
                </div>

                <!-- Buttons -->
                <div class="flex gap-3 pt-6 border-t border-gray-200">
                    <button type="submit" class="px-6 py-3 bg-gradient-to-r from-purple-600 to-pink-600 text-white rounded-lg hover:from-purple-700 hover:to-pink-700 hover:shadow-lg transition-all font-semibold flex items-center gap-2">
                        <i class="fas fa-save"></i> Simpan Perubahan
                    </button>
                    <a href="{{ route('admin.news') }}" class="px-6 py-3 bg-gray-200 text-gray-800 rounded-lg hover:bg-gray-300 transition-all font-semibold flex items-center gap-2">
                        <i class="fas fa-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
        </div>
    </div>

    <!-- Info Sidebar -->
    <div class="space-y-6">
        <!-- Post Info -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-info-circle text-blue-500"></i> Informasi Berita
            </h4>
            <div class="space-y-3 text-sm">
                <div>
                    <p class="text-gray-500">Pembuat</p>
                    <p class="font-semibold text-gray-900">{{ $news->author->name }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Dibuat pada</p>
                    <p class="font-semibold text-gray-900">{{ $news->created_at->format('d M Y H:i') }}</p>
                </div>
                <div>
                    <p class="text-gray-500">Views</p>
                    <p class="font-semibold text-gray-900">{{ $news->views }} pembaca</p>
                </div>
                <div>
                    <p class="text-gray-500">Slug</p>
                    <p class="font-mono text-xs bg-gray-100 p-2 rounded truncate">{{ $news->slug }}</p>
                </div>
            </div>
        </div>

        <!-- Preview -->
        <div class="bg-white rounded-lg shadow-sm p-6">
            <h4 class="text-lg font-semibold text-gray-900 mb-4 flex items-center gap-2">
                <i class="fas fa-eye text-purple-500"></i> Preview
            </h4>
            <a href="{{ route('news.show', $news->slug) }}" target="_blank" class="w-full px-4 py-3 bg-purple-50 text-purple-700 rounded-lg hover:bg-purple-100 transition-all text-center font-semibold">
                <i class="fas fa-external-link"></i> Lihat Publikasi
            </a>
        </div>
    </div>
</div>
@endsection
