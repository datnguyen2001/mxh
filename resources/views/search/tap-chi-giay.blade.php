@extends('layout.master')
@section('title'){{'Trang ' .$pageInfo->Name ?? ''}}@endsection
@section('description'){{$pageInfo->Name ?? ''}}@endsection
@section('keywords'){{$pageInfo->Name ?? ''}}@endsection
@section('news_keywords'){{$pageInfo->Name ?? ''}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('og-title'){{$pageInfo->Name ?? ''}}@endsection
@section('og-description'){{$pageInfo->Name ?? ''}}@endsection
@section('css')
    @include('expert.Css-list')
    <style>
        .box-breadcrumb .cate-name{
            margin-right: 5px;
        }
        .list__category-page .box-top .box-breadcrumb .cate-name:first-child:after{
            margin-left: 5px;
        }
        .list__category-page .box-category-item .box-category-link-with-avatar img {
            height: 232px;
        }
        .list__category-page .section .paper-news .box-category-item .box-category-link-with-avatar img {
            max-width: 174px;
            aspect-ratio: 13 / 18;
            object-fit: cover;
            background: #ddd;
        }
    </style>
    <script type="text/javascript">
        var _ADM_Channel = '%2f{{$pageInfo->ShortUrl ?? ''}}%2f';
    </script>
@endsection
@section('js')
    @include('expert.Js-list')
@endsection
@section('content')
    <div class="list__category-page">
        <div class="container">
            <div class="box-top">
                <div class="box-breadcrumb">
                    <a href="/" class="cate-name">Trang chủ</a>
                    <a href="{{$pageInfo->Url ??''}}" class="cate-name" title="{{$pageInfo->Name ??''}}">{{$pageInfo->Name ??''}}</a>
                </div>

                <h1 class="heading-box">
                    <a href="{{$pageInfo->Url ??''}}" class="box-right-title" title="{{$pageInfo->Name ??''}}">{{$pageInfo->Name ??''}}</a>
                </h1>
            </div>

            <div class="section">

                <div class="section-wrapper paper-news" data-cd-key="{{$keyCd['listPaper']['key']??''}}" data-cd-top="16">
                    <x-template::box-new-paper :listPaper="$listPaper"></x-template::box-new-paper>
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
                @if(!empty($listPaper) && count($listPaper) == 16)
                    <button class="readmore-btn text-btn title-color view-more block list__viewmore list__center">
                        Xem thêm
                    </button>
                @endif
            </div>
        </div>
    </div>
    <div class="configHidden no-auto-load">
        {!! $ZoneInfoClientScript ?? '' !!}
    </div>
@endsection
