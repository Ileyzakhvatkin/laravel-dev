@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h1 class="pb-3 mb-4 font-italic border-bottom">Статьи</h1>
        <div class="alert alert-danger my-3 @if ( ! session('status') ) d-none @endif" role="alert">
            {{ session('status') }}
        </div>
        @foreach ( $articles as $article )
            <div class="blog-post">
                <h3 class="blog-post-title">{{ $article->title }}</h3>
                <p class="blog-post-meta">{{ $article->created_at->toFormattedDateString() }}</p>
                <p>{{ $article->brief }}</p>
                @include('layout.tags', ['tags' => $article->tags])
                <p><a class="more" href="/article/{{ $article->slug }}">Подробнее...</a></p>
                @can('update', $article)
                    <div class="btn-group btn-group-sm">
                        <a class="btn btn-outline-secondary me-2" href="/admin/article/{{ $article->slug }}/edit ">Edit</a>
                        <form class="btn-group btn-group-sm" method="POST" action="/admin/article/{{ $article->slug }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger">Delete</button>
                        </form>
                    </div>
                @endcan
            </div>
        @endforeach

        <nav class="blog-pagination">
            <a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
        </nav>
    </div>
@endsection
