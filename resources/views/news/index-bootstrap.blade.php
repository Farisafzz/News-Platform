@extends('layouts.app')

@section('content')
<div class="hero bg-gradient-primary text-white py-5 mb-4">
    <div class="container">
        <h1 class="display-4"><i class="fas fa-newspaper"></i> Berita Terbaru</h1>
        <p class="lead">Temukan berita terkini dan terpercaya dari berbagai kategori</p>
        <div class="row mt-4">
            <div class="col-md-6">
                <form class="d-flex" action="{{ route('home') }}" method="GET">
                    <input class="form-control me-2" type="search" name="search" placeholder="Cari berita..." value="{{ request('search') }}">
                    <button class="btn btn-light" type="submit"><i class="fas fa-search"></i></button>
                </form>
            </div>
        </div>
    </div>
</div>

<div class="container">
    <!-- Tags Navigation -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h6 class="card-title mb-3"><i class="fas fa-tags"></i> Kategori Berita</h6>
                    <div class="d-flex flex-wrap gap-2">
                        <a href="{{ route('home') }}" class="btn btn-outline-primary btn-sm {{ !request('tag') ? 'active' : '' }}">
                            <i class="fas fa-home"></i> Semua
                        </a>
                        @foreach($tags as $tag)
                            <a href="{{ route('home', ['tag' => $tag->slug]) }}" class="btn btn-outline-secondary btn-sm {{ request('tag') == $tag->slug ? 'active' : '' }}">
                                {{ $tag->name }}
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- News Grid -->
    <div class="row" id="news-container">
        @forelse($news as $item)
        <div class="col-lg-4 col-md-6 mb-4">
            <div class="card h-100 shadow-sm hover-card">
                @if($item->image)
                <img src="{{ asset('storage/' . $item->image) }}" class="card-img-top" alt="{{ $item->title }}" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">
                        <a href="{{ route('news.show', $item->slug) }}" class="text-decoration-none text-dark">{{ Str::limit($item->title, 60) }}</a>
                    </h5>
                    <p class="card-text flex-grow-1 text-muted">{{ $item->summary ?? Str::limit(strip_tags($item->content), 120) }}</p>
                    @if($item->tags->count() > 0)
                    <div class="mb-2">
                        @foreach($item->tags as $tag)
                            <span class="badge bg-info me-1">{{ $tag->name }}</span>
                        @endforeach
                    </div>
                    @endif
                    <div class="mt-auto">
                        <small class="text-muted">
                            <i class="fas fa-user"></i> {{ $item->author->name }} |
                            <i class="fas fa-calendar"></i> {{ $item->published_at ? $item->published_at->format('d M Y') : 'N/A' }} |
                            <i class="fas fa-eye"></i> {{ $item->views }} views
                        </small>
                    </div>
                </div>
                <div class="card-footer bg-transparent">
                    <a href="{{ route('news.show', $item->slug) }}" class="btn btn-primary btn-sm w-100">
                        <i class="fas fa-arrow-right"></i> Baca Selengkapnya
                    </a>
                </div>
            </div>
        </div>
        @empty
        <div class="col-12">
            <div class="text-center py-5">
                <i class="fas fa-newspaper fa-3x text-muted mb-3"></i>
                <h4 class="text-muted">Tidak ada berita ditemukan</h4>
                <p class="text-muted">Coba ubah kriteria pencarian atau kategori</p>
            </div>
        </div>
        @endforelse
    </div>

    <!-- Pagination -->
    <div class="d-flex justify-content-center mb-4">
        {{ $news->appends(request()->query())->links() }}
    </div>
</div>

<!-- Back to Top Button -->
<button id="back-to-top" class="btn btn-primary position-fixed" style="bottom: 20px; right: 20px; display: none; z-index: 1000;">
    <i class="fas fa-arrow-up"></i>
</button>

<style>
.hover-card {
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}
.hover-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 10px 25px rgba(0,0,0,0.15) !important;
}
.bg-gradient-primary {
    background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
}
</style>

<script>
// Back to Top functionality
window.addEventListener('scroll', function() {
    const backToTop = document.getElementById('back-to-top');
    if (window.pageYOffset > 300) {
        backToTop.style.display = 'block';
    } else {
        backToTop.style.display = 'none';
    }
});

document.getElementById('back-to-top').addEventListener('click', function() {
    window.scrollTo({ top: 0, behavior: 'smooth' });
});
</script>
@endsection