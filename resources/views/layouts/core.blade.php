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
                                <a href="{{ URL::route('home') }}">{{ trans('core.project') }}</a>
                            </li>
                            <li>
                                <a href="">{{ trans('core.howdoesitwork') }}</a>
                            </li>
                        </ul>
                    </div>
                    <div>
                        <ul class="nav navbar-nav navbar-right">
                            <li>
                                <a href="#">Language</a>
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