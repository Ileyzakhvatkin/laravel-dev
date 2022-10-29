<?php

namespace App\Services;

use App\Models\Article;
use Illuminate\Http\Request;

class FormRequest
{
    public function postCreate(Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i|unique:articles,slug',
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);

        return [
            'slug' => $request->slug,
            'owner_id' => auth()->id(),
            'title' => $request->title,
            'brief' => $request->brief,
            'fulltext' => $request->brief,
            'active' => (bool)$request->active,
        ];
    }

    public function postEdit($post, Request $request)
    {
        $request->validate([
            'slug' => 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i',
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);

        $post->slug = $request->slug;
        $post->owner_id = auth()->id();
        $post->title = $request->title;
        $post->brief = $request->brief;
        $post->fulltext = $request->brief;
        $post->active = (bool)$request->active;
        $post->save();
    }
}
