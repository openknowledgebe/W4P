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
                        <a class="navbar-brand" href="/">{{ \W4P\Models\Setting::get('platform.name') }}</a>
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ URL::route('admin::index') }}">{{ trans('backoffice.dashboard') }}</a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin::project') }}">{{ trans('backoffice.project') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('backoffice.organisation') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('backoffice.posts') }}</a>
                            </li>
                            <li>
                                <a href="#">{{ trans('backoffice.backers') }}</a>
                            </li>
                        </ul>
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
    <script></script>
</html>