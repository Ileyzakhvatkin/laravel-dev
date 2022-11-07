@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h1 class="pb-3 mb-4 font-italic border-bottom">Публикации по тегу: {{ $page_tag }}</h1>
        <hr>
        @include('layout.post-list', ['posts' => $articles, 'cat_slug' => 'article',])
        <h1 class="pb-3 mb-4 font-italic border-bottom">Новости по тегу: {{ $page_tag }}</h1>
        @include('layout.post-list', ['posts' => $news, 'cat_slug' => 'news',])
        <hr>
    </div>
@endsection
