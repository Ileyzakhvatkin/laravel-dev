<div class="mb-3">
    <label for="slug" class="form-label">Символьный код</label>
    <input type="text" class="form-control" id="slug" name="slug"
           value="@if( isset($post) ) {{ old('slug', $post->slug) }} @else {{ old('slug') }} @endif" />
</div>
<div class="mb-3">
    <label for="title" class="form-label">Название статьи</label>
    <input type="text" class="form-control" id="title" name="title"
           value="@if( isset($post) ) {{ old('title', $post->title) }} @else {{ old('title') }} @endif" />
</div>
<div class="mb-3">
    <label for="brief" class="form-label">Краткое описание статьи</label>
    <textarea class="form-control" id="brief" name="brief" rows="2">@if( isset($post) ) {{ old('brief', $post->brief) }} @else {{ old('brief') }} @endif</textarea>
</div>
<div class="mb-3">
    <label for="fulltext" class="form-label">Детальное описание</label>
    <textarea class="form-control" id="fulltext" name="fulltext" rows="4">@if( isset($post) ) {{ old('fulltext', $post->fulltext) }} @else {{ old('fulltext') }} @endif</textarea>
</div>
@if( $cat_slug == 'article' || $cat_slug == 'news' )
    <div class="mb-3">
        <label for="tags" class="form-label">Теги</label>
        <input type="text" class="form-control" id="tags" name="tags"
               value="@if( isset($post) ) {{ old('title', $post->tags->pluck('name')->implode(',')) }} @else {{ old('tags') }} @endif" />
    </div>
@endif
<div class="mb-3 form-check">
    <input type="checkbox" class="form-check-input" id="active" name="active"
           @if( isset($post) )
               @if( $post->active ) checked @endif
           @else
               @if( old('active') ) checked @endif
           @endif
    />
    <label class="form-check-label" for="active">Опубликовано</label>
</div>
<button type="submit" class="btn btn-outline-primary">Сохранить</button>
