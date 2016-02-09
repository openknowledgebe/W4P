<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        @if (isset($project))
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="product" />
        <meta property="og:title" content="{{ $project->title }}" />
        <meta property="og:description" content="{{ $project->brief }}" />
        @endif
    </head>
    <body>
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    <nav class="navbar navbar-default">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <a class="navbar-brand" href="{{ URL::route('home') }}">
                                    <img src="{{ URL::to('/platform/logo.png') }}" class="navlogo" />
                                </a>
                            </div>
                            <div>
                                <ul class="nav navbar-nav">
                                    <li @if (Request::is('/')) class="active" @endif>
                                        <a href="{{ URL::route('home') }}">{{ $W4P_project->title }}</a>
                                    </li>
                                    <li>
                                        <a href="">{{ trans('core.howdoesitwork') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>

                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            <div class="content">
                @yield('content')
            </div>
        </div>
        @include('partials.footer')
    </body>
    <script src="{{ elixir("js/core.js") }}"></script>
</html>