<hr>
<h4>История изменений статьи</h4>
    @forelse($article->history as $item)
        <div class="bg-light p-3 my-3">
            <div class="alert alert-primary">{{ $item->name }} - {{ $item->pivot->created_at->diffForHumans() }}</div>
            <div class="alert alert-secondary">{{ $item->pivot->before }}</div>
            <div class="alert alert-success">{{ $item->pivot->after }}</div>
        </div>
    @empty
        <p>У данной статьи не было изменений</p>
    @endforelse
<hr>

