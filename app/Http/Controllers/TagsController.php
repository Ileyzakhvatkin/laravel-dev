<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = \Cache::tags(['articles'])->remember('tag_articles', 3600, function () use ($tag)  {
            return $tag->articles()->with('tags')->latest()->get();
        });
        $news = \Cache::tags(['news'])->remember('tag_news', 3600, function () use ($tag) {
            return $tag->news()->with('tags')->latest()->get();
        });

        return view('pages.tags', [
            'articles' => $articles,
            'news' => $news,
            'page_tag' => '"' . $tag->name . '"',
        ]);
    }
}
