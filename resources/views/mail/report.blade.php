@component('mail::message')
    <h2>Отчет о материалах опубликованных на сайте</h2>
    <table >
        @foreach($reportData as $key => $item)
            <tr>
                <td>{{ $key }}</td>
                <td>{{ $item }}</td>
            </tr>
        @endforeach
    </table>
@endcomponent
