<h2>Комментарии к статье</h2>
<div>Всего коментариев к статье: </div>
@forelse ( $comments as $comment )
    <div class="comment">
        <div class="comment__data">@datatime($comment->created_at)</div>
        <div class="comment__author">{{ $comment->author }}</div>
        <div class="comment__text">{{ $comment->comment }}</div>
    </div>
@empty
    <div class="blog-post">
        К этой статье пока нет комментариев!
    </div>
@endforelse
