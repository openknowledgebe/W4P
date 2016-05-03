<meta name="description" content="{{ $post->summary }}">
{{-- Facebook OpenGraph --}}
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="article" />
<meta property="og:title" content="{{ $post->title }}" />
@if ($settings->social->seo_image)
    <meta property="og:image" content="{{ $settings->social->seo_image }}">
@else
    <meta property="og:image" content="{{ URL::to('project/banner.jpg') }}">
@endif
<meta property="og:description" content="{{ $post->summary }}">
{{-- Dublin Core --}}
<link rel="schema.dcterms" href="http://purl.org/dc/terms/">
<meta name="dcterms.language" content="en">
<meta name="dcterms.title" content="{{ $post->title }}" />
{{-- Twitter cards --}}
 @if ($settings->social->twitter_handle != null)
     <meta name="twitter:card" content="summary">
     <meta name="twitter:site" content="{{ $settings->social->twitter_handle }}">
     <meta name="twitter:title" content="{{ $post->title }}" />
     <meta name="twitter:description" content="{{ $post->summary }}" />
     @if ($settings->social->seo_image)
         <meta name="twitter:image" content="{{ $settings->social->seo_image }}">
     @else
         <meta name="twitter:image" content="{{ URL::to('project/banner.jpg') }}">
     @endif
@endif