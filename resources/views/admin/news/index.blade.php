@extends('admin.layout')

@section('page-title', 'Kelola Berita')

@section('content')
<div class="px-6 py-6">
    <!-- Header -->
    <div class="flex justify-between items-center mb-8">
        <div>
            <h2 class="text-3xl font-bold text-gray-900">Kelola Berita</h2>
            <p class="text-gray-500 mt-1">Atur dan kelola semua artikel berita Anda</p>
        </div>
        <a href="{{ route('news.create') }}" class="bg-gradient-to-r from-purple-600 to-pink-600 hover:shadow-lg hover:shadow-purple-500/30 text-white px-6 py-3 rounded-lg flex items-center gap-2 transition-all transform hover:scale-105 font-bold">
            <i class="fas fa-plus-circle"></i> Tulis Berita
        </a>
    </div>

    <!-- Table Container -->
    <div class="bg-white rounded-2xl shadow-lg overflow-hidden">
        <!-- Table Header with Gradient -->
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead>
                    <tr class="bg-gradient-to-r from-gray-900 via-gray-800 to-gray-900 text-white">
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Judul</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Author</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Status</th>
                        <th class="px-6 py-4 text-left text-xs font-bold uppercase tracking-wider">Publikasi</th>
                        <th class="px-6 py-4 text-center text-xs font-bold uppercase tracking-wider">Aksi</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($news as $item)
                    <tr class="hover:bg-gray-50 transition-all duration-200 group">
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">
                            <div class="flex items-center gap-3">
                                @if($item->image)
                                    <img src="{{ asset('storage/' . $item->image) }}" alt="" class="w-12 h-12 rounded-lg object-cover">
                                @else
                                    <div class="w-12 h-12 rounded-lg bg-gradient-purple flex items-center justify-center text-white text-lg">
                                        <i class="fas fa-image"></i>
                                    </div>
                                @endif
                                <span class="truncate max-w-xs group-hover:text-purple-600 transition-colors">{{ Str::limit($item->title, 40) }}</span>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $item->author->name }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if($item->status == 'published')
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-gradient-emerald text-white">
                                    <i class="fas fa-check-circle"></i> Published
                                </span>
                            @elseif($item->status == 'draft')
                                <span class="inline-flex items-center gap-1 px-3 py-1.5 rounded-full text-xs font-bold bg-yellow-400 text-yellow-900">
                                    <i class="fas fa-pencil"></i> Draft
                                </span>
                            @else
                                <span class="inline-flex items-center px-3 py-1.5 rounded-full text-xs font-bold bg-gray-200 text-gray-700">{{ ucfirst($item->status) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">
                            <span class="flex items-center gap-1">
                                <i class="fas fa-calendar text-gray-400"></i>
                                {{ $item->published_at ? $item->published_at->format('d M Y') : '—' }}
                            </span>
                        </td>
                        <td class="px-6 py-4 text-sm">
                            <div class="flex justify-center gap-2">
                                <a href="{{ route('news.show', $item->slug) }}" class="w-9 h-9 rounded-lg bg-blue-100 text-blue-600 hover:bg-blue-200 transition-colors flex items-center justify-center group/btn" target="_blank" title="Lihat">
                                    <i class="fas fa-eye text-sm"></i>
                                </a>
                                <a href="{{ route('admin.news.edit', $item) }}" class="w-9 h-9 rounded-lg bg-orange-100 text-orange-600 hover:bg-orange-200 transition-colors flex items-center justify-center" title="Edit">
                                    <i class="fas fa-edit text-sm"></i>
                                </a>
                                <form method="POST" action="{{ route('admin.news.delete', $item) }}" class="inline">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-9 h-9 rounded-lg bg-red-100 text-red-600 hover:bg-red-200 transition-colors flex items-center justify-center" onclick="return confirm('Hapus berita ini?')" title="Hapus">
                                        <i class="fas fa-trash text-sm"></i>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-12 text-center">
                            <div>
                                <i class="fas fa-inbox text-4xl text-gray-300 mb-3 block"></i>
                                <p class="text-gray-500 font-medium">Tidak ada berita</p>
                                <a href="{{ route('news.create') }}" class="text-purple-600 hover:text-purple-700 text-sm font-bold mt-2 inline-block">
                                    Tulis berita sekarang <i class="fas fa-arrow-right"></i>
                                </a>
                            </div>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        @if($news->hasPages())
        <div class="px-6 py-6 border-t border-gray-200 bg-gray-50">
            <div class="flex justify-center">
                {{ $news->links() }}
            </div>
        </div>
        @endif
    </div>
</div>
@endsection