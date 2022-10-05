@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h3 class="pb-3 mb-4 font-italic border-bottom">Статьи</h3>
        <div class="alert alert-danger my-3 @if ( ! session('status') ) d-none @endif" role="alert">
            {{ session('status') }}
        </div>
        @foreach ( $articles as $article )
            <div class="blog-post">
                <h2 class="blog-post-title">{{ $article->title }}</h2>
                <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
                <p>{{ $article->brief }}</p>
                <p><a class="more" href="/article/{{ $article->slug }}">Подробнее...</a></p>
                <div class="d-flex">
                    <a class="btn btn-outline-secondary mr-2" href="/admin/article/{{ $article->slug }}/edit ">Edit</a>
                    <form method="POST" action="/admin/article/{{ $article->slug }}">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-outline-danger">Delete</button>
                    </form>
                </div>
            </div>
        @endforeach

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
    </div>
@endsection
