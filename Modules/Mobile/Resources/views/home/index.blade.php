@extends('mobile::layout.master')
@section('title'){{config('metapage.Home.title')}}@endsection
@section('description'){{config('metapage.Home.description')}}@endsection
@section('keywords'){{config('metapage.Home.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Home.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Home.og:title')}}@endsection
@section('og-description'){{config('metapage.Home.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Home.og:image')}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss/home.rss'}}@endsection
@section('logo_home')
@endsection
@section('css')
    @if(!empty($boxFocusHome))
        @foreach($boxFocusHome as $item)<link rel="preload" href="{!! $item->ThumbImage !!}" as="image" fetchpriority="high">@endforeach
    @endif
    @include('mobile::expert.Css-home')
    @include('schema.SchemaHome')
@endsection
@section('js')
    @include('mobile::expert.Js-home')
@endsection
@section('content')
    <div id="home-xam" class="hidden"></div>

    <div class="main">
        <div class="home__focus-hm">
            <div class="container">
                <div class="box-focus">
                    <x-mobile:template::box-layout1 :listNews="$boxFocusHome" zoneInfo="">
                        <x-slot name="cdKey">{{config('siteInfo.SITE_ID')}}newsposition:zoneid{{$zoneInfo->Id??''}}type3</x-slot>
                        <x-slot name="cdTop">3</x-slot>
                    </x-mobile:template::box-layout1>
                </div>
            </div>
        </div>

        <div class="home__dbl">
            <div class="container">
                <div class="box-dbl">
{{--                    <x-mobile:template::box-layout2 :listNews="$boxMostView" zoneInfo="">--}}
{{--                        <x-slot name="cdKey">{{config('siteInfo.SITE_ID')}}highestviewnews:zoneid0hour48</x-slot>--}}
{{--                        <x-slot name="cdTop">4</x-slot>--}}
{{--                    </x-mobile:template::box-layout2>--}}

                    <x-mobile:template::box-layout2 :listNews="$dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['data']??''" :zoneInfo="$dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['info']??''">
                        <x-slot name="cdKey">{{$dataByZone['gioi-tre/thanh-nien-khoi-nghiep']['cdKey']??''}}</x-slot>
                        <x-slot name="cdTop">4</x-slot>
                    </x-mobile:template::box-layout2>


                </div>
            </div>
        </div>
        <div class="home__anp">
            <div class="container">
                <div class="box-anp">
                    <x-mobile:template::box-layout3 :listNewsPapers="$boxAnpham"  >
                        <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}magazine:type2</x-slot>
                        <x-slot name="cdTop">1</x-slot>
                        <x-slot name="zoneName">Ấn phẩm</x-slot>
                        <x-slot name="zoneUrl">/an-pham.htm </x-slot>
                    </x-mobile:template::box-layout3>
                </div>
            </div>
        </div>

        <div class="home__news">
            <div class="container">
                <div class="box-news">
                    <x-mobile:template::box-layout4 :listNews="$dataByZone['thoi-su']['data']??''" :zoneInfo="$dataByZone['thoi-su']['info']??''" >
                        <x-slot name="cdKey">{{$dataByZone['thoi-su']['cdKey']??''}}</x-slot>
                        <x-slot name="cdTop">{{$dataByZone['thoi-su']['cdTop']??''}}</x-slot>
                    </x-mobile:template::box-layout4>
                </div>
            </div>
        </div>
        <div class="home__dbl">
            <div class="container">
                <div class="box-dbl">
                    <x-mobile:template::box-layout5 :listNews="$boxEmagazine" :zoneInfo="''" >
                        <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid5</x-slot>
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
                    </x-mobile:template::box-layout5>
                </div>
            </div>
        </div>

        <div class="home__anp">
            <div class="container">
                <div class="box-anp">
                    <x-mobile:template::box-layout3 :listNewsPapers="$boxTapchi"  >
                        <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}magazine:type1</x-slot>
                        <x-slot name="cdTop">1</x-slot>
                        <x-slot name="zoneName">Tạp chí</x-slot>
                        <x-slot name="zoneUrl">/tap-chi.htm </x-slot>
                    </x-mobile:template::box-layout3>
                </div>
            </div>
        </div>

        <div class="home__news">
            <div class="container">
                <div class="box-news">
                    <x-mobile:template::box-layout4 :listNews="$dataByZone['gioi-tre']['data']??''" :zoneInfo="$dataByZone['gioi-tre']['info']??''" >
                        <x-slot name="cdKey">{{$dataByZone['gioi-tre']['cdKey']??''}}</x-slot>
                        <x-slot name="cdTop">{{$dataByZone['gioi-tre']['cdTop']??''}}</x-slot>
                        <x-slot name="classAvt">blue</x-slot>
                    </x-mobile:template::box-layout4>
                </div>
            </div>
        </div>
    </div>
    <div class="box-stream-item box-stream-item-load"></div>
    <div class="list__viewmore"></div>
    <div class="configHidden">
        <input type="hidden" name="hdZoneHome" id="hdZoneHome" value="0"/>
        <input type="hidden" name="hdPageIndex" id="hdPageIndex" value="0"/>
    </div>
@endsection
