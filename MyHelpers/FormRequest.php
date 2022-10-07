<?php

namespace MyHelpers;

class FormRequest
{
    public function validateCreate($request)
    {
        return $request->validate([
            'slug' => 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i|unique:articles,slug',
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);
    }

    public function validateEdit($request)
    {
        return $request->validate([
            'slug' => 'required|string|max:255|regex:/^[0-9a-z\-\_]+$/i',
            'title' => 'required|min:5|max:100',
            'brief' => 'required|max:255',
            'fulltext' => 'required',
        ]);
    }
}
