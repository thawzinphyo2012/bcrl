<?php

namespace App\Http\Controllers;

use App\Models\NewsPost;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(Request $request): View
    {
        $category = $request->string('category')->toString();
        if (! in_array($category, config('bcrl.news_categories'), true)) {
            $category = null;
        }

        $posts = NewsPost::query()
            ->when($category, fn ($query) => $query->where('category', $category))
            ->orderByDesc('published_at')
            ->paginate(9)
            ->withQueryString();

        return view('news.index', [
            'posts' => $posts,
            'category' => $category,
        ]);
    }

    public function show(NewsPost $post): View
    {
        return view('news.show', [
            'post' => $post,
            'others' => NewsPost::query()
                ->whereKeyNot($post->id)
                ->orderByDesc('published_at')
                ->take(3)
                ->get(),
        ]);
    }
}
