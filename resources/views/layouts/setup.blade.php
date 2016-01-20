<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
    </head>
    <body>
        <div class="container">
            <div class="row">
                <nav class="navbar navbar-default">
                    <div class="container-fluid">
                        <div class="navbar-header">
                            <a class="navbar-brand" href="/">{{ trans('setup.nav') }}</a>
                        </div>
                        <div>
                        </div>
                    </div>
                </nav>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
        <footer class="footer">
            <div class="container">
                <p class="text-muted small">Powered by W4P.</p>
            </div>
        </footer>
    </body>
    <script src="{{ elixir("js/core.js") }}"></script>
    <script src="{{ elixir("js/admin.js") }}"></script>
</html>