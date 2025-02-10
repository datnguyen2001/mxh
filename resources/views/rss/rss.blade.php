<?php '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<rss version="2.0" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:media="http://search.yahoo.com/mrss/">
    <channel>
        <title>{{ $site['name']??'' }}</title>
        <link>{{ $site['url']??'' }}</link>
        <description><![CDATA[{{ $site['description']??'' }}]]></description>
        <atom:link href="{{ $site['urlRss']??$site['url'] }}" rel="self" type="application/rss+xml" />
        <copyright>{{ $site['copyright']??'' }}</copyright>
        <generator>{{ $site['generator']??'' }}</generator>
        <pubDate>{{ $site['pubDate']??'' }}</pubDate>
        <language>{{ $site['language']??'' }}</language>
        <lastBuildDate>{{ $site['lastBuildDate']??'' }}</lastBuildDate>
        <image>
            <url>{{ $site['image']['url']??'' }}</url>
            <title>{{ $site['image']['title']??'' }}</title>
            <link>{{ $site['image']['link']??'' }}</link>
        </image>
        <atom:link href="{{ $site['url']??'' }}" rel="self" type="application/rss+xml"/>
        <ttl>15</ttl>
        @if(!empty($posts))
            @foreach($posts as $post)
                <item>
                    <title><![CDATA[{!! $post->title??'' !!}]]></title>
                    <link>{{$post->link??''}}</link>
                    <description><![CDATA[{!! $post->description??'' !!}]]></description>
                    <pubDate>{{ $post->Date??''}}</pubDate>
                    <guid >{{$post->link??''}}</guid>
                </item>
            @endforeach
        @endif
    </channel>
</rss>
