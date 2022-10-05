<?php

namespace MyHelpers;

class ArticleValidate
{
    public function __construct($request, $unique)
    {
        $slug = $unique ? 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i|unique:articles,slug' : 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i';
        return $request->validate([
            'slug' => $slug,
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);
    }
}
