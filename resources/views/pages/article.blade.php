@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
            <p>{{ $article->fulltext }}</p>
            <hr>
            <p><a href="/">Все статьи</a></p>
        </div>
    </div>
@endsection
