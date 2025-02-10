<?php '<'.'?'.'xml version="1.0" encoding="UTF-8"?>'."\n"; ?>
<rss xmlns:content="http://purl.org/rss/1.0/modules/content/" xmlns:dc="http://purl.org/dc/elements/1.1/" xmlns:media="http://search.yahoo.com/mrss/" xmlns:atom="http://www.w3.org/2005/Atom" xmlns:georss="http://www.georss.org/georss" version="2.0">
    <channel>
        <title>{{ $site['name']??'' }}</title>
        <link>{{ $site['url']??'' }}</link>
        <description><![CDATA[{{ $site['description']??'' }}]]></description>
        <language>{{ $site['language']??'' }}</language>
        @if(!empty($posts))
            @foreach($posts as $post)
            <item>
                <title>
                    <![CDATA[{!! $post->title??'' !!}]]>
                </title>
                <link>{{$post->link??''}}</link>
                <pdalink>{{$post->link??''}}</pdalink>
                <guid>{{$post->link??''}}</guid>
                <pubDate>{{ $post->Date??''}}</pubDate>
                <media:keywords>
                    <![CDATA[{{ (!empty($post->TagItem)?$post->TagItem:$post->title) }}]]>
                </media:keywords>
                <media:rating scheme="urn:simple">nonadult</media:rating>
                <author>{{ $post->Author??''}}</author>
                <category>
                    <![CDATA[ {!! $post->ZoneName ??''!!}]]>
                </category>
                <enclosure url="{{$post->ThumbImage??''}}" type="image/jpeg"/>
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
