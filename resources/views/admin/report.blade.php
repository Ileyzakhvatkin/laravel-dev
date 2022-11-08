@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <div class="p-4 mb-3 bg-light rounded">
                <form method="POST" action="/admin/report">
                    @csrf
                    <h4 class="blog-post-title mb-3">Посчитать сколько на сайте</h4>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="news" name="news"
                               @if( session('report') && in_array('news', session('report')) ) checked="checked" @endif>
                        <label class="form-check-label" for="news">Новостей</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="articles" name="articles"
                               @if( session('report') && in_array('articles', session('report')) ) checked="checked" @endif>
                        <label class="form-check-label" for="articles">Статей</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="comments" name="comments"
                               @if( session('report') && in_array('comments', session('report')) ) checked="checked" @endif>
                        <label class="form-check-label" for="comments">Комментариев</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="tags" name="tags"
                               @if( session('report') && in_array('tags', session('report')) ) checked="checked" @endif>
                        <label class="form-check-label" for="tags">Тегов</label>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="users" name="users"
                               @if( session('report') && in_array('users', session('report')) ) checked="checked" @endif>
                        <label class="form-check-label" for="users">Пользователей</label>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Сгенерировать отчёт</button>
                </form>
                @include('layout.flash')
            </div>
        </div>
    </div>
@endsection
