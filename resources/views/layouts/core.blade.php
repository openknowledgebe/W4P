<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
    </head>
    <body>
        <div class="container">
            <nav class="navbar navbar-default navbar-fixed-top">
                <div class="container">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="">
                            <img src="{{ URL::to('/organisation/logo.png') }}" class="navlogo" />
                        </a>
                    </div>
                    <div>
                        <ul class="nav navbar-nav">
                            <li>
                                <a href="{{ URL::route('home') }}">{{ \W4P\Models\Setting::get('platform.name') }}</a>
                            </li>
                            <li>
                                <a href="">{{ trans('backoffice.project') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#">NL</a>
                            </li>
                            <li>
                                <a href="#">EN</a>
                            </li>
                            <li>
                                <a href="#">FR</a>
                            </li>
                        </ul>
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
</html>