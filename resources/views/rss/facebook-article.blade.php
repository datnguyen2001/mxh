<?php '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:media="http://search.yahoo.com/mrss/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:georss="http://www.georss.org/georss" version="2.0">
    <channel>
        <title>{{ $site['name']??'' }}</title>
        <link>{{ $site['url']??'' }}</link>
        <description><![CDATA[{{ $site['description']??'' }}]]></description>
        <language>{{ $site['language']??'' }}</language>
        <lastBuildDate>{{ $site['lastBuildDate']??'' }}</lastBuildDate>
        @if(!empty($posts))
            @foreach($posts as $post)
                <item>
                    <title>
                        <![CDATA[{!! $post->title??'' !!}]]>
                    </title>
                    <link>{{$post->link??''}}</link>
                    <guid>{{$post->link??''}}</guid>
                    <pubDate>{{ $post->Date??''}}</pubDate>
                    <author>{{ $post->Author??''}}</author>
                    <description>
                        <![CDATA[{!! $post->description??'' !!}]]>
                    </description>
                    <content:encoded>
                        <![CDATA[  @if(!empty($post->Body)){!!$post->Body !!}@endif ]]>
                    </content:encoded>
                </item>
            @endforeach
        @endif
    </channel>
</rss>
