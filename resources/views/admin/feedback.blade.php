@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <h2 class="blog-post-title">Список обращений пользователей</h2>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">Создано</th>
                    <th scope="col">E-mail</th>
                    <th scope="col">Сообщение</th>
                </tr>
            </thead>
            <tbody>
                @foreach ( $messages as $message )
                    @include('admin.item-message')
                @endforeach
            <tbody>
        </table>
    </div>
@endsection
