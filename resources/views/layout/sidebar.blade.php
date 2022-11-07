<aside class="col-md-4 blog-sidebar">
    @auth
    <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">Author Pannel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="p-2 text-muted" href="/admin/article/create">Создать статью</a>
            </li>
            <li class="nav-item">
                <a class="p-2 text-muted" href="/admin/article">Все мои статьи</a>
            </li>
        </ul>
    </div>
    @endauth
    @admin
    <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">Admin Pannel</h4>
        <ul class="nav flex-column">
            <li class="nav-item">
                <a class="p-2 text-muted" href="/admin/feedback">Обращения</a>
            </li>
            <li class="nav-item">
                <a class="p-2 text-muted" href="/admin/news/create">Создать новость</a>
            </li>
            <li class="nav-item">
                <a class="p-2 text-muted" href="/admin/service">Уведомления</a>
            </li>
            <li class="nav-item">
                <a class="p-2 text-muted" href="/admin/statistics">Статистика</a>
            </li>
            <li class="nav-item">
                <a class="p-2 text-muted" href="/admin/report">Отчет</a>
            </li>
        </ul>
    </div>
    @endadmin
    <div class="p-3 mb-3 bg-light rounded">
        <h4 class="font-italic">Теги</h4>
        @include('layout.tags', ['tags' => $tagsCloud])
    </div>
</aside>
