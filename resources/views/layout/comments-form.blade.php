@auth
    <hr>
    @include('layout.flash')
    @include('layout.errors')
    <form method="POST" acrion="/article/{{ $slug }}/comments">
        @csrf
        <div class="mb-3">
            <label for="comment" class="form-label">Напиши свой комментарии к статье</label>
            <textarea class="form-control" id="comment" name="comment" rows="4">{{ old('comment') }}</textarea>
        </div>
        <button type="submit" class="btn btn-outline-secondary">Отправить</button>
    </form>
@endauth
