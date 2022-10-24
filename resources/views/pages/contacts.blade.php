@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title">Контакты</h2>
            @include('layout.errors')
            <form class="my-5" method="POST" action="/contacts">
                @csrf
                <div class="mb-3">
                    <label for="inputMail" class="form-label">Ваш Email</label>
                    <input type="email" class="form-control" id="inputMail" name="mail" value="{{ old('mail') }}" >
                </div>
                <div class="mb-3">
                    <label for="inputMessage" class="form-label">Ваше сообщение</label>
                    <textarea class="form-control" id="inputMessage" name="message" rows="3" value="{{ old('message') }}" ></textarea>
                </div>

                <button type="submit" class="btn btn-outline-primary">Отправить</button>
            </form>
        </div>
    </div>
@endsection
