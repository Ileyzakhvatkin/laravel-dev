@component('mail::message')
# Создана новая статья: {{ $article->title }}

{{ $article->brief }}

@component('mail::button', ['url' => '/article/' . $article->slug])
Почитать статью
@endcomponent

Thanks,<br>
{{ config('app.name') }}
@endcomponent
