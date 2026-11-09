<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::query()
            ->where('is_published', true)
            ->when($request->filled('q'), function ($query) use ($request) {
                $query->where('title', 'like', '%' . $request->input('q') . '%');
            })
            ->when($request->filled('category'), function ($query) use ($request) {
                $query->where('category', $request->input('category'));
            })
            ->orderByDesc('is_pinned')
            ->latest('published_at')
            ->paginate(10) // 10 per page (5 top, 5 bottom)
            ->withQueryString();

        $categories = Post::query()
            ->distinct()
            ->orderBy('category')
            ->pluck('category');

        return view('posts.index', compact('posts', 'categories'));
    }

    public function show($id)
    {
        $post = Post::findOrFail($id);

        if (! $post->is_published) {
            abort(404);
        }

        $post->increment('views');

        return view('posts.show', compact('post'));
    }
}
