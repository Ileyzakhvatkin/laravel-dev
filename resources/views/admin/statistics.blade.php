@extends('layout.master')

@section('content')
    <div class="col-md-8 blog-main">
        <div class="blog-post">
            <h2 class="blog-post-title mb-3">Статистика портала</h2>
            <table class="table table-striped">
                <tr>
                    <td>Общее количество статей</td>
                    <td>
                        @if( $statisticsData['countArticles'] > 0 )
                            {{ $statisticsData['countArticles'] }}
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Общее количество новостей</td>
                    <td>
                        @if( $statisticsData['countNews'] > 0 )
                            {{ $statisticsData['countNews'] }}
                        @else
                            на сайте нет новостей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>ФИО автора, у которого больше всего статей на сайте</td>
                    <td>
                        @if( is_object($statisticsData['bestAuthor']) )
                            {{ $statisticsData['bestAuthor']->name }} (всего статей 000 )
                        @else
                            на сайте авторов со статьями
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая длинная статья</td>
                    <td>
                        @if( is_object($statisticsData['longestArticle']) )
                            <a href="/article/{{ $statisticsData['longestArticle']->slug }}" target="_blank">{{ $statisticsData['longestArticle']->title }}</a>
                            (символов - {{ mb_strlen($statisticsData['longestArticle']->fulltext) }})
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая короткая статья</td>
                    <td>
                        @if( is_object($statisticsData['shortestArticle']) )
                            <a href="/article/{{ $statisticsData['shortestArticle']->slug }}" target="_blank">{{ $statisticsData['shortestArticle']->title }}</a>
                            (символов - {{ mb_strlen($statisticsData['shortestArticle']->fulltext) }})
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Средние количество статей у активных пользователей</td>
                    <td>
                        @if( $statisticsData['averageArticle'] > 0 )
                            {{ $statisticsData['averageArticle'] }}
                        @else
                            на сайте нет статей
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая непостоянная статья</td>
                    <td>
                        @if( $statisticsData['historyArticle']->history_count > 0 )
                            <a href="/article/{{ $statisticsData['historyArticle']->slug }}" target="_blank">{{ $statisticsData['historyArticle']->title }}</a>  (обновлений - {{ $statisticsData['historyArticle']->history_count }} )
                        @else
                            нет отредактированных статей на сайте
                        @endif
                    </td>
                </tr>
                <tr>
                    <td>Самая обсуждаемая статья</td>
                    <td>
                        @if( $statisticsData['commentsArticle']->comments_count > 0 )
                            <a href="/article/{{ $statisticsData['commentsArticle']->slug }}" target="_blank">{{ $statisticsData['commentsArticle']->title }}</a>  (комментариев - {{ $statisticsData['commentsArticle']->comments_count }} )
                        @else
                            нет коментариев
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    </div>
@endsection
