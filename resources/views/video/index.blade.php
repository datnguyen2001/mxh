@extends('layout.master')
@section('title'){{config('metapage.Video.title')}}@endsection
@section('description'){{config('metapage.Video.description')}}@endsection
@section('keywords'){{config('metapage.Video.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Video.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Video.og:title')}}@endsection
@section('og-description'){{config('metapage.Video.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Video.og:image')}} @endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss/video.rss'}}@endsection
@section('css')
    @include('expert.Css-detail')
    @include('schema.SchemaVideoIndex')
@endsection
@section('js')
    @include('expert.Js-detail')
@endsection
@section('content')
<div class="list__video-focus">
    <div class="container">
        @if(!empty($videoFocus) && !empty($zoneVideo))
        <x-template.box-layout12 :listVideos="$videoFocus" :zoneVideo="$zoneVideo" zoneInfo="">
        </x-template.box-layout12>
        @endif
    </div>
</div>



<div class="list__video-hot" data-cd-key="siteid180:videomode:zoneall:mode1" data-cd-top="5">
    <div class="container">
        @if(!empty($videoHighlight))
        <x-template.box-layout13 :listVideos="$videoHighlight"></x-template.box-layout13>
        @endif
    </div>
</div>


<div class="list__video-new">
    <div class="container">
        @if(!empty($videoNewsList))
        <div class="box-category box-border-top" data-layout="14" data-cd-key="siteid180:videoinzone:zoneall" data-cd-top="8">
            <div class="box-category-top">
                <h3 class="title-category">
                    <a class="box-category-title" href="javascript:;">
                        <span class="icon">
                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.80881 0.749132C8.91465 0.593056 9.08827 0.5 9.27363 0.5L13.4328 0.500001C13.8845 0.500001 14.1544 1.01587 13.9046 1.40188L5.59682 14.2404C5.4919 14.4025 5.31479 14.5 5.12506 14.5L0.567192 14.5C0.109886 14.5 -0.158761 13.9727 0.102364 13.5877L8.80881 0.749132Z"
                                    fill="#B70002" />
                            </svg>

                        </span>
                        video mới
                    </a>
                </h3>
            </div>
            <div class="box-category-middle">
                <x-template.box-layout14 :listVideos="$videoNewsList"></x-template.box-layout14>
            </div>
        </div>
        @endif
    </div>
</div>

