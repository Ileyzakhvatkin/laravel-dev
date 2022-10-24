@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Отправка Push уведомлений</h2>
            @include('layout.errors')
            @include('layout.flash')
            <form class="my-5" method="POST" action="/admin/service">
                @csrf
                <div class="mb-3">
                    <label for="inputTitle" class="form-label">Заголовок уведомления</label>
                    <input type="text" class="form-control" id="inputTitle" name="title" value="{{ old('title') }}" >
                </div>
                <div class="mb-3">
                    <label for="inputText" class="form-label">Текст уведомления</label>
                    <textarea class="form-control" id="inputText" name="text" rows="3" value="{{ old('text') }}" ></textarea>
                </div>

                <button type="submit" class="btn btn-outline-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection
