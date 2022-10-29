@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $post->title }}</h2>
            <p class="blog-post-meta">{{ $post->created_at }}</p>
            <p>{{ $post->fulltext }}</p>
            @include('layout.tags', ['tags' => $post->tags])
            <hr>
            @if( isset($post) && $post instanceof \App\Models\Article )
                @include('layout.comments-list', ['comments' => $post->comments])
                @include('layout.comments-form', ['slug' => $post->slug])
            @endif
            <hr>
            <p><a href="{{ $return_url }}">Все публикации</a></p>
        </div>
    </div>
@endsection
