@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">Статьи</h3>

        @foreach ( $articles as $article )
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $article->title }}</h2>
                <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
                <p>{{ $article->brief }}</p>
                <p class="more"><a href="/article/{{ $article->slug }}">Подробнее...</a></p>
            </div><!-- /.blog-post -->
        @endforeach

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
    </div>
@endsection