<div class="list__video-listing">
    <div class="container">
        <div class="list__vl-flex">
            <div class="list__vl-main">
                <div class="list__vl-search header-search-video">
                    <input class="btn-search txt-search" placeholder="Nhập từ khóa để tìm kiếm video" />
                    <a href="javascript:;" class="submit-search btn-search-video">
                        <svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path opacity="0.6"
                                d="M6.84199 13.684C8.36004 13.6837 9.83434 13.1755 11.0301 12.2403L14.7898 16L15.9991 14.7907L12.2395 11.031C13.1751 9.83508 13.6836 8.36043 13.684 6.84199C13.684 3.06949 10.6145 0 6.84199 0C3.06949 0 0 3.06949 0 6.84199C0 10.6145 3.06949 13.684 6.84199 13.684ZM6.84199 1.7105C9.67201 1.7105 11.9735 4.01197 11.9735 6.84199C11.9735 9.67201 9.67201 11.9735 6.84199 11.9735C4.01197 11.9735 1.7105 9.67201 1.7105 6.84199C1.7105 4.01197 4.01197 1.7105 6.84199 1.7105Z"
                                fill="#686868" />
                        </svg>
                    </a>
                </div>
                @if(!empty($subData))
                @foreach($subData as $key => $item)
                <div class="list__vl-category">
                    <div class="box-category box-border-top" data-layout="15" data-cd-top="4"
                        data-cd-key="siteid180:newsinzone:zone{{$item['info']->Id}}">
                        <div class="box-category-top">
                            <h2 class="title-category">
                                <a class="box-category-title" href="{{$item['info']->ZoneUrl}}"
                                    title="{{$item['info']->Name}}">
                                    <span class="icon">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M8.80881 0.249132C8.91465 0.0930563 9.08827 -2.20819e-08 9.27363 0L13.4328 6.61972e-07C13.8845 7.5502e-07 14.1544 0.515873 13.9046 0.901883L5.59682 13.7404C5.4919 13.9025 5.31479 14 5.12506 14L0.567192 14C0.109886 14 -0.158761 13.4727 0.102364 13.0877L8.80881 0.249132Z"
                                                fill="#B70002" />
                                        </svg>

                                    </span>
                                    {{$item['info']->Name}}
                                </a>
                            </h2>
                            <div class="box-category-menu">
                                <a href="{{$item['info']->ZoneUrl}}" class="view-more" title="Xem thêm">
                                    Xem toàn bộ video
                                    <span class="icon">
                                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M7 0L5.74875 1.21887L10.6312 6.125H0V7.875H10.6312L5.74875 12.7514L7 14L14 7L7 0Z"
                                                fill="#686868" />
                                        </svg>
                                    </span>
                                </a>
                            </div>
                        </div>
                        <div class="box-category-middle">
                            @if(!empty($item['data']))
                            @foreach($item['data'] as $key1 => $item1)
                            @if($key1 == 0)
                            <div class="box-category-item-first" data-id="{{$item1->Id}}">

                                <a class="box-category-link-with-avatar img-resize" href="{{$item1->Url}}"
                                    title="{{$item1->Name}}" data-id="{{$item1->Id}}">
                                    <img data-type="avatar" src="{{$item1->ThumbImage}}" alt="{{$item1->Name}}"
                                        class="box-category-avatar">
                                    <span class="icon-type">
                                        <svg width="76" height="76" viewBox="0 0 76 76" fill="none"
                                            xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M64.8701 11.1298C57.6928 3.95278 48.1502 0 38 0C27.8498 0 18.3072 3.95278 11.1298 11.1298C3.95278 18.3072 0 27.8498 0 38C0 48.1502 3.95278 57.6928 11.1298 64.8701C18.3072 72.0472 27.8498 76 38 76C48.1502 76 57.6928 72.0472 64.8701 64.8701C72.0472 57.6928 76 48.1502 76 38C76 27.8498 72.0472 18.3072 64.8701 11.1298ZM38 71.299C19.6389 71.299 4.70103 56.3611 4.70103 38C4.70103 19.6389 19.6389 4.70103 38 4.70103C56.3611 4.70103 71.299 19.6389 71.299 38C71.299 56.3611 56.3611 71.299 38 71.299Z"
                                                fill="white" />
                                            <path d="M28.373 52.7411L53.8959 37.9995L28.373 23.2578V52.7411Z"
                                                fill="white" />
                                        </svg>

                                    </span>
                                </a>
                                <div class="box-category-content">
                                    <h3>
                                        <a data-type="title" data-linktype="newsdetail" data-id="{{$item1->Id}}"
                                            class="box-category-link-title" href="{{$item1->Url}}"
                                            title="{{$item1->Name}}">{{$item1->Name}}</a>
                                    </h3>
                                </div>
                            </div>
                            @endif
                            @endforeach
                            @endif

                            <div class="box-category-list-sub">
                                @if(!empty($item['data']))
                                @foreach($item['data'] as $key1 => $item1)
                                @if($key1 > 0)
                                <div class="box-category-item-sub">
                                    <a class="box-category-link-with-avatar img-resize" href="{{$item1->Url}}"
                                        title="{{$item1->Name}}" data-id="{{$item1->Id}}">
                                        <img data-type="avatar" src="{{$item1->ThumbImage}}" alt="{{$item1->Name}}"
                                            data-width="value-news-width" data-height="value-news-height"
                                            class="box-category-avatar">
                                        <span class="icon-type">
                                            <svg width="32" height="32" viewBox="0 0 32 32" fill="none"
                                                xmlns="http://www.w3.org/2000/svg">
                                                <path
                                                    d="M27.3137 4.68625C24.2917 1.66433 20.2737 0 16 0C11.7263 0 7.70831 1.66433 4.68625 4.68625C1.66433 7.70831 0 11.7263 0 16C0 20.2737 1.66433 24.2917 4.68625 27.3137C7.70831 30.3357 11.7263 32 16 32C20.2737 32 24.2917 30.3357 27.3137 27.3137C30.3357 24.2917 32 20.2737 32 16C32 11.7263 30.3357 7.70831 27.3137 4.68625ZM16 30.0206C8.269 30.0206 1.97938 23.731 1.97938 16C1.97938 8.269 8.269 1.97938 16 1.97938C23.731 1.97938 30.0206 8.269 30.0206 16C30.0206 23.731 23.731 30.0206 16 30.0206Z"
                                                    fill="white" />
                                                <path d="M11.9463 22.207L22.6927 16L11.9463 9.79297V22.207Z"
                                                    fill="white" />
                                            </svg>

                                        </span>
                                    </a>
                                    <div class="box-category-content">
                                        <h3>
                                            <a data-type="title" data-linktype="newsdetail" data-id="{{$item1->Id}}"
                                                class="box-category-link-title" href="{{$item1->Url}}"
                                                title="{{$item1->Name}}">{{$item1->Name}}</a>
                                        </h3>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
                @endif

            </div>
            <div class="list__vl-sub">
                <div>
                    <x-layout::box-ads nameAds="Medium1"></x-layout::box-ads>
                </div>
                <div>
                    <x-layout::box-ads nameAds="Medium2"></x-layout::box-ads>
                </div>
                <div>
                    <x-layout::box-ads nameAds="Stickybanner1"></x-layout::box-ads>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="configHidden">
    {!! $ZoneInfoClientScript !!}
</div>
@endsection
