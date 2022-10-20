<div class="alert alert-danger my-3 @if ( ! session('status') ) d-none @endif" role="alert">
    {{ session('status') }}
</div>
@forelse ( $articles as $article )
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $article->title }}</h2>
        <p class="blog-post-meta">@datatime($article->created_at)</p>
        <p>{{ $article->brief }}</p>
        @include('layout.tags', ['tags' => $article->tags])
        <p><a class="more" href="/article/{{ $article->slug }}">Подробнее...</a></p>
        @canany(['update', 'admin'], $article)
            <div class="btn-group btn-group-sm">
                <a class="btn btn-outline-secondary me-2" href="/admin/article/{{ $article->slug }}/edit ">Edit</a>
                <form class="btn-group btn-group-sm" method="POST" action="/admin/article/{{ $article->slug }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        @endcanany
    </div>
@empty
    <div class="blog-post">
        На сайте не опубликовано ни одной статьи!
    </div>
@endforelse

<nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
</nav>
