@extends('layout.master')
@section('title'){{(!empty($videoFocus->MetaTitle))?$videoFocus->MetaTitle:$videoFocus->Name}}@endsection
@section('description'){{$videoFocus->Description.$videoFocus->Name.' VIDEO CLIP'}}@endsection
@section('keywords'){{(!empty($videoFocus->MetaKeyword))?$videoFocus->MetaKeyword:$videoFocus->Tags}}@endsection
@section('news_keywords'){{(!empty($videoFocus->MetaNewsKeyword))?$videoFocus->MetaNewsKeyword:''}}@endsection
@section('og-title'){{(!empty($videoFocus->Name))?$videoFocus->Name:''}}@endsection
@section('og-description'){{$videoFocus->Description.$videoFocus->Name.' VIDEO CLIP'}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{(!empty($videoFocus->Avatar))?UserInterfaceHelper::formatThumbZoom($videoFocus->Avatar,600,315):''}}@endsection
@section('css')
    @include('expert.Css-detail')
    @if(!empty($zoneDetail))
        @include('schema.SchemaVideo')
    @endif
@endsection
@section('js')
    @include('expert.Js-detail')
@endsection
@section('content')
<div class="list__video-focus">
    <div class="container">
        <!-- video focus -->
        @if(!empty($listVideoFocus))
        <x-template.box-layout12 :listVideos="$listVideoFocus" :zoneVideo="[]" :zoneInfo="!empty($zoneInfo)?$zoneInfo:1">
        </x-template.box-layout12>
        @endif
    </div>
</div>
<!-- xem tiếp -->
<div class="list__video-next">
    <div class="container">
        @if(!empty($listVideo) && !empty($zoneInfo))
        <x-template.box-layout16 :listVideos="$listVideo" :zoneInfo="$zoneInfo"></x-template.box-layout16>
        @endif
    </div>
</div>


<div class="list__video-more">
    <div class="container">
        @if(!empty($listVideoMore))
        <div class="box-category box-border-top" data-layout="14" data-cd-key="siteid180:videoinzone:zone{{$zoneInfo->Id}}" data-cd-top="12">
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
                        Xem thêm
                    </a>
                </h3>
            </div>
            <div class="list__video-new">
                <div class="container">
                    <div class="box-category-middle">
                        <x-template.box-layout14 :listVideos="$listVideoMore"></x-template.box-layout14>
                        <div class="box-stream-item box-stream-item-load"></div>
                    </div>
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
            </div>
            <div class="box-viewmore list__viewmore list__center">
                <a class="btn-viewmore">
                    Xem thêm
                    <span class="icon">
                        <svg width="14" height="8" viewBox="0 0 14 8" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M13.333 1.69935L12.2997 0.666016L6.99967 5.96602L1.69967 0.666016L0.666341 1.69935L6.99967 7.99935L13.333 1.69935Z"
                                fill="#686868" />
                        </svg>
                    </span>
                </a>
            </div>
        </div>
        @endif

    </div>
</div>

<div class="configHidden">
    {!! $ZoneInfoClientScript !!}
</div>
@endsection
