<?php

namespace App\Services;

use App\Models\Article;

class FormRequest
{
    public function articleCreate($request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i|unique:articles,slug',
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);

        return [
            'slug' => $request->slug,
            'title' => $request->title,
            'brief' => $request->brief,
            'fulltext' => $request->brief,
            'active' => (bool)$request->active
        ];
    }

    public function articleEdit(Article $article, $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i',
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);

        $article->slug = $request->slug;
        $article->title = $request->title;
        $article->brief = $request->brief;
        $article->fulltext = $request->brief;
        $article->active = (bool)$request->active;
        $article->save();
    }
}
