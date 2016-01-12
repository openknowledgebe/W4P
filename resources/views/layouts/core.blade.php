<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="/css/app.css">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/">W4P Setup</a>
                    </div>
                    <div>
                    </div>
                </div>
            </nav>
        </div>
        <div class="container">
            @yield('content')
        </div>
    </body>
    <script></script>
</html>