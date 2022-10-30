@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title mb-3">Статистика портала</h2>
            <table class="table table-striped">
                @foreach($statisticsData as $key => $item)
                    <tr>
                        <td>{{ $key }}</td>
                        <td>
                            @if( is_object($item) )
                                <a href="/article/{{ $item->slug }}" target="_blank">{{ $item->title }}</a> ({{ $item->item_count }})
                            @else
                                {{ $item }}
                            @endif
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
@endsection
