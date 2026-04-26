@extends('admin.layout')

@section('page-title', 'Manage Users')

@section('content')
<div class="px-6 py-4">
    <!-- Header -->
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold text-gray-800">Manage Users</h2>
        <a href="{{ route('register') }}" class="bg-purple-600 hover:bg-purple-700 text-white px-4 py-2 rounded-lg flex items-center gap-2 transition-colors">
            <i class="fas fa-plus"></i> Add User
        </a>
    </div>

    <!-- Table -->
    <div class="bg-white rounded-lg shadow-md overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full">
                <thead class="bg-gray-50 border-b border-gray-200">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Email</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Role</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Joined</th>
                        <th class="px-6 py-3 text-left text-xs font-semibold text-gray-700 uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    @foreach($users as $user)
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="px-6 py-4 text-sm text-gray-900 font-medium">{{ $user->name }}</td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->email }}</td>
                        <td class="px-6 py-4 text-sm">
                            @if($user->role == 'admin')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-red-100 text-red-800">Admin</span>
                            @elseif($user->role == 'editor')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-blue-100 text-blue-800">Editor</span>
                            @elseif($user->role == 'author')
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-green-100 text-green-800">Author</span>
                            @else
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-semibold bg-gray-100 text-gray-800">{{ ucfirst($user->role) }}</span>
                            @endif
                        </td>
                        <td class="px-6 py-4 text-sm text-gray-600">{{ $user->created_at->format('d M Y') }}</td>
                        <td class="px-6 py-4 text-sm flex gap-2">
                            <a href="{{ route('admin.users.edit', $user) }}" class="text-orange-600 hover:text-orange-800 p-2 rounded hover:bg-orange-50 transition-colors" title="Edit">
                                <i class="fas fa-edit"></i>
                            </a>
                            @if($user->id != auth()->id())
                            <form method="POST" action="{{ route('admin.users.delete', $user) }}" class="inline" onsubmit="return confirm('Delete this user?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-600 hover:text-red-800 p-2 rounded hover:bg-red-50 transition-colors" title="Delete">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="px-6 py-4 border-t border-gray-200">
            <div class="flex justify-center">
                {{ $users->links() }}
            </div>
        </div>
    </div>
</div>
@endsection