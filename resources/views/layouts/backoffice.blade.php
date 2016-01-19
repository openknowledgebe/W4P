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
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ URL::route('admin::index') }}">{{ trans('backoffice.dashboard') }}</a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin::project') }}">{{ trans('backoffice.project') }}</a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin::organisation') }}">{{ trans('backoffice.organisation') }}</a>
                            </li>
                            <li>
                                <a href="{{ URL::route('admin::platform') }}">{{ trans('backoffice.platform') }}</a>
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
        @include('partials.footer')
    </body>
    <script src="{{ elixir("js/core.js") }}"></script>
    <script src="{{ elixir("js/admin.js") }}"></script>

    <script>
        options.extraParams = {
            "token": "{{ W4P\Models\Setting::get('token') }}"
        };
        $('textarea.allowsinline').inlineattachment(options);
        $('input.dtp').datetimepicker({
            format:'Y-m-d H:i',
            formatTime:'H:i',
            formatDate:'Y-m-d'
        });
    </script>
</html>