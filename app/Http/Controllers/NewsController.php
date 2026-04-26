<?php

namespace App\Http\Controllers;

use App\Models\News;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class NewsController extends Controller
{
    public function index(Request $request)
    {
        // Mulai query dengan eager loading author dan tags
        $query = News::with(['author', 'tags'])->where('status', 'published');
        
        // Filter by tag jika ada parameter tag
        if ($request->has('tag') && $request->tag) {
            $query->whereHas('tags', function($q) use ($request) {
                $q->where('slug', $request->tag);
            });
        }
        
        // Filter by search jika ada parameter search
        if ($request->has('search') && $request->search) {
            $search = $request->search;
            $query->where(function($q) use ($search) {
                $q->where('title', 'like', "%{$search}%")
                  ->orWhere('summary', 'like', "%{$search}%")
                  ->orWhere('content', 'like', "%{$search}%");
            });
        }
        
        // Urutkan dan paginate - relationships tetap terload
        $news = $query->orderBy('published_at', 'desc')->paginate(10);
        
        // Load semua tags untuk filter navigation
        $tags = Tag::all();
        
        return view('news.index', compact('news', 'tags'));
    }

    public function show($slug)
    {
        $news = News::with(['tags', 'author'])->where('slug', $slug)->where('status', 'published')->firstOrFail();
        $news->increment('views');
        return view('news.show', compact('news'));
    }

    public function create()
    {
        $tags = Tag::all();
        return view('news.create', compact('tags'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'summary' => 'nullable|string',
            'image' => 'nullable|image',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        $originalSlug = $slug;
        $count = 1;
        while (News::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $count;
            $count++;
        }
        $data['slug'] = $slug;
        $data['author_id'] = auth()->id();
        $data['status'] = 'published';
        $data['published_at'] = now();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news = News::create($data);

        if ($request->has('tags') && !empty($request->tags)) {
            $news->tags()->sync($request->tags);
        }

        return redirect()->route('news.index')->with('success', 'News created successfully.');
    }

    public function edit(News $news)
    {
        return view('news.edit', compact('news'));
    }

    public function update(Request $request, News $news)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required',
            'summary' => 'nullable|string',
            'image' => 'nullable|image',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
        ]);

        $data = $request->all();
        $slug = Str::slug($request->title);
        if ($slug !== $news->slug) {
            $originalSlug = $slug;
            $count = 1;
            while (News::where('slug', $slug)->where('id', '!=', $news->id)->exists()) {
                $slug = $originalSlug . '-' . $count;
                $count++;
            }
        }
        $data['slug'] = $slug;

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')->store('news', 'public');
        }

        $news->update($data);

        if ($request->has('tags') && !empty($request->tags)) {
            $news->tags()->sync($request->tags);
        } else {
            $news->tags()->sync([]);
        }

        return redirect()->route('news.show', $news->slug)->with('success', 'News updated successfully.');
    }

    public function destroy(News $news)
    {
        $news->delete();
        return redirect()->route('news.index')->with('success', 'News deleted successfully.');
    }
}