<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class TagsController extends Controller
{
    public function index(Tag $tag)
    {
        $data = \Cache::tags(['tags'])->remember('tag_' . $tag->id, 3600, function () use ($tag)  {
            return [
                'articles' => $tag->articles()->with('tags')->latest()->get(),
                'news' => $tag->news()->with('tags')->latest()->get()
            ];
        });

        return view('pages.tags', [
            'articles' => $data['articles'],
            'news' => $data['news'],
            'page_tag' => '"' . $tag->name . '"',
            'empty_post' => 'Нет материалов по этому тегу',
        ]);
    }
}
