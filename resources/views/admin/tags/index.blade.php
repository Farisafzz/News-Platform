@extends('admin.layout')

@section('title', 'Manage Tags')
@section('page-title', 'Manage Tags')

@section('content')
<div class="px-6 py-4">
    @if(session('success'))
        <div class="mb-4 p-4 bg-green-50 border border-green-200 text-green-700 rounded-lg">
            <i class="fas fa-check-circle mr-2"></i>{{ session('success') }}
        </div>
    @endif

    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manage Tags</h2>
        <button onclick="openCreateModal()" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i> Add New Tag
        </button>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Slug</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Created At</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @forelse($tags as $tag)
                        <tr class="hover:bg-gray-50 transition-colors">
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $tag->id }}</td>
                            <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $tag->name }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $tag->slug }}</td>
                            <td class="px-6 py-4 text-sm text-gray-600">{{ $tag->created_at->format('d M Y') }}</td>
                            <td class="px-6 py-4 text-sm flex gap-2">
                                <a href="{{ route('admin.tags.edit', $tag) }}" class="text-orange-600 hover:text-orange-800 p-2 rounded hover:bg-orange-50 transition-colors" title="Edit">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <form action="{{ route('admin.tags.delete', $tag) }}" method="POST" class="inline" onsubmit="return confirm('Are you sure?')">
                                    @csrf @method('DELETE')
                                    <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded hover:bg-red-50 transition-colors" title="Delete">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="5" class="px-6 py-8 text-center text-gray-500">
                                <i class="fas fa-folder-open text-3xl mb-2"></i>
                                <p class="mt-2">No tags found</p>
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex justify-center">
                {{ $tags->links() }}
            </div>
        </div>
    </div>
</div>

<!-- Create Tag Modal -->
<div id="createTagModal" class="hidden fixed inset-0 bg-black bg-opacity-50 flex items-center justify-center z-50">
    <div class="bg-white rounded-lg shadow-lg max-w-md w-full mx-4">
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="px-6 py-4 border-b border-gray-200 flex justify-between items-center">
                <h5 class="text-lg font-semibold text-gray-900">Create New Tag</h5>
                <button type="button" onclick="closeCreateModal()" class="text-gray-400 hover:text-gray-600 text-2xl leading-none">&times;</button>
            </div>
            <div class="px-6 py-4">
                <div>
                    <label for="name" class="block text-sm font-semibold text-gray-700 mb-2">Tag Name</label>
                    <input type="text" class="w-full px-3 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-purple-500" id="name" name="name" required>
                </div>
            </div>
            <div class="px-6 py-4 border-t border-gray-200 flex justify-end gap-3">
                <button type="button" onclick="closeCreateModal()" class="px-4 py-2 border border-gray-300 text-gray-700 rounded-lg hover:bg-gray-50 transition-colors">Cancel</button>
                <button type="submit" class="px-4 py-2 bg-purple-600 text-white rounded-lg hover:bg-purple-700 transition-colors">Create Tag</button>
            </div>
        </form>
    </div>
</div>

<script>
    function openCreateModal() {
        document.getElementById('createTagModal').classList.remove('hidden');
    }
    function closeCreateModal() {
        document.getElementById('createTagModal').classList.add('hidden');
    }
</script>
@endsection