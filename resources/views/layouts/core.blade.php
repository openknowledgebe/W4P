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
                        <a class="navbar-brand" href="/">{{ \W4P\Models\Setting::get('platform.name') }}</a>
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
                <span class="text-muted">
                    Powered by <a href="https://github.com/openknowledgebe/W4P">W4P</a>.
                </span>
                <span class="pull-right text-muted">
                    <a href="{{ URL::route('admin::index') }}">Administration</a>
                </span>
            </div>
        </footer>
    </body>
    <script src="{{ elixir("js/core.js") }}"></script>
</html>