@extends('mobile::layout.media-master')
@section('title'){{ $headname  }}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Media.og:title')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss/multimedia.rss'}}@endsection
@section('css')
    @include('mobile::expert.Css-list')
    @include('mobile::media.SchemaCat')
@endsection
@section('js')
    @include('mobile::expert.Js-list')
@endsection
@section('content')
    <div class="main">
        <div class="list__media-tab">
            <a href="/multimedia/longform.htm" class="item {{ ($type==27)?"active":"" }}" title="Longform">Longform</a>
            <a href="/multimedia/infographic.htm" class="item {{ ($type==20)?"active":"" }}" title="Infographic">Infographic</a>
            <a href="/multimedia/tin-anh.htm" class="item {{ ($type==29)?"active":"" }}" title="Tin ảnh">Tin ảnh</a>
        </div>
        <div class="list__media-listing">
            <div class="container">
                    <div class="box-category box-border-top" data-layout="15" data-cd-key="{{ env('SITE_ID') }}newsbytype:type{{ $type }}" data-cd-top="{{10}}">
                     <div class="box-category-middle">
                    <x-mobile::media.box-template15 :listNews="$listNews">
                    </x-mobile::media.box-template15>
                         <div class="box-stream-item box-stream-item-load"></div>
                    </div>
                </div>
                @if(!empty($listNews) && count($listNews) == 10)
                    <div class=" box-stream-load fb-loading-wrapper" style="display: none">
                        <div class="fblw-timeline-item">
                            <div class="fblwti-animated">
                                <div class="fblwtia-mask fblwtia-title-line fblwtia-title-mask-0"></div>
                                <div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sapo-line-0"></div>
                                <div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-0"></div>
                                <div class="fblwtia-mask fblwtia-title-line fblwtia-title-mask-1"></div>
                                <div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sapo-line-1"></div>
                                <div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-1"></div>
                                <div class="fblwtia-mask fblwtia-front-mask fblwtia-front-mask-2"></div>
                                <div class="fblwtia-mask fblwtia-sapo-line fblwtia-sapo-line-2"></div>
                                <div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-2"></div>
                                <div class="fblwtia-mask fblwtia-front-mask fblwtia-front-mask-3"></div>
                                <div class="fblwtia-mask fblwtia-sapo-line fblwtia-sapo-line-3"></div>
                                <div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-3"></div>
                                <div class="fblwtia-mask fblwtia-front-mask fblwtia-front-mask-4"></div>
                                <div class="fblwtia-mask fblwtia-sapo-line fblwtia-sapo-line-4"></div>
                                <div class="fblwtia-mask fblwtia-sepline-sapo fblwtia-sepline-sapo-4"></div>
                            </div>
                        </div>
                    </div>
                    <div class="layout__viewmore list__viewmore list__center">
                        <a class="btn-viewmore">
                            Xem thêm
                            <span class="icon">
                <svg width="13" height="8" viewBox="0 0 13 8" fill="none"
                     xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M12.833 1.69935L11.7997 0.666016L6.49967 5.96602L1.19967 0.666016L0.166341 1.69935L6.49967 7.99935L12.833 1.69935Z"
                        fill="white"></path>
                </svg>
                </span>
                        </a>
                    </div>
                @endif
            </div>

        </div>
    </div>

    <div class="configHidden">
        {!! $ZoneInfoClientScript !!}
    </div>
@endsection
