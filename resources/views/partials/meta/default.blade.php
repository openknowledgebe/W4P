{{-- If no project is available, do not generate any meta tags --}}
@if (isset($project))
        {{-- Fetch the video information --}}
        {{ $project->getVideoInformation() }}
        {{-- Facebook OpenGraph --}}
        <meta property="og:url" content="{{ Request::url() }}" />
        <meta property="og:type" content="product" />
        @if ($settings->social->seo_title)
            {{-- Use SEO title --}}
            <meta property="og:title" content="{{ $settings->social->seo_title }}" />
        @else
            {{-- Use project title --}}
            <meta property="og:title" content="{{ $project->title }}" />
        @endif
        @if ($settings->social->seo_description)
            {{-- Use SEO desc --}}
            <meta property="og:description" content="{{ $settings->social->seo_description }}" />
        @else
            {{-- Use project desc --}}
            <meta property="og:description" content="{{ $project->brief }}" />
        @endif

        {{-- Dublin Core --}}
        <link rel="schema.dcterms" href="http://purl.org/dc/terms/">
        <meta name="dcterms.language" content="en">
            @if ($settings->social->seo_title)
                {{-- Use SEO title --}}
                <meta property="dcterms.title" content="{{ $settings->social->seo_title }}" />
            @else
                {{-- Use project title --}}
                <meta name="dcterms.title" content="{{ $project->title }}" />
            @endif

        {{-- Twitter Cards --}}
        @if ($settings->social->twitter_handle != null)
            <meta name="twitter:card" content="player">
            <meta name="twitter:site" content="{{ $settings->social->twitter_handle }}">

            @if ($settings->social->seo_title)
                {{-- Use SEO title --}}
                <meta name="twitter:title" content="{{ $settings->social->seo_title }}" />
            @else
                {{-- Use project title --}}
                <meta name="twitter:title" content="{{ $project->title }}" />
            @endif
            @if ($settings->social->seo_description)
                {{-- Use SEO desc --}}
                <meta name="twitter:description" content="{{ $settings->social->seo_description }}" />
            @else
                {{-- Use project desc --}}
                <meta name="twitter:description" content="{{ $project->brief }}" />
            @endif
            @if ($video_provider == null)
                @if ($settings->social->seo_image)
                    <meta name="twitter:image" content="{{ $settings->social->seo_image }}">
                @else
                    <meta name="twitter:image" content="{{ URL::to('project/banner.jpg') }}">
                @endif
            @endif
            {{-- If video provider --}}
            @if ($video_provider != null)
                <meta name="twitter:player:width" content="1280">
                <meta name="twitter:player:height" content="720">
                <meta name="twitter:player" content="{{ $project->video_embed }}">
                <meta name="twitter:image" content="{{ $project->video_thumb }}">
            @endif
        @endif
    @if ($video_provider != null)
    <!-- Google Structured Data -->
    <div itemscope itemtype="http://schema.org/VideoObject" class="hidden">
        <span itemprop="name">{{ $project->title }}</span>
        <span itemprop="description">{{ $project->brief }}</span>
        <img itemprop="thumbnailUrl" src="{{ $project->video_thumb }}" alt=""/>
        <link itemprop="contentUrl" href="{{ $project->video_url }}" />
    </div>
    @endif
@endif