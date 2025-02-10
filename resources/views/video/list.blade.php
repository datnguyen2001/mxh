@extends('layout.master')
@section('title'){{(!empty($ZoneVideoInfo->MetaName))?$ZoneVideoInfo->MetaName:$ZoneVideoInfo->Name}}@endsection
@section('description'){{(!empty($ZoneVideoInfo->MetaDescription))?$ZoneVideoInfo->MetaDescription:$ZoneVideoInfo->Description}}@endsection
@section('keywords'){{(!empty($ZoneVideoInfo->MetaKeyword))?$ZoneVideoInfo->MetaKeyword:''}}@endsection
@section('og-title'){{(!empty($ZoneVideoInfo->Name))?$ZoneVideoInfo->Name:''}}@endsection
@section('og-description'){{(!empty($ZoneVideoInfo->Description))?$ZoneVideoInfo->Description:''}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{(!empty($ZoneVideoInfo->Avatar))?UserInterfaceHelper::formatThumbZoom($ZoneVideoInfo->Avatar,600,315):''}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss/'.$ZoneVideoInfo->ZoneUrl.'.rss'}}
@endsection
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
        @if(!empty($ZoneVideoInfo))
        <x-template.box-layout12 :listVideos="$videoFocus" :zoneVideo="$zoneVideoParent" :zoneInfo="$ZoneVideoInfo">
        </x-template.box-layout12>
        @endif
    </div>
</div>



<div class="list__video-hot" data-cd-key="siteid180:videomode:zone{{$ZoneVideoInfo->Id}}:mode1" data-cd-top="5">
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
<div class="configHidden">
    {!! $ZoneInfoClientScript !!}
</div>
@endsection
