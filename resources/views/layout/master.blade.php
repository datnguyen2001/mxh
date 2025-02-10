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
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    @include('layout.shared.page-config')
    @yield('css')
    <style>
        .box-ad-tnv{
            margin-bottom: 20px;
        }
        .mb-20{
            margin-bottom: 20px;
        }
        .mt-20{
            margin-top: 20px;
        }
        .mt-10{
            margin-top: 10px;
        }
        .tn-banner img{
            height: auto;
            margin: auto;
        }
        .mw-300{
            max-width: 300px;
        }
        .ft-nguon{
            float: right;
            position: relative;
            top: -20px;
            text-align: center;
        }
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
        .header__menu .flex-menu .item-menu-expan .child-menu-hover {
            min-width: 150px;
            width: max-content;
        }
    </style>
</head>
<body>
<div id="admWrapsite">
{{--    @include('layout.shared.ads-tracking')--}}
{{--    @include('layout.shared.ga')--}}
{{--    @include('layout.shared.ads-core')--}}
    @include('layout.header2')
    <div class="main">
        @yield('content')
    </div>
    @include('layout.footer2')
    @yield('js')
{{--    <script type="text/javascript">--}}
{{--        if ('serviceWorker' in navigator) {--}}
{{--            window.addEventListener('load', () => {--}}
{{--                navigator.serviceWorker.register('sw.js')--}}
{{--                    .then(swReg => {--}}
{{--                        console.log('Service Worker is registered', swReg);--}}
{{--                    })--}}
{{--                    .catch(err => {--}}
{{--                        console.error('Service Worker Error', err);--}}
{{--                    });--}}
{{--            });--}}
{{--        }--}}
{{--    </script>--}}
{{--    <div>--}}
{{--        <input type="hidden" name="dbcheck" id="dbcheck" value="{{env('SITE_ID','0').env('APP_ENV','0')}}">--}}
{{--    </div>--}}
    <div id="backToTop" class="back-to-top">
        <img src="{{asset('image/arrow-top-page.png')}}" alt="">
    </div>
    <script>
        $(document).ready(function () {
            const backToTop = $('#backToTop');

            $(window).scroll(function () {
                if ($(this).scrollTop() > 300) {
                    backToTop.addClass('show');
                } else {
                    backToTop.removeClass('show');
                }
            });

            backToTop.click(function () {
                $('html, body').animate({ scrollTop: 0 }, 500);
            });
        });
    </script>
</div>
</body>
</html>
