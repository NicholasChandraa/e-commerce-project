<?php

namespace App\Http\Controllers;

use App\Models\ArticleCategory;
use Illuminate\Http\Request;

class ArticleCategoryController extends Controller
{
    public function index()
    {
        $categories = ArticleCategory::all();
        return view('article_categories.index', compact('categories'));
    }

    public function create()
    {
        return view('article_categories.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        ArticleCategory::create($request->all());

        return redirect()->route('article-categories.index')->with('success', 'Kategori berhasil dibuat.');
    }

    public function edit(ArticleCategory $articleCategory)
    {
        return view('article_categories.edit', compact('articleCategory'));
    }

    public function update(Request $request, ArticleCategory $articleCategory)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        $articleCategory->update($request->all());

        return redirect()->route('article-categories.index')->with('success', 'Kategori berhasil diperbarui.');
    }

    public function destroy(ArticleCategory $articleCategory)
    {
        $articleCategory->delete();

        return redirect()->route('article-categories.index')->with('success', 'Kategori berhasil dihapus.');
    }
}
