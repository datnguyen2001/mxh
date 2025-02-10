<?php '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<rss version="2.0" xmlns:ror="http://rorweb.com/0.1/" >
    <channel>
        <title><?php $channel['title'] ?></title>
        <link><?php $channel['link'] ?></link>
        <?php foreach ($items as $item) : ?>
            <item>
                <link><?php $item['loc'] ?></link>
                <title><?php $item['title'] ?></title>
                <ror:updated><?php date('Y-m-d\TH:i:sP', strtotime($item['lastmod'])) ?></ror:updated>
                <ror:updatePeriod><?php $item['freq'] ?></ror:updatePeriod>
                <ror:sortOrder><?php $item['priority'] ?></ror:sortOrder>
                <ror:resourceOf>sitemap</ror:resourceOf>
            </item>
        <?php endforeach; ?>
    </channel>
</rss>
