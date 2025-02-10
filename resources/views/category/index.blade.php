@extends('layout.master')
@section('title'){{(!empty($zoneInfo->MetaName))?$zoneInfo->MetaName:(!empty(config('metapage.Category.'.$zoneInfo->ShortURL.'.title'))?config('metapage.Category.'.$zoneInfo->ShortURL.'.title'):$zoneInfo->Name)}}@endsection
@section('description'){{(!empty($zoneInfo->MetaDescription))?$zoneInfo->MetaDescription:config('metapage.Category.'.$zoneInfo->ShortURL.'.description')}}@endsection
@section('keywords'){{(!empty($zoneInfo->MetaKeyword))?$zoneInfo->MetaKeyword:config('metapage.Category.'.$zoneInfo->ShortURL.'.keywords')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{(!empty($zoneInfo->Avatar))?UserInterfaceHelper::formatThumbZoom($zoneInfo->Avatar,600,315):config('siteInfo.default_share')}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss'.str_replace('.htm','.rss',$zoneInfo->ZoneUrl??'')}}@endsection
@section('css')
    @if(!empty($listFocus))
        @foreach($listFocus as $item)
            <link rel="preload" href="{!! $item->ThumbImage !!}" as="image" fetchpriority="high">@endforeach
    @endif
    @include('expert.Css-list')
    <style>
        .container .box-category .box-category-middle .box-category-item .box-category-category{
            display: none;
        }
    </style>
    @if(!empty($zoneInfo))
        @include('schema.SchemaCat')
    @endif
@endsection
@section('js')
    @include('expert.Js-list')

@endsection
@section('content')
    @include('components.category.box-breadcrumb')
    <div class="list__category-stream">
        <div class="container">
            <div class="category-flex">
                <div class="box-stream-left">
                    <div class="box-stream-top">
                        <x-template::box-layout1 :listNews="$listFocus" zoneInfo="">
                            <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}newsposition:zoneid{{$zoneInfo->Id??''}}type3</x-slot>
                            <x-slot name="cdTop">3</x-slot>
                        </x-template::box-layout1>
                    </div>
                    <div class="box-stream-vertical">
                        <div class="stream-left">
                            @if(!empty($listNews))
                            <x-template::box-layout3 :listNews="$listNews">
                                <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}newsinzone:zone{{$zoneInfo->Id??''}}</x-slot>
                                <x-slot name="cdTop">10</x-slot>
                                <x-slot name="isLoading">true</x-slot>
                            </x-template::box-layout3>
                            @if(count($listNews)>5)
                            <x-category.box-layout-loading/>
                            <div class="list__viewmore list__center" style="display: block;">
                                <a href="javascript:;" rel="nofollow" class="load-more" title="Xem thêm">Xem thêm</a>
                            </div>
                            @endif
                            @endif
                        </div>
                        <div class="stream-right">
                            <div id="insert-cate-sidebar"></div>
                        </div>
                    </div>
                </div>
                <div class="box-stream-right">
                    @include('components.category.box-ads-right')
                    <div class="insert-hapodigital"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
    <script>
        (runinit = window.runinit || []).push(function () {
            $.ajax({
                url: `https://api.hapodigital.com/api/v2/keywords?uri={{config('siteInfo.site_path').Request::getPathInfo()}}`,
                type: 'GET',
                success: function (res) {
                    if (res) {
                        $(res).insertBefore('.insert-hapodigital');
                    }
                },
                timeout: 5000
            });
        });
    </script>
@endsection
