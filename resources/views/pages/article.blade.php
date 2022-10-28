@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $article->title }}</h2>
            <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
            <p>{{ $article->fulltext }}</p>
            @include('layout.tags', ['tags' => $article->tags])
            <hr>
            @include('layout.comments-list', ['comments' => $article->comments])
            @include('layout.comments-form', ['slug' => $article->slug])
            <hr>
            <p><a href="/">Все статьи</a></p>
        </div>
    </div>
@endsection
