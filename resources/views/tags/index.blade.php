@extends('layout.master')
@section('title'){{!empty($tagInfo->TagTitle)?$tagInfo->TagTitle:sprintf(config('metapage.Tags.title'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('description'){{!empty($tagInfo->TagInit)?$tagInfo->TagInit:sprintf(config('metapage.Tags.description'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('keywords'){{!empty($tagInfo->TagMetaKeyword)?$tagInfo->TagMetaKeyword:sprintf(config('metapage.Tags.keywords'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('news_keywords'){{!empty($tagInfo->TagMetaKeyword)?$tagInfo->TagMetaKeyword:sprintf(config('metapage.Tags.keywords'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('og-title'){{!empty($tagInfo->TagTitle)?$tagInfo->TagTitle:sprintf(config('metapage.Tags.title'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('og-description'){{!empty($tagInfo->TagInit)?$tagInfo->TagInit:sprintf(config('metapage.Tags.description'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('OgImage'){{(!empty($tagInfo->Avatar))?UserInterfaceHelper::formatThumbZoom($tagInfo->Avatar,600,315):config('siteInfo.default_share')}}@endsection
@section('css')
    @include('expert.Css-list')
    @if(!empty($tagInfo))
        @include('schema.SchemaTags')
    @endif
@endsection
@section('js')
    @include('expert.Js-list')
@endsection
@section('content')
    <div class="detail__section page-default">
        <div class="container">
            <div class="box-category-top">
                <h1 class="box-category-title">
                    {{(!empty($tagInfo->Name)?$tagInfo->Name:$shortURL ?? '')}}
                </h1>
            </div>
            <div class="detail__sflex-main">

                <div class="detail__sright">
                    <div class="box-careabout">
                        <div class="careabout-flex">
                            <div class="box-category" data-layout="3">
                                <div class="box-category-middle">
                                    <x-template::item-cate :listNews="$listNews">
                                        <x-slot name="headingTitleTag">h2</x-slot>
                                    </x-template::item-cate>
                                    <div class="box-stream-item box-stream-item-load hidden"></div>
                                </div>
                                @if(!empty($listNews) && count($listNews) == 15)
                                    <x-category.box-layout-loading/>
                                    <div class="box-center list__viewmore list__center">
                                        <a href="javascript:;" rel="nofollow" class="views" title="Xem thêm">Xem thêm</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail__sleft">
                    @include('components.category.box-ads-right')
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!! $ZoneInfoClientScript !!}
    </div>
@endsection
