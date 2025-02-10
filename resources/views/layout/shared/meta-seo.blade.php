    <meta name="description" content="@yield('description')">
    <meta name="keywords" content="@yield('keywords')">
    <meta name="news_keywords" content="@yield('keywords')">
    <meta property="og:title" content="@yield('title')">
    <meta property="og:description" content="@yield('description')">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="@yield('OgUrl')" />
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
    <link rel="canonical" href="@yield('OgUrl')"/>
@if(View::hasSection('Link-rss'))
    <link rel="alternate" type="application/rss+xml" href="@yield('Link-rss')" title="@yield('og-title')"/>
@endif
@endif
@if(!empty(config('siteInfo.alternateMob')))
    <link  rel="alternate" media="only screen and (max-width: 640px)"  href="{{config('siteInfo.alternateMob').Request::getPathInfo()}}" />
    <link rel="alternate" media="handheld" href="{{config('siteInfo.alternateMob').Request::getPathInfo()}}" />
@endif
@if(!empty(config('siteInfo.fb_appid')))
    <meta prefix="fb: http://ogp.me/ns/fb#" property="fb:app_id" content="{{config('siteInfo.fb_appid')}}" />
@endif
@if(!empty(config('siteInfo.google_site_verification')))
    <meta name="google-site-verification" content="{{config('siteInfo.google_site_verification')}}" />
@endif
    @if(View::hasSection('published_time'))
        <meta property="article:published_time" content="@yield('published_time')" />
    @endif
    @if(View::hasSection('article_author'))
        <meta property="article:author" content="@yield('article_author')" />
    @endif
