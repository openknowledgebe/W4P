<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <meta name="viewport" content="width=device-width, initial-scale=1">
        {{-- Elixir is responsible for the versioned css so you'll need npm :) --}}
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        {{-- Google Web Fonts are inserted here --}}
        <link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        {{-- Check if the meta section exists --}}
        @if (array_key_exists('meta', View::getSections()))
            {{-- If the meta section exists, it is rendered here --}}
            @yield('meta')
        @else
            {{-- Otherwise, use the default meta partial --}}
            @include('partials.meta.default')
        @endif
    </head>
    <body>
        {{-- WRAPPER --}}
        <div class="wrapper">
            <div class="container">
                <div class="row">
                    {{-- NAVIGATION --}}
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
                                    <li @if (Request::is('how-it-works')) class="active" @endif>
                                        <a href="{{ URL::route('how') }}">{{ trans('generic.how_does_it_work') }}</a>
                                    </li>
                                </ul>
                            </div>
                            <div>
                                <ul class="nav navbar-nav navbar-right">
                                    <li>
                                        {{-- For now, the navbar on the right remains empty --}}
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
            {{-- MAIN CONTENT --}}
            <div class="content">
                @yield('content')
            </div>
        </div>
        @include('partials.footer')
    </body>
    <script src="{{ elixir("js/core.js") }}"></script>
    @yield('scripts')
</html>