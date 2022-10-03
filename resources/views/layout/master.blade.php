<!doctype html>
<html lang="ru">
    @include('layout.head')
    <body>
        <div class="container">
            @include('layout.header')
            @include('layout.nav')
        </div>
        <main role="main" class="container">
            <div class="row my-5">
                @yield('content')
                @include('layout.sidebar')
            </div><!-- /.row -->
        </main><!-- /.container -->
        @include('layout.footer')
    </body>
</html>
