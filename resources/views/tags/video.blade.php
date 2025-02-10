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
<div class="list__main">
        <div class="container">
            <div class="search-title">
            <span class="icon">
                <svg width="16" height="19" viewBox="0 0 16 19" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path
                        d="M10.584 0.820312C10.7352 0.619644 10.9832 0.5 11.248 0.5L15.1898 0.500001C15.8351 0.500001 16.2206 1.16326 15.8637 1.65956L5.99546 18.1662C5.84558 18.3747 5.59255 18.5 5.32151 18.5L0.810274 18.5C0.156981 18.5 -0.226801 17.8221 0.146235 17.327L10.584 0.820312Z"
                        fill="#B70002" />
                </svg>
            </span>
                <h1 class="search-title-p">{{(!empty($tagInfo->Name)?$tagInfo->Name:'')}}</h1>
            </div>
            <div class="list__main-flex">
                <div class="list__listing">
                    <div class="list__lmain">
                        @if(!empty($listNewsTag))
                            <div class="box-category box-border-top" data-layout="11"
                                 data-cd-key="siteid180:tag:id{{$tagInfo->Id??''}}">
                                <div class="box-category-middle">
                                    <x-template::box-layout11 :listNews="$listNewsTag">
                                        <x-slot name="checkSeo">tag</x-slot>
                                    </x-template::box-layout11>
                                    <div class="box-stream-item box-stream-item-load"></div>
                                    <x-category.box-layout-loading></x-category.box-layout-loading>
                                </div>
                            </div>
                            <div class="layout__viewmore list__viewmore list__center">
                                <a class="btn-viewmore">
                                    Xem thêm
                                    <span class="icon">
                                <svg width="14" height="8" viewBox="0 0 14 8" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M13.333 1.69935L12.2997 0.666016L6.99967 5.96602L1.69967 0.666016L0.666341 1.69935L6.99967 7.99935L13.333 1.69935Z"
                                        fill="#686868" />
                                </svg>

                            </span>
                                </a>
                            </div>
                        @else
                            <p>Không có gì để hiển thị!</p>
                        @endif
                    </div>
                    <div class="list__lsub">
                    </div>
                </div>
                <div class="configHidden">
                    {!! $ZoneInfoClientScript !!}
                </div>
            </div>
        </div>
    </div>
@endsection

