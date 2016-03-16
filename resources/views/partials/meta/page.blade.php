{{-- Facebook OpenGraph --}}
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="product" />
<meta property="og:title" content="{{ $page->title }}" />
{{-- Dublin Core --}}
<link rel="schema.dcterms" href="http://purl.org/dc/terms/">
<meta name="dcterms.language" content="en">
<meta name="dcterms.title" content="{{ $page->title }}" />
{{-- Twitter cards --}}
 @if ($settings->social->twitter_handle != null)
     <meta name="twitter:card" content="player">
     <meta name="twitter:site" content="{{ $settings->social->twitter_handle }}">
     <meta name="twitter:title" content="{{ $page->title }}" />
     @if ($settings->social->seo_image)
         <meta name="twitter:image" content="{{ $settings->social->seo_image }}">
     @else
         <meta name="twitter:image" content="{{ URL::to('project/banner.jpg') }}">
     @endif
@endif