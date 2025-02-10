@extends('mobile::layout.master')
@section('title'){{config('metapage.Video.title')}}@endsection
@section('description'){{config('metapage.Video.description')}}@endsection
@section('keywords'){{config('metapage.Video.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Video.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Video.og:title')}}@endsection
@section('og-description'){{config('metapage.Video.og:description')}}@endsection
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

        @media (max-width: 768px ) {
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
