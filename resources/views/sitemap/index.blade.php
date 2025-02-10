<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<sitemapindex xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <sitemap>
        <loc>{{config('siteInfo.site_path')}}/sitemaps/category.rss</loc>
        <lastmod>{{gmdate(DATE_ISO8601)}}</lastmod>
    </sitemap>
    @for($i=1;$i<=$post/5000;$i++)
        <sitemap>
            <loc>{{config('siteInfo.site_path')}}/StaticSitemaps/{{$i}}.xml</loc>
            <lastmod>{{gmdate(DATE_ISO8601)}}</lastmod>
        </sitemap>
    @endfor
</sitemapindex>
