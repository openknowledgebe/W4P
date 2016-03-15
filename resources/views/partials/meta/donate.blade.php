<!-- FB OG -->
<meta property="og:url" content="{{ Request::url() }}" />
<meta property="og:type" content="product" />
<meta property="og:title" content="{{ trans('donation.') }}" />
<meta property="og:description" content="{{ trans('donation.') }}" />
<!-- Dublin Core -->
<link rel="schema.dcterms" href="http://purl.org/dc/terms/">
<meta name="dcterms.language" content="en">
<meta name="dcterms.title" content="{{ trans('donation.') }}" />
<!-- Twitter cards -->
<meta name="twitter:card" content="player">
<meta name="twitter:site" content="{{ $settings['twitter'] }}">
<meta name="twitter:title" content="{{ $project->title }}">
<meta name="twitter:description" content="{{ $settings['twitter_message'] }}">