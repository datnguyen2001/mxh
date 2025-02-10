@extends('layout.master')
@section('title'){{ config('metapage.Home.title') }}@endsection
@section('description'){{ config('metapage.Home.description') }}@endsection
@section('keywords'){{ config('metapage.Home.keywords') }}@endsection
@section('news_keywords'){{ config('metapage.Home.news_keywords') }}@endsection
@section('og-title'){{ config('metapage.Home.og:title') }}@endsection
@section('og-description'){{ config('metapage.Home.og:description') }}@endsection
@section('OgUrl'){{ config('siteInfo.site_path').Request::getPathInfo() }}@endsection
@section('OgImage'){{ config('metapage.Home.og:image') }}@endsection
@section('Link-rss'){{ config('siteInfo.site_path') . '/rss/home.rss' }}@endsection
@section('logo_home')
@endsection
@section('css')
@if(!empty($boxFocusHome1))
    @foreach($boxFocusHome1 as $item)<link rel="preload" href="{!! $item->ThumbImage !!}" as="image" fetchpriority="high">@endforeach
@endif
@if(!empty($boxFocusHome2))
    @foreach($boxFocusHome2 as $item)<link rel="preload" href="{!! $item->ThumbImage !!}" as="image" fetchpriority="high">@endforeach
@endif
    @include('expert.Css-home')
    @include('schema.SchemaHome')
@endsection
@section('js')
    @include('expert.Js-home')
@endsection
@section('content')
<div id="home-xam" class="hidden"></div>

<div class="home__focus-hm">
    <div class="container">
        <div class="box-flex-focus">
            <div class="box-left">
                <x-template::box-layout1 :listNews="$boxFocusHome1" zoneInfo="">
                    <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}newsposition:zoneid0type1</x-slot>
                    <x-slot name="cdTop">3</x-slot>
                </x-template::box-layout1>
            </div>

            <div class="box-right">
                <x-template::box-layout2 :listNews="$boxFocusHome2">
                    <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}newsposition:zoneid0type1</x-slot>
                    <x-slot name="cdTop">4</x-slot>
                </x-template::box-layout2>
            </div>
        </div>
        <div class="mb-20">
            <!-- Ads Top_TNV Zone -->
            <zone id="m15w8p32"></zone>
            <script src="//media1.admicro.vn/cms/arf-m15w8p32.min.js"></script>
            <!-- / Ads Zone -->
        </div>
    </div>
</div>

<div class="home__stream">
    <div class="container">
        <div class="stream-flex">
            <div class="box-left-stream">
                <x-template::box-layout3 :listNews="$listStreamHome">
                    <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}newsinzoneisonhome:zone0</x-slot>
                    <x-slot name="cdTop">10</x-slot>
                </x-template::box-layout3>
            </div>

            <div class="box-right-stream">
                <div class="box-category-layout-flex">
                    <div class="col-left">
{{--                        <x-template::box-layout4 :listNews="$boxMostView">--}}
{{--                            <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}highestviewnews:zoneid0hour48</x-slot>--}}
{{--                            <x-slot name="cdTop">4</x-slot>--}}
{{--                        </x-template::box-layout4>--}}

                        <x-template::box-layout4 :listNews="$dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['data']??''" :zoneInfo="$dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['info']??''">
                            <x-slot name="cdKey">{{$dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['cdKey']??''}}</x-slot>
                            <x-slot name="cdTop">4</x-slot>
                        </x-template::box-layout4>

                    </div>

                    <div class="col-right">
                        <x-template::box-layout5 :listNewsPapers="$boxAnpham"  >
                            <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}magazine:type2</x-slot>
                            <x-slot name="cdTop">1</x-slot>
                            <x-slot name="zoneName">Ấn phẩm</x-slot>
                            <x-slot name="zoneUrl">/an-pham.htm </x-slot>
                        </x-template::box-layout5>
                    </div>
                </div>

                <div class="box-interface">
                    <x-template::box-layout6 :listNews="$dataByZone['thoi-su']['data']??''" :zoneInfo="$dataByZone['thoi-su']['info']??''" >
                        <x-slot name="cdKey">{{$dataByZone['thoi-su']['cdKey']??''}}</x-slot>
                        <x-slot name="cdTop">{{$dataByZone['thoi-su']['cdTop']??''}}</x-slot>
                    </x-template::box-layout6>
                </div>

                <div class="box-category-layout-flex">
                    @if(!empty($boxEmagazine))
                    <div class="col-left">
                        <x-template::box-layout7 :listNews="$boxEmagazine" :zoneInfo="''" >
                            <x-slot name="cdKey"></x-slot>
                            <x-slot name="cdTop">2</x-slot>
                            <x-slot name="zoneName">Emagazine </x-slot>
                            <x-slot name="zoneUrl">/emagazine.htm </x-slot>
                            <x-slot name="icon">
                                <span class="icon">
                                  <svg width="16" height="16" viewBox="0 0 16 16" fill="none"
                                       xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_119_7362)">
                                      <path
                                          d="M6.35894 1.54956L9.42888 5.04753L14.0529 4.50562L11.6734 8.50439L13.6204 12.7312L9.07999 11.7047L5.66115 14.8638L5.2339 10.2299L1.17384 7.95655L5.44927 6.11386L6.35894 1.54956Z"
                                          stroke="#ED2024" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                    </g>
                                    <defs>
                                      <clipPath id="clip0_119_7362">
                                        <rect width="16" height="16" fill="white" />
                                      </clipPath>
                                    </defs>
                                  </svg>
                                </span>
                            </x-slot>

                        </x-template::box-layout7>
                    </div>
                    @endif
                    <div class="col-right">
                        <x-template::box-layout5 :listNewsPapers="$boxTapchi"  >
                            <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}magazine:type1</x-slot>
                            <x-slot name="cdTop">1</x-slot>
                            <x-slot name="zoneName">Tạp chí</x-slot>
                            <x-slot name="zoneUrl">/tap-chi.htm </x-slot>
                        </x-template::box-layout5>
                    </div>
                </div>

                <div class="box-interface">
                    <x-template::box-layout6 :listNews="$dataByZone['gioi-tre']['data']??''" :zoneInfo="$dataByZone['gioi-tre']['info']??''" >
                        <x-slot name="cdKey">{{$dataByZone['gioi-tre']['cdKey']??''}}</x-slot>
                        <x-slot name="cdTop">{{$dataByZone['gioi-tre']['cdTop']??''}}</x-slot>
                        <x-slot name="classAvt">blue</x-slot>
                    </x-template::box-layout6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="box-stream-item box-stream-item-load"></div>
<div class="list__viewmore"></div>
<div class="configHidden">
    {!! $ZoneInfoClientScript ?? '' !!}
</div>
@endsection
