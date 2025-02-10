<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>@yield('title')</title>
    @include('layout.shared.meta-seo')
    <meta name="robots" content="@yield('Robots','index, follow')" />
    <meta http-equiv="refresh" content="3600" />
    <meta name="Language" content="vi" />
    <meta name="distribution" content="Global" />
    <meta name="revisit-after" content="1 days" />
    <meta name="GENERATOR" content="{{config('siteInfo.site_path')}}">
    <meta name="RATING" content="GENERAL" />
    <link rel="shortcut icon" href="{{config('siteInfo.favicon')}}" type="image/png">
    <meta name="site_path" content="{{config('siteInfo.site_path')}}">
    <meta name="author" content="{{ config('siteInfo.author') }}">
    <meta name="og:site_name" content="{{ config('siteInfo.site_name') }}">
    <meta name="copyright" content="Copyright (c) by {{config('siteInfo.copyright')}}" />
    <meta http-equiv="x-dns-prefetch-control" content="on" />
    <link rel="dns-prefetch" href="https://static.mediacdn.vn/">
    <link rel="dns-prefetch" href="{{env('THUMB_DOMAIN')}}">
    <link rel="dns-prefetch" href="https://videothumbs.mediacdn.vn/">
    <link rel="dns-prefetch" href="https://videothumbs-ext.mediacdn.vn/">
    @yield('css')
    @include('layout.shared.page-config')
    @include('layout.shared.ads-tracking')
    @include('layout.shared.ga')
    @include('layout.shared.ads-core')
</head>
<body>
@yield('content')
</body>
</html>
