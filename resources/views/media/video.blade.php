@extends('layout.master')
@section('title'){{sprintf(config('metapage.Media.title'),'Video')}}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{sprintf(config('metapage.Media.title'),'Video')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('css')
    @include('expert.Css-list')
    <script type="text/javascript">
        var _ADM_Channel = '%2fvideo%2f';
    </script>
@endsection
@section('js')
    @include('expert.Js-list')
@endsection
@section('content')
    <h1 class="box-category-title ">
        <a href="/video.htm" class="category-name_ac hidden" style="color: #111111">video</a>
    </h1>
    <div class="list__multimedia">
        <div class="box-category" data-layout="15" data-cd-key="newsbytype:type13">
            <div class="box-category-middle">
                <div class="swiper home-multi-sw ">
                    <div class="swiper-wrapper" >
                        @if(!empty($listNews))
                            @foreach ($listNews as $key=>$item)
                                @if($key<5)
                                <div class="swiper-slide" >
                                    <x-layout::box-category-item :dataItem="$item">
                                        <x-slot name="noLazy">true</x-slot>
                                        <x-slot name="fetchpriority">true</x-slot>
                                        <x-slot name="headingTitleTag">h2</x-slot>
                                        <x-slot name="noSapo">true</x-slot>
                                        <x-slot name="trimLineTitle">3</x-slot>
                                    </x-layout::box-category-item>
                                </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                    <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                </div>
                <div class="box-control">
                    <div class="home-multi-prev" tabindex="0" role="button" aria-label="Previous slide" aria-controls="swiper-wrapper-7c67c6cd339e2296">
                        <svg width="16" height="27" viewBox="0 0 16 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M14 24.8L2 13.4L14 2" stroke="#0055A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                    <div class="home-multi-next" tabindex="0" role="button" aria-label="Next slide" aria-controls="swiper-wrapper-7c67c6cd339e2296">
                        <svg width="16" height="27" viewBox="0 0 16 27" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M2 24.8L14 13.4L2 2" stroke="#0055A7" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="list__mustream">
        <div class="container">
            <div class="box-mustream">
                <div class="col-news">
                    <div class="box-category" data-layout="16" data-cd-key="newsbytype:type13">
                        <div class="box-category-middle">
                            @if(!empty($listNews))
                                @foreach ($listNews as $key=>$item)
                                    @if($key>4)
                                        <x-layout::box-category-item :dataItem="$item">
                                            <x-slot name="noSapo">true</x-slot>
                                            <x-slot name="noTime">true</x-slot>
                                            <x-slot name="trimLineTitle">3</x-slot>
                                        </x-layout::box-category-item>
                                    @endif
                                @endforeach
                            @endif
                            <div class="box-stream-item box-stream-item-load hidden"></div>
                        </div>
                        @if(!empty($listNews) && count($listNews)>10)
                        <x-category.box-layout-loading3/>
                        <div class="list__viewmore list__center" style="display: block;">
                            <a href="javascript:;" rel="nofollow" class="load-more" title="Xem thêm">Xem thêm</a>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="col-news-right">
                    @include('components.category.box-ads-right')
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
