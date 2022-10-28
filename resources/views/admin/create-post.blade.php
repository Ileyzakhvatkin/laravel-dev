@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">{{ $page_title }}</h2>
            @include('layout.errors')
            @include('layout.flash')
            <form class="my-5 @if ( session('status') ) d-none @endif"  method="POST" action="/admin/{{ $cat_slug }}">
                @csrf
                @include('admin.post-form-fields')
            </form>
        </div>
    </div>
@endsection
