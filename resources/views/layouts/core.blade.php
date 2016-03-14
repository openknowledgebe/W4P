<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <title>@yield('title')</title>
        <link rel="stylesheet" href="{{ elixir('css/app.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Istok+Web:400,400italic,700,700italic' rel='stylesheet' type='text/css'>
        @if (isset($project))
            <!-- FB OG -->
            <meta property="og:url" content="{{ Request::url() }}" />
            <meta property="og:type" content="product" />
            <meta property="og:title" content="{{ $project->title }}" />
            <meta property="og:description" content="{{ $project->brief }}" />
            <!-- Dublin Core -->
            <link rel="schema.dcterms" href="http://purl.org/dc/terms/">
            <meta name="dcterms.language" content="en">
            <meta name="dcterms.title" content="{{ $project->title }}" />
            <!-- Twitter cards -->
            <meta name="twitter:card" content="player">
            <meta name="twitter:site" content="{{ $settings['twitter'] }}">
            <meta name="twitter:title" content="{{ $project->title }}">
            <meta name="twitter:description" content="{{ $settings['twitter_message'] }}">
            @if ($video_provider != null)
                <meta name="twitter:image" content="{{ URL::to('project/banner.jpg') }}">
                <meta name="twitter:player:width" content="1280">
                <meta name="twitter:player:height" content="720">
                <meta name="twitter:player:stream" content="{{ $project->video_url }}">
                <meta name="twitter:player:stream:content_type" content="video/mp4">
                <!-- Google Structured Data -->
                <div itemscope itemtype="http://schema.org/VideoObject">
                    <span itemprop="name">{{ $project->title }}</span>
                    <span itemprop="description">{{ $project->brief }}</span>
                    <img itemprop="thumbnailUrl" src="{{ URL::to('project/banner.jpg') }}" alt=""/>
                    <link itemprop="contentUrl" href="{{ $project->video_url }}" />
                </div>
            @endif
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
                                        <a href="">{{ trans('generic.how_does_it_work') }}</a>
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
    @yield('scripts')
</html>