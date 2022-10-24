@component('mail::message')
    За указанный период c @datatime($startData) по @datatime($endData) на сайте {{ config('app.name') }} были созданы статьи:
    <table>
        <thead>
            <tr>
                <td>Дата</td>
                <td>Заголоаок</td>
            </tr>
        </thead>
        <tbody>
            @foreach ($articles as $article )
                <tr>
                    <td>@datatime($article->created_at)</td>
                    <td>{{ $article->title }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endcomponent
