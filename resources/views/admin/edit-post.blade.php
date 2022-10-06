@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Страница редактирования статьи</h2>
            @include('layout.errors')
            <div class="alert alert-success my-3 @if ( ! session('status') ) d-none @endif" role="alert">
                {{ session('status') }}
            </div>
            <form class="my-5"  method="POST" action="/admin/article/{{ $article->slug }}">
                @csrf
                @method('PATCH')
                @include('admin.post-form-fields')
            </form>
        </div>
    </div>
@endsection
