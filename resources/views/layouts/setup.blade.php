<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">{{ trans('setup.nav') }}</a>
                    </div>
                    <div>
                    </div>
                </div>
            </nav>
            <div>
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted small">Powered by W4P.</p>
            </div>
        </footer>
    </body>
    <script src="{{ elixir("js/all.js") }}"></script>
</html>