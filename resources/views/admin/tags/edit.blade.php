@extends('admin.layout')

@section('title', 'Edit Tag')
@section('page-title', 'Edit Tag')

@section('content')
<div class="px-6 py-4">
    <div class="max-w-2xl">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit Tag</h2>
            
            <form action="{{ route('admin.tags.update', $tag) }}" method="POST">
                @csrf @method('PUT')
                <div class="mb-6">
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Tag Name</label>
                    <input type="text" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" id="name" name="name" value="{{ $tag->name }}" required>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
                        <i class="fas fa-save mr-2"></i>Update Tag
                    </button>
                    <a href="{{ route('admin.tags') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        <i class="fas fa-times mr-2"></i>Cancel
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection