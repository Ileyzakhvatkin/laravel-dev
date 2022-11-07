@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">

            <form class="p-4 mb-3 bg-light rounded" method="POST" action="/admin/report">
                @csrf
                <h4 class="blog-post-title mb-3">Данные для отчета</h4>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="news" name="news" @if(\request()->input('news')) checked="checked" @endif>
                    <label class="form-check-label" for="news">Новости</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="articles" name="articles" @if(\request()->input('articles')) checked="checked" @endif>
                    <label class="form-check-label" for="articles">Статьи</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="comments" name="comments" @if(\request()->input('comments')) checked="checked" @endif>
                    <label class="form-check-label" for="comments">Комментарии</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="tags" name="tags" @if(\request()->input('tags')) checked="checked" @endif>
                    <label class="form-check-label" for="tags">Теги</label>
                </div>
                <div class="mb-3 form-check">
                    <input type="checkbox" class="form-check-input" id="users" name="users" @if(\request()->input('users')) checked="checked" @endif>
                    <label class="form-check-label" for="users">Пользователи</label>
                </div>
                <button type="submit" class="btn btn-outline-primary">Сформировать</button>
            </form>
            @if( isset($reportData) )
            <div class="p-4 mb-3 bg-light rounded">
                <h2 class="blog-post-title mb-3">Отчет</h2>
                <table class="table table-striped">
                    @foreach($reportData as $key => $item)
                        <tr>
                            <td>{{ $key }}</td>
                            <td>{{ $item }}</td>
                        </tr>
                    @endforeach
                </table>
            </div>
            @endif
        </div>
    </div>
@endsection
