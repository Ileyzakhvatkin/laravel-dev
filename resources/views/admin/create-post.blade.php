@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Страница добавления новой статьи</h2>
            @include('layout.errors')
            <form class="my-5 @if ( session('status') ) d-none @endif"  method="POST" action="/admin/article">
                @csrf
                @include('admin.post-form-fields')
            </form>
            <div class="alert alert-success my-3 @if ( ! session('status') ) d-none @endif" role="alert">
                {{ session('status') }} <a href="/admin/article/create">Продолжить...</a>
            </div>
        </div>
    </div>
@endsection
