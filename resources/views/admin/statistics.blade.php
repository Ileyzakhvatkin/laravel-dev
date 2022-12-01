@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title mb-3">Статистика портала</h2>
            <table class="table table-striped">
                <tr>
                    <td>Общее количество статей</td>
                    <td>
                        @if( isset($statData['countArticles']) && $statData['countArticles'] > 0 )
                            {{ $statData['countArticles'] }}
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Общее количество новостей</td>
                    <td>
                        @if( isset($statData['countNews']) && $statData['countNews'] > 0 )
                            {{ $statData['countNews'] }}
                        @else
                            на сайте нет новостей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>ФИО автора, у которого больше всего статей на сайте</td>
                    <td>
                        @if( is_object($statData['bestAuthor']) )
                            {{ $statData['bestAuthor']->name }} (всего статей {{ $statData['bestAuthor']->articles_count }} )
                        @else
                            на сайте авторов со статьями
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая длинная статья</td>
                    <td>
                        @if( is_object($statData['longestArticle']) )
                            <a href="/article/{{ $statData['longestArticle']->slug }}" target="_blank">{{ $statData['longestArticle']->title }}</a>
                            (символов - {{ $statData['longestArticle']->text_count }})
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая короткая статья</td>
                    <td>
                        @if( is_object($statData['shortestArticle']) )
                            <a href="/article/{{ $statData['shortestArticle']->slug }}" target="_blank">{{ $statData['shortestArticle']->title }}</a>
                            (символов - {{ $statData['shortestArticle']->text_count}})
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Средние количество статей у активных пользователей</td>
                    <td>
                        @if( isset($statData['averageArticle']) && $statData['averageArticle'] > 0 )
                            {{ $statData['averageArticle'] }}
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая непостоянная статья</td>
                    <td>
                        @if( isset($statData['historyArticle']) && $statData['historyArticle']->history_count > 0 )
                            <a href="/article/{{ $statData['historyArticle']->slug }}" target="_blank">{{ $statData['historyArticle']->title }}</a>  (обновлений - {{ $statData['historyArticle']->history_count }} )
                        @else
                            нет отредактированных статей на сайте
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая обсуждаемая статья</td>
                    <td>
                        @if( isset($statData['commentsArticle']) && $statData['commentsArticle']->comments_count > 0 )
                            <a href="/article/{{ $statData['commentsArticle']->slug }}" target="_blank">{{ $statData['commentsArticle']->title }}</a>  (комментариев - {{ $statData['commentsArticle']->comments_count }} )
                        @else
                            на сайте нет коментариев
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
