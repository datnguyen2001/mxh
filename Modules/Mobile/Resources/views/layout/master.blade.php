<!DOCTYPE html>
<html lang="vi">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=5, user-scalable=1, minimal-ui"/>
    <title>@yield('title')</title>
    @include('layout.shared.meta-seo')
    <meta name="robots" content="@yield('Robots', 'index, follow')" />
    <meta http-equiv="refresh" content="3600" />
    <meta name="Language" content="vi" />
    <meta name="distribution" content="Global" />
    <meta name="revisit-after" content="1 days" />
    <meta name="GENERATOR" content="{{ config('siteInfo.site_path') }}">
    <meta name="RATING" content="GENERAL" />
    <link rel="shortcut icon" href="{{ config('siteInfo.favicon') }}" type="image/png">
    <meta name="site_path" content="{{ config('siteInfo.site_path') }}">
    <meta name="author" content="{{ config('siteInfo.site_path') }}">
    <meta name="copyright" content="Copyright (c) by {{ config('siteInfo.site_path') }}" />
    <meta name="og:site_name" content="{{ config('siteInfo.site_name') }}">
    <meta http-equiv="x-dns-prefetch-control" content="on" />
    <link rel="dns-prefetch" href="https://static.mediacdn.vn/">
    <link rel="dns-prefetch" href="{{env('THUMB_DOMAIN')}}">
    <link rel="dns-prefetch" href="https://videothumbs.mediacdn.vn/">
    <link rel="dns-prefetch" href="https://videothumbs-ext.mediacdn.vn/">
    @include('mobile::layout.shared.page-config')
    @yield('css')
    <style>
        video.lozad-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            bottom: 0;
            margin: auto;
            background-size: cover;
            background-position: center;
            object-fit: cover;
        }
        .kbwscwl-relatedbox.type-8.autopro,a[href="https://www.facebook.com/autoprovn"]
        {
            display: none !important;
        }
    </style>
</head>
<body>
<div id="admWrapsite">
    @include('mobile::layout.shared.ads-tracking')
    @include('mobile::layout.shared.ga')
    @include('mobile::layout.shared.ads-core')
    @include('mobile::layout.header')
    <div class="main ">
        @yield('content')
    </div>
    @include('mobile::layout.footer')
    @yield('js')
    <script type="text/javascript">
        if ('serviceWorker' in navigator) {
            window.addEventListener('load', () => {
                navigator.serviceWorker.register('sw.js')
                    .then(swReg => {
                        console.log('Service Worker is registered', swReg);
                    })
                    .catch(err => {
                        console.error('Service Worker Error', err);
                    });
            });
        }
    </script>
    <div>
        <input type="hidden" name="dbcheck" id="dbcheck" value="{{env('SITE_ID','0').env('APP_ENV','0')}}">
    </div>
</div>
</body>
</html>
