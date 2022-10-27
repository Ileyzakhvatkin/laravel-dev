<h4 class="my-3">Комментарии к статье</h4>

@forelse ( $comments as $comment )
    <div class="comment bg-light mb-3 p-3">
        <div class="d-flex justify-content-between mb-3">
            <div class="comment__author">Автор: {{ $comment->author->name }}</div>
            <div class="comment__data">Дата: @datatime($comment->created_at)</div>
        </div>
        <div class="comment__text">{{ $comment->comment }}</div>
    </div>
@empty
    <div class="blog-post">
        К этой статье пока нет комментариев!
    </div>
@endforelse

<div class="mb-2">Всего коментариев к статье: {{ $comments->count() }}</div>
