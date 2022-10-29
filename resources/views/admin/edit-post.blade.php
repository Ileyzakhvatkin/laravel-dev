@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $page_title }}</h2>
            @include('layout.errors')
            @include('layout.flash')
            <form class="my-5" method="POST" action="/admin/{{ $cat_slug }}/{{ $post->slug }}">
                @csrf
                @method('PATCH')
                @include('admin.post-form-fields')
            </form>
            @if( isset($post) && $post instanceof \App\Models\Article )
                @include('layout.post-history', ['post' => $post])
            @endif
        </div>
    </div>
@endsection
