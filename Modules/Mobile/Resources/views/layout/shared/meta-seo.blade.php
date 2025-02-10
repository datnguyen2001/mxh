<meta name="description" content="@yield('description')">
<meta name="keywords" content="@yield('keywords')">
<meta name="news_keywords" content="@yield('news_keywords')">
<meta property="og:title" content="@yield('og-title')">
<meta property="og:description" content="@yield('og-description')">
<meta property="og:type" content="article" />
<meta property="og:url" content="{{config('siteInfo.site_path').Request::getPathInfo()}}" />
@if(View::hasSection('OgImage'))
    <meta property="og:image" content="@yield('OgImage')" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
@else
    <meta property="og:image" content="@yield('OgImage')" />
@endif
<meta property="twitter:image" content="@yield('OgImage')" />
<meta property="twitter:card" content="summary_large_image" />
@if(View::hasSection('Canonical'))
    <link rel="canonical" href="@yield('Canonical')" />
@else
    <link rel="canonical" href="{{config('siteInfo.site_path').Request::getPathInfo()}}"/>
    @if(View::hasSection('Link-rss'))
        <link rel="alternate" type="application/rss+xml" href="@yield('Link-rss')" title="@yield('og-title')"/>
    @endif
@endif
