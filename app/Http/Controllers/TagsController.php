<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $articles = $tag->articles()->with('tags')->latest()->get();
        $news = $tag->news()->with('tags')->latest()->get();

        return view('pages.tags', [
            'articles' => $articles,
            'news' => $news,
            'page_tag' => '"' . $tag->name . '"',
        ]);
    }
}
