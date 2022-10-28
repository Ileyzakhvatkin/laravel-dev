<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $posts = $tag->articles()->with('tags')->latest()->simplePaginate(10);

        return view('index', [
            'posts' => $posts,
            'page_title' => 'Публикации по тегу: "' . $tag->name . '"',
            'cat_slug' => 'article',
        ]);
    }
}
