<div class="nav-scroller py-1 mb-2">
    <nav class="nav d-flex justify-content-between">
        <a class="p-2 text-muted" href="/">Главная</a>
        <a class="p-2 text-muted" href="/about">О нас</a>
        <a class="p-2 text-muted" href="/contacts">Контакты</a>
        @auth
            <a class="p-2 text-muted" href="/admin/article/create">Создать статью</a>
        @endauth
        @admin
            <a class="p-2 text-muted" href="/admin/feedback">Обращения</a>
        @endadmin
        @auth
            <a class="p-2 text-muted" href="/admin/article">Все статьи</a>
        @endauth
    </nav>
</div>
