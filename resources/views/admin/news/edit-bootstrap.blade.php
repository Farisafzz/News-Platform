@extends('admin.layout')

@section('title', 'Edit News')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm">
                <div class="card-header bg-primary text-white">
                    <h5 class="mb-0"><i class="fas fa-edit"></i> Edit News: {{ Str::limit($news->title, 50) }}</h5>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('admin.news.update', $news) }}">
                        @csrf @method('PUT')
                        <div class="row">
                            <div class="col-md-8">
                                <div class="mb-3">
                                    <label for="title" class="form-label"><i class="fas fa-heading"></i> Title</label>
                                    <input type="text" name="title" class="form-control" value="{{ $news->title }}" required>
                                </div>
                                <div class="mb-3">
                                    <label for="content" class="form-label"><i class="fas fa-edit"></i> Content</label>
                                    <textarea name="content" class="form-control" rows="15" required>{{ $news->content }}</textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="mb-3">
                                    <label for="status" class="form-label"><i class="fas fa-info-circle"></i> Status</label>
                                    <select name="status" class="form-control" required>
                                        <option value="draft" {{ $news->status == 'draft' ? 'selected' : '' }}>Draft</option>
                                        <option value="pending" {{ $news->status == 'pending' ? 'selected' : '' }}>Pending</option>
                                        <option value="published" {{ $news->status == 'published' ? 'selected' : '' }}>Published</option>
                                        <option value="rejected" {{ $news->status == 'rejected' ? 'selected' : '' }}>Rejected</option>
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="published_at" class="form-label"><i class="fas fa-calendar"></i> Published At</label>
                                    <input type="datetime-local" name="published_at" class="form-control" value="{{ $news->published_at ? $news->published_at->format('Y-m-d\TH:i') : '' }}">
                                </div>
                                <div class="mb-3">
                                    <label for="tags" class="form-label"><i class="fas fa-tags"></i> Tags</label>
                                    <select name="tags[]" class="form-control" multiple style="min-height: 120px;">
                                        @foreach($tags as $tag)
                                            <option value="{{ $tag->id }}" {{ $news->tags->contains($tag->id) ? 'selected' : '' }}>{{ $tag->name }}</option>
                                        @endforeach
                                    </select>
                                    <small class="form-text text-muted">Select multiple tags by holding Ctrl</small>
                                </div>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save"></i> Update News
                            </button>
                            <a href="{{ route('admin.news') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Back to News
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection