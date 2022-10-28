@include('layout.flash')
@forelse ( $posts as $post )
    <div class="blog-post">
        <h2 class="blog-post-title">{{ $post->title }}</h2>
        <p class="blog-post-meta">@datatime($post->created_at)</p>
        <p>{{ $post->brief }}</p>
        @include('layout.tags', ['tags' => $post->tags])
        <p><a class="more" href="/{{ $cat_slug }}/{{ $post->slug }}">Подробнее...</a></p>
        @canany(['update', 'admin'], $post)
            <div class="btn-group btn-group-sm">
                <a class="btn btn-outline-secondary me-2" href="/admin/{{ $cat_slug }}/{{ $post->slug }}/edit">Edit</a>
                <form class="btn-group btn-group-sm" method="POST" action="/admin/{{ $cat_slug }}/{{ $post->slug }}">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-outline-danger">Delete</button>
                </form>
            </div>
        @endcanany
    </div>
@empty
    <div class="blog-post">
        {{ $empty_post }}
    </div>
@endforelse

<nav class="blog-pagination">
    <a class="btn btn-outline-primary" href="#">Older</a>
    <a class="btn btn-outline-secondary disabled" href="#">Newer</a>
</nav>
