@extends('admin.layout')

@section('page-title', 'Edit User')

@section('content')
<div class="px-6 py-4">
    <div class="max-w-2xl">
        <div class="bg-white rounded-lg shadow-md p-8">
            <h2 class="text-2xl font-bold text-gray-800 mb-6">Edit User: {{ $user->name }}</h2>
            
            <form method="POST" action="{{ route('admin.users.update', $user) }}">
                @csrf
                @method('PUT')
                
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                    <div>
                        <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Name</label>
                        <input type="text" name="name" id="name" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" value="{{ $user->name }}" required>
                    </div>
                    <div>
                        <label for="email" class="block text-sm font-semibold text-gray-700 mb-2">Email</label>
                        <input type="email" name="email" id="email" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" value="{{ $user->email }}" required>
                    </div>
                </div>
                
                <div class="mb-6">
                    <label for="role" class="block text-sm font-semibold text-gray-700 mb-2">Role</label>
                    <select name="role" id="role" class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500 focus:border-transparent" required>
                        <option value="guest" {{ $user->role == 'guest' ? 'selected' : '' }}>Guest</option>
                        <option value="user" {{ $user->role == 'user' ? 'selected' : '' }}>User</option>
                        <option value="author" {{ $user->role == 'author' ? 'selected' : '' }}>Author</option>
                        <option value="editor" {{ $user->role == 'editor' ? 'selected' : '' }}>Editor</option>
                        <option value="admin" {{ $user->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                </div>
                
                <div class="flex gap-3">
                    <button type="submit" class="px-6 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors font-medium">
                        <i class="fas fa-save mr-2"></i>Update User
                    </button>
                    <a href="{{ route('admin.users') }}" class="px-6 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors font-medium">
                        <i class="fas fa-arrow-left mr-2"></i>Back
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection