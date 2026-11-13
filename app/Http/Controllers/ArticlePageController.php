<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Category;
use Illuminate\Http\Request;

class ArticlePageController extends Controller
{
    public function index()
    {
        $articles = Article::with(['author', 'category'])
            ->where('status', 'published')
            ->latest('published_at')
            ->get();

        return view('artikel', compact('articles'));
    }

    public function show($slug)
    {
        $article = Article::with(['author', 'category'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        $article->increment('views');

        $categories = Category::withCount('articles')->get();

        $popular = Article::where('status', 'published')
            ->orderByDesc('views')
            ->take(5)
            ->get();

        $related = Article::with('category')
            ->where('status', 'published')
            ->where('category_id', $article->category_id)
            ->where('id', '!=', $article->id)
            ->latest('published_at')
            ->take(3)
            ->get();

        return view('artikel.show', compact('article', 'categories', 'popular', 'related'));
    }

    public function storeComment(Request $request, Article $article)
    {
        return back()->with('error', 'Komentar pada artikel belum didukung.');
    }
}