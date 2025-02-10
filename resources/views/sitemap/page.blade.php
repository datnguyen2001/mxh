<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
    <url>
        <loc>{{config('siteInfo.site_path')}}</loc>
        <lastmod>{{date("Y/m/d h:i:sa")}}</lastmod>
        <changefreq>always</changefreq>
        <priority>1.0</priority>
    </url>
        <url>
            <loc>{{config('siteInfo.site_path')}}/live.htm</loc>
            <lastmod>{{date("Y/m/d h:i:sa")}}</lastmod>
            <changefreq>monthy</changefreq>
            <priority>0.4</priority>
        </url>
</urlset>
