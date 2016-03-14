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
            <div itemscope itemtype="http://schema.org/VideoObject" class="hidden">
                <span itemprop="name">{{ $project->title }}</span>
                <span itemprop="description">{{ $project->brief }}</span>
                <img itemprop="thumbnailUrl" src="{{ URL::to('project/banner.jpg') }}" alt=""/>
                <link itemprop="contentUrl" href="{{ $project->video_url }}" />
            </div>
    @endif
@endif