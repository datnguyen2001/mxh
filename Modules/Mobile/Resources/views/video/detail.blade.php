@extends('mobile::layout.master')
@section('title'){{(!empty($videoFocus->MetaTitle))?$videoFocus->MetaTitle:$videoFocus->Name}}@endsection
@section('description'){{$videoFocus->Description.$videoFocus->Name.' VIDEO CLIP'}}@endsection
@section('keywords'){{(!empty($videoFocus->MetaKeyword))?$videoFocus->MetaKeyword:$videoFocus->Tags}}@endsection
@section('news_keywords'){{(!empty($videoFocus->MetaNewsKeyword))?$videoFocus->MetaNewsKeyword:''}}@endsection
@section('og-title'){{(!empty($videoFocus->MetaTitle))?$videoFocus->MetaTitle:$videoFocus->Name}}@endsection
@section('og-description'){{$videoFocus->Description.$videoFocus->Name.' VIDEO CLIP'}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Video.og:image')}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss/video.rss'}}@endsection
@section('css')
    @include('mobile::expert.Css-detail')
    <style>
    .clock_ico {
        margin-right: 5px;
    }

    .VCSortableInPreviewMode[type="VideoStream"] .AfPlayer,
    .VCSortableInPreviewMode[type="VideoStream"] .BetaAfPlayer,
    .VCSortableInPreviewMode[type="VideoStream"] .videoNewsPlayer {
        padding-top: 56.26% !important;
        height: 0 !important;
    }

    .iframe-resize iframe {
        width: 100% !important;
        max-height: 450px !important;
    }

    @media (max-width: 768px) {
        .iframe-resize iframe {
            width: 100% !important;
            max-height: 430px !important;
        }

        .iframe-resize:before {
            padding-bottom: unset;
        }
    }

    @media (max-width: 425px) {
        .iframe-resize iframe {
            width: 100% !important;
            max-height: 237px !important;
        }
    }

    .iframe-resize {
        padding-top: 0 !important;
    }
    </style>
    @include('schema.SchemaVideoIndex')
@endsection
@section('js')
    @include('mobile::expert.Js-detail')
@endsection
@section('content')

<div class="configHidden">
    {!!$ZoneInfoClientScript!!}
</div>
@endsection
