<!DOCTYPE html>
<html lang="vi" xmlns="http://www.w3.org/1999/xhtml" xmlns:og="http://ogp.me/ns#" xmlns:fb="http://www.facebook.com/2008/fbml" itemscope="itemscope" itemtype="http://schema.org/NewsArticle">
<head id="Head1" prefix="og: http://ogp.me/ns# fb: http://ogp.me/ns/fb# article: http://ogp.me/ns/article#">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta name="keywords" content="@yield('keywords')"/>
    <meta name="news_keywords" content="@yield('news_keywords')"/>
    <meta name="description" content="@yield('og-description')"/>
    <meta property="og:type" content="article" />
    <meta prefix="fb: http://ogp.me/ns/fb#" property="fb:app_id" content="{{config('siteInfo.fb_appid')}}" />
    <meta property="og:title" content="@yield('og-title')">
    <meta property="og:description" content="@yield('og-description')">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="@yield('OgUrl')" />
    <meta property="og:image" content="@yield('OgImage')" />
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="@yield('OgUrl')"/>
    <meta property="twitter:title" content="@yield('og-title')" />
    <meta property="twitter:description" content="@yield('og-description')"/>
    <meta property="twitter:image" content="@yield('OgImage')" />
    <meta property="article:author" content="{{config('siteInfo.site_path')}}" />
    <meta property="article:publisher" content="{{config('siteInfo.site_path')}}" />
    <meta name="robots" content="noindex,nofollow" />
    <link rel="image_src" href="@yield('OgImage')" />
</head>
<body>
</body>
</html>
