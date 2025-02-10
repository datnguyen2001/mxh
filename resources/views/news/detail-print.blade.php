@extends('layout.master-print')
@section('title'){{(!empty($newsContent->MetaTitle))?$newsContent->MetaTitle:$newsContent->Title}}@endsection
@section('description'){{(!empty($newsContent->MetaDescription))?$newsContent->MetaDescription:$newsContent->Sapo}}@endsection
@section('keywords'){{(!empty($newsContent->MetaKeyword))?$newsContent->MetaKeyword:$newsContent->TagItem}}@endsection
@section('news_keywords'){{(!empty($newsContent->MetaNewsKeyword))?$newsContent->MetaNewsKeyword:$newsContent->TagItem}}@endsection
@section('og-title'){{(!empty($newsContent->Title))?$newsContent->Title:''}}@endsection
@section('og-description'){{(!empty($newsContent->Sapo))?$newsContent->Sapo:''}}@endsection
@section('OgUrl'){{$newsContent->Url}}@endsection
@section('Canonical'){{config('siteInfo.site_path').$newsContent->Url}}@endsection
@section('Robots'){{'noindex, nofollow'}}@endsection
@section('OgImage'){{(!empty($newsContent->OgImage))?UserInterfaceHelper::formatThumbZoom($newsContent->OgImage,600,315):config('siteInfo.default_share')}}@endsection
@section('published_time'){{!empty($newsContent->DistributionDate)?$newsContent->DistributionDate:''}}@endsection
@section('article_author'){{!empty($newsContent->Author)?$newsContent->Author:''}}@endsection
@section('css')
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-detail')
    <style>

        .main{
            margin-top: 0;
            padding-bottom: 40px;
        }
        .container {
            width: 760px !important;
        }

        .detail__cmain {
            width: 100% !important;
        }

        body {
            width: 760px;
            margin: auto;
            position: relative;
        }
        table{
            width: 100%;
        }
        table figure img{
            width: 100% !important;
            height: auto !important;
        }
        .header__logo {
            padding: 20px 0;
            -webkit-filter: unset;
            filter: unset;
            display: inline-block;
        }

        .header__logo img {
            margin: auto;
        }

        .detail-mode {
            padding: 0 !important;
        }
        .print-header{
            margin: 0 auto;
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 730px;
        }
        .detail-sapo{
            margin-top: 10px;
        }
        .source-footer{
            text-decoration: underline;
            color: #007aff !important;
        }
        .source-footer:hover{
            text-decoration: underline;
            color: #007aff !important;
        }
        .detail-mode{
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: space-between;
        }
        .video-big .vPlayer {
            position: relative;
            height: 0;
            padding-bottom: 56.26%;
            margin-bottom: 15px;
        }
        .videoIfame .VCSortableInPreviewMode iframe{
            width: 100%;
        }
        .list__video-flex .video-box-left .box-top-video .video-big .vPlayer{
            position: relative;
            height: 0;
            padding-bottom: 56.26%;
        }
        .box-top-video .vPlayer:before{
            content: '';
            padding-bottom: 56.26% !important;
        }
        .d-bg-short img{
            width: 100%;
        }
        .video-big .VCSortableInPreviewMode[type="VideoStream"] .videoNewsPlayer {
            position: absolute!important;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        .videoIfame .entry-content:after{
            content: '';
            padding-bottom: 56.26%!important;
        }
        .VCSortableInPreviewMode[type="VideoStream"] .videoNewsPlayer.video-wrapper-mini{
            z-index: 99999999;
        }
        .videoIfame .entry-content iframe{
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
        }
        h2.sapo {
            font-family: SF Pro Display;
            font-size: 17px;
            font-weight: 500;
            line-height: 24px;
            text-align: left;
            color: #111111;
            margin-bottom: 30px;
        }


        .detail__smain {
            width: 100%;
            margin-left: unset;
        }
        .detail__sm-flex .detail-main{
            margin-right: unset;
        }
        .mt-20 {
            margin-top: 20px;
        }
        .mt-10{
            margin-top: 10px;
        }
        .title-detail{
            font-family: Noto Serif JP;
            font-size: 34px;
            font-weight: 600;
            line-height: 48px;
            text-align: left;
            color: #111111;
            margin-bottom: 16px;
        }

        @media print {
            .printpage{
                display: none;
            }
        }
    </style>
@endsection
@section('js')
    @include('expert.Js-detail')
@endsection
@section('content')
    <div class="print-header">
        <div class="detail-mode" >
            <a href="/" title="{{config('metapage.Home.title')}}" class="header__logo">
                <img alt="{{config('metapage.Home.title')}}" src="https://static.mediacdn.vn/thanhnienviet.vn/images/logo.png">
            </a>
            <ul class="list-social">
                <li>
                    <a href="javascript:;" class="printpage" title="In bài viết" target="_blank" onclick="window.print();"
                        rel="nofollow">
                        <svg width="30" height="30" viewBox="0 0 30 30" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <circle cx="15" cy="15" r="15" fill="#e81d1a" />
                            <path
                                d="M21.3064 9.05091C21.3064 8.47147 20.835 8 20.2555 8H10.7444C10.165 8 9.69354 8.47147 9.69354 9.05091V11.629H21.3064V9.05091Z"
                                fill="white" />
                            <path
                                d="M22.191 12.5968H8.80898C8.49628 12.5968 8.24194 12.8511 8.24194 13.1638V18.804C8.24194 19.1167 8.49628 19.371 8.80898 19.371H10.9032V17.5187C10.9032 16.6722 11.5915 15.9839 12.438 15.9839H18.562C19.4085 15.9839 20.0968 16.6722 20.0968 17.5187V19.371H22.191C22.5037 19.371 22.7581 19.1167 22.7581 18.804V13.1638C22.7581 12.8511 22.5037 12.5968 22.191 12.5968ZM20.8226 14.7742H20.0968C19.8294 14.7742 19.6129 14.5577 19.6129 14.2904C19.6129 14.023 19.8294 13.8065 20.0968 13.8065H20.8226C21.0899 13.8065 21.3064 14.023 21.3064 14.2904C21.3064 14.5577 21.0899 14.7742 20.8226 14.7742ZM18.562 16.9516H12.438C12.1253 16.9516 11.871 17.206 11.871 17.5187V22.433C11.871 22.7457 12.1253 23 12.438 23H18.562C18.8747 23 19.129 22.7457 19.129 22.433V17.5187C19.129 17.206 18.8747 16.9516 18.562 16.9516ZM16.9516 21.5484H14.0484C13.7811 21.5484 13.5645 21.3319 13.5645 21.0645C13.5645 20.7972 13.7811 20.5807 14.0484 20.5807H16.9516C17.219 20.5807 17.4355 20.7972 17.4355 21.0645C17.4355 21.3319 17.219 21.5484 16.9516 21.5484ZM16.9516 19.371H14.0484C13.7811 19.371 13.5645 19.1545 13.5645 18.8871C13.5645 18.6198 13.7811 18.4033 14.0484 18.4033H16.9516C17.219 18.4033 17.4355 18.6198 17.4355 18.8871C17.4355 19.1545 17.219 19.371 16.9516 19.371Z"
                                fill="white" />
                        </svg>
                    </a>
                </li>
            </ul>
        </div>
    </div>
    <div class="detail__content" id="detail-content">
        <div class="container">
            <div class="detail__smain">
                <div class="box-title-top mt-20">
                    <div class="list-cate">
                        @if (!empty($zoneParentInfo) &&  !empty($zoneDetail) && $zoneParentInfo->Id != $zoneDetail->Id)
                            <a href="{{ $zoneParentInfo->ZoneUrl ?? '' }}" title="{{ $zoneParentInfo->Name ?? '' }}" class="category-name_ac item-cate">{{ $zoneParentInfo->Name ?? '' }}</a>
                            @if(!empty($zoneDetail))
                                <a href="{{ $zoneDetail->ZoneUrl ?? '' }}" title="{{ $zoneDetail->Name ?? '' }}" class="item-cate" data-role="cate-name">{{ $zoneDetail->Name ?? '' }}</a>
                            @endif
                        @elseif(!empty($zoneDetail))
                            <a href="{{ $zoneDetail->ZoneUrl ?? '' }}" title="{{ $zoneDetail->Name ?? '' }}" class="category-name_ac item-cate" data-role="cate-name">{{ $zoneDetail->Name ?? '' }}</a>
                        @endif
                    </div>
                    <h1 class="title-detail" data-role="title">{{$newsContent->Title??''}}</h1>
                </div>

                <div class="detail__sm-flex">
                    <div class="detail-main">
                        <div class="flex-audito-author">
                            <span class="date">
                                {{$newsContent->DateTime ??''}}
                            </span>
                        </div>

                        <h2 class="sapo mt-10" data-role="sapo">
                            {!! $newsContent->Sapo ?? '' !!}
                        </h2>

                        <div class="detail-cmain">
                            <div class="detail-content afcbc-body  {{(!empty($newsContent->checkOld))?'detail-old':''}}" data-role="content" itemprop="articleBody">
                                <div data-check-position="body_start"></div>
                                @if (!empty($newsContent->Avatar) && $newsContent->showAvatar==true)
                                    <div class="detail-cover">
                                        <div class="media VCSortableInPreviewMode ">
                                            <img fetchpriority="high"
                                                src="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,730)}}"
                                                alt="{{$newsContent->AvatarDesc}}"
                                                title="{{$newsContent->AvatarDesc}}"
                                                data-role='avatar'/>
                                            @if(!empty($newsContent->AvatarDesc))
                                                <div class="PhotoCMS_Caption">
                                                    <p>{{!empty($newsContent->AvatarDesc)?$newsContent->AvatarDesc:''}}</p>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @elseif(!empty($newsContent->jframeAvartar))
                                    <div class="detail-cover">
                                        <div class="VCSortableInPreviewMode" type="insertembedcode">
                                            {!! $newsContent->jframeAvartar !!}
                                        </div>
                                    </div>
                                @endif
                                {!! $newsContent->Body ?? '' !!}
                                @if(isset($newsContent->checkOld) && $newsContent->checkOld == false && !empty($newsContent->Author))
                                    <p style="text-align: right;">
                                        <b>   {{$newsContent->Author ??''}}  </b>
                                    </p>
                                @elseif(!empty($newsContent->Author))
                                    <p style="text-align: right;">
                                        <b>   {{$newsContent->Author ??''}}  </b>
                                    </p>
                                @endif
                                <div data-check-position="body_end" class="clearfix"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
