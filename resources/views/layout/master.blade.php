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
                @section('sidebar')
                    @include('layout.sidebar')
                @show
            </div><!-- /.row -->
        </main><!-- /.container -->
        @include('layout.footer')
    </body>
</html>
