@extends('mobile::layout.master')
@section('title'){{config('metapage.Media.title')}}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Media.og:title')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss/multimedia.rss'}}@endsection
@section('css')
    <script type="text/javascript">
        var _ADM_Channel = '%2fmedia%2f';
    </script>
    @include('mobile::expert.Css-list')
    @include('mobile::media.SchemaCat')
    <style>
        .breadcumb-display {
            display: none;
        }
    </style>
@endsection
@section('js')
    @include('mobile::expert.Js-list')
@endsection
@section('content')
{{--    <div class="topads">--}}
{{--        <x-layout.box-ads nameAds="TopBanerMb"></x-layout.box-ads>--}}
{{--    </div>--}}

    <div class="layout__breadcrumb">
        <div class="container dev_custorm">
            <div class="swiper-container breadcrumb-swiper">
                <div class="swiper-wrapper">
                    <div class="swiper-slide">
                        <a class="nav-link upp" href="/" title="trang chu">
                            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M9.87473 4.88267C10.056 4.6833 10.0385 4.37773 9.83565 4.20034L5.36651 0.289823C5.16366 0.112428 4.83844 0.116144 4.63985 0.298201L0.155529 4.40883C-0.0430547 4.59089 -0.0528013 4.89606 0.133949 5.09018L0.246377 5.20727C0.4329 5.40139 0.734393 5.42453 0.91935 5.25881L1.25448 4.95868V9.35255C1.25448 9.62213 1.47292 9.84037 1.7423 9.84037H3.49031C3.75969 9.84037 3.97813 9.62213 3.97813 9.35255V6.27862H6.20772V9.35255C6.20384 9.62194 6.39659 9.84018 6.66598 9.84018H8.51842C8.7878 9.84018 9.00624 9.62194 9.00624 9.35235V5.02055C9.00624 5.02055 9.09882 5.10166 9.213 5.20202C9.327 5.30219 9.56642 5.22187 9.7477 5.02231L9.87473 4.88267Z" fill="#333333" />
                            </svg>
                        </a>
                    </div>
                    <div class="swiper-slide">
                        <a class="nav-link upp" href="/media/cong-dan-magazine.{{env('CAT_FILENAME')}}" title="Công dân magazine">Công dân magazine</a>
                    </div>
                    <div class="swiper-slide">
                        <a class="nav-link " href="/cong-dan-magazine/emagazine.{{env('CAT_FILENAME')}}" title="E-MAGAZINE">E-MAGAZINE</a>
                    </div>
                    <div class="swiper-slide">
                        <a class="nav-link " href="/cong-dan-magazine/infographic.{{env('CAT_FILENAME')}}" title="infographic">Infographic</a>
                    </div>
                    <div class="swiper-slide">
                        <a class="nav-link active" href="/cong-dan-magazine/photo-story.{{env('CAT_FILENAME')}}" title="Photo story">Photo story</a>
                    </div>
                </div>
                <div class="swiper-breadcrumb-next">
                </div>
            </div>
        </div>
    </div>
    <!-- tin noi bat to -->
    <x-mobile::media.box-focus-top :listNews="$listNewsFocus"></x-mobile::media.box-focus-top>

    <x-layout.box-ads nameAds="Medium1Mb"></x-layout.box-ads>
    <!-- tin noi bat nho -->
    <div class="home__category">
        <div class="container">
            <div class="box-category box-border-top" data-layout="3" data-cd-key="{{env('SITE_ID')}}newsbytype:type29">
                <x-mobile::media.box-list-focus :listNews="$listNewsFocus"></x-mobile::media.box-list-focus>
                <div class="box-stream-item box-stream-item-load"></div>
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
            </div>
            <div class="box-viewmore list__viewmore list__center">
                <a href="javascript:;" class="btn-viewmore" title="Xem thêm">Xem thêm</a>
            </div>
        </div>
    </div>

    <!--infographic-->
    <x-mobile::media.box-template1 :listNews="$NewsInfographic">
        <x-slot name="zoneName">infographic</x-slot>
        <x-slot name="url">/cong-dan-magazine/infographic.{{env('CAT_FILENAME')}} </x-slot>
    </x-mobile::media.box-template1>
    <x-layout.box-ads nameAds="Medium2Mb"></x-layout.box-ads>
    <!--emagazine-->
    <x-mobile::media.box-template1 :listNews="$NewsEmagazine">
        <x-slot name="zoneName">E-MAGAZINE</x-slot>
        <x-slot name="url">/cong-dan-magazine/emagazine.{{env('CAT_FILENAME')}} </x-slot>
    </x-mobile::media.box-template1>


    <div class="list__bg-gray">
        <!--Công dân & Khuyến học TV -->
        <x-mobile::media.box-template2 :listNews="$zoneData1" :infoCat="$zoneInfo1">
            <x-slot name="url">/cong-dan-khuyen-hoc-tv.{{env('CAT_FILENAME')}}</x-slot>
        </x-mobile::media.box-template2>

        <!-- podcasts-->
        <x-mobile::media.box-template3 :listNews="$zoneData2" :infoCat="$zoneInfo2"></x-mobile::media.box-template3>


    </div>

        <div class="configHidden">
            {!!$ZoneInfoClientScript!!}
        </div>
@endsection
