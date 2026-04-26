<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\User;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class AdminController extends Controller
{
    public function dashboard()
    {
        $newsCount = News::count();
        $userCount = User::count();
        $publishedNews = News::where('status', 'published')->count();
        return view('admin.dashboard', compact('newsCount', 'userCount', 'publishedNews'));
    }

    public function news()
    {
        $news = News::with('author')->paginate(10);
        return view('admin.news.index', compact('news'));
    }

    public function editNews(News $news)
    {
        $news->load('tags');
        $tags = Tag::all();
        return view('admin.news.edit', compact('news', 'tags'));
    }

    public function updateNews(Request $request, News $news)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'status' => 'required|in:draft,pending,published,rejected',
            'published_at' => 'nullable|date',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $news->update($data);
        
        if ($request->has('tags')) {
            $news->tags()->sync($request->tags);
        } else {
            $news->tags()->sync([]);
        }
        
        return redirect()->route('admin.news')->with('success', 'News updated.');
    }

    public function deleteNews(News $news)
    {
        $news->delete();
        return redirect()->route('admin.news')->with('success', 'News deleted.');
    }

    public function users()
    {
        $users = User::paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function editUser(User $user)
    {
        return view('admin.users.edit', compact('user'));
    }

    public function updateUser(Request $request, User $user)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'role' => 'required|in:guest,user,author,editor,admin',
        ]);

        $user->update($data);
        return redirect()->route('admin.users')->with('success', 'User updated.');
    }

    public function deleteUser(User $user)
    {
        if ($user->id == auth()->id()) {
            return redirect()->route('admin.users')->with('error', 'Cannot delete yourself.');
        }
        $user->delete();
        return redirect()->route('admin.users')->with('success', 'User deleted.');
    }

    public function tags()
    {
        $tags = Tag::paginate(10);
        return view('admin.tags.index', compact('tags'));
    }

    public function storeTag(Request $request)
    {
        $request->validate(['name' => 'required|string|max:50|unique:tags,name']);
        Tag::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('admin.tags')->with('success', 'Tag created.');
    }

    public function editTag(Tag $tag)
    {
        return view('admin.tags.edit', compact('tag'));
    }

    public function updateTag(Request $request, Tag $tag)
    {
        $request->validate(['name' => 'required|string|max:50|unique:tags,name,' . $tag->id]);
        $tag->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);
        return redirect()->route('admin.tags')->with('success', 'Tag updated.');
    }

    public function deleteTag(Tag $tag)
    {
        $tag->delete();
        return redirect()->route('admin.tags')->with('success', 'Tag deleted.');
    }
}
