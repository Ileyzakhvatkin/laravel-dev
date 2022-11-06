@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h1 class="pb-3 mb-4 font-italic border-bottom">{{ $page_title }}</h1>
        @include('layout.post-list')
        {{ $posts->links() }}
    </div>
@endsection
