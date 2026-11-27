<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NewsPost;
use App\Support\Slug;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class NewsController extends Controller
{
    public function index(): View
    {
        return view('admin.news.index', [
            'posts' => NewsPost::orderByDesc('published_at')->get(),
        ]);
    }

    public function create(): View
    {
        return view('admin.news.form', [
            'post' => new NewsPost([
                'category' => config('bcrl.news_categories')[0],
                'published_at' => now(),
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        $data['slug'] = Slug::unique($request->filled('slug') ? $request->string('slug')->toString() : $data['title'], 'news_posts');

        NewsPost::create($data);

        return redirect()->route('admin.news.index')->with('status', 'News post created.');
    }

    public function edit(NewsPost $news): View
    {
        return view('admin.news.form', ['post' => $news]);
    }

    public function update(Request $request, NewsPost $news): RedirectResponse
    {
        $data = $this->validated($request);
        unset($data['slug']);
        if ($request->filled('slug')) {
            $data['slug'] = Slug::unique($request->string('slug')->toString(), 'news_posts', $news->id);
        }

        $news->update($data);

        return redirect()->route('admin.news.index')->with('status', 'News post updated.');
    }

    public function destroy(NewsPost $news): RedirectResponse
    {
        $news->delete();

        return redirect()->route('admin.news.index')->with('status', 'News post deleted.');
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'title' => ['required', 'string', 'max:180'],
            'slug' => ['nullable', 'string', 'max:200'],
            'category' => ['required', Rule::in(config('bcrl.news_categories'))],
            'excerpt' => ['required', 'string', 'max:400'],
            'body' => ['required', 'string', 'max:10000'],
            'youtube_url' => ['nullable', 'url', 'max:500'],
            'published_at' => ['required', 'date'],
        ]);
    }
}
