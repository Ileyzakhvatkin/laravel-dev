@php
    /*
     * Проверка на сеществование коллекции
     * */
    $tags = $tags ?? collect();
@endphp
@if( $tags->isNotEmpty() )
    <div class="btn-group btn-group-sm mb-3 d-flex flex-wrap">
        @foreach( $tags as $tag )
            <a href="{{ route('tags-page', ['tag' => $tag->name] ) }}" class="badge bg-success me-1 mb-2">{{ $tag->name }}</a>
        @endforeach
    </div>
@endif
