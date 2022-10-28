<?php

namespace App\Http\Controllers;

use App\Models\Article;
use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleCommentsContriller extends Controller
{
    public function store(Article $article)
    {
        $this->validate(request(), [
            'comment' => 'required|max:500|min:20',
        ]);

        Comment::create([
         'article_id' => $article->id,
         'author_id' => Auth::user()->id,
         'comment' => \request('comment'),
         'active' => 1,
        ]);

        flash('Ваш коментарий создан!', 'success');

        return back();
    }
}
