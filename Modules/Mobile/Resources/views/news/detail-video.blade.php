@extends('mobile::layout.master')
@section('title'){{(!empty($newsContent->MetaTitle))?$newsContent->MetaTitle:$newsContent->Title}}@endsection
@section('description'){{(!empty($newsContent->MetaDescription))?$newsContent->MetaDescription:$newsContent->Sapo}}@endsection
@section('keywords'){{(!empty($newsContent->MetaKeyword))?$newsContent->MetaKeyword:$newsContent->TagItem}}@endsection
@section('news_keywords'){{(!empty($newsContent->MetaNewsKeyword))?$newsContent->MetaNewsKeyword:$newsContent->TagItem}}@endsection
@section('og-title'){{(!empty($newsContent->Title))?$newsContent->Title:''}}@endsection
@section('og-description'){{(!empty($newsContent->Sapo))?$newsContent->Sapo:''}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{(!empty($newsContent->OgImage))?UserInterfaceHelper::formatThumbZoom($newsContent->OgImage,600,315):config('siteInfo.default_share')}}@endsection
@section('published_time'){{!empty($newsContent->DistributionDate)?$newsContent->DistributionDate:''}}@endsection
@section('article_author'){{!empty($newsContent->Author)?$newsContent->Author:''}}@endsection
@if(!empty($newsContent->exclusivePostOtherSite))
@section('Canonical'){{$newsContent->exclusivePostOtherSite}}@endsection
@endif
@if(isset( $newsContent->noFollow ))
@section('Robots'){{'noindex, nofollow'}}@endsection
@endif
@section('css')
    @include('mobile::expert.Css-detail')
    <style>
        .vPlayer iframe{
            width: 100% !important;
        }
        .video-big{
            position: relative;
            height: 0;
            padding-bottom: 56.26%;
            margin-bottom: 30px;
        }
    </style>
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
@endsection
@section('js')
    @include('mobile::expert.Js-detail')
@endsection
@section('content')
    <div class="detail__video">
        <div class="detail-content" data-role="content">
            <div class="video-big">
                <div class="vPlayer">
                    @if(!empty($newsContent->VideoYoutube))
                        <div class="VCSortableInPreviewMode" type="insertembedcode">
                            {!!  $newsContent->VideoYoutube !!}
                        </div>
                    @endif
                    @if(!empty($newsContent->VideoMedia))
                        <div class="VCSortableInPreviewMode active" type="VideoStream"
                            embed-type="4"
                            data-width="640px" data-height="360px"
                            data-item-id="{{$newsContent->NewsId}}"
                            data-vid="{{UserInterfaceHelper::formatAddDomainVid($newsContent->VideoMedia->FileName)}}"
                            data-info="{{$newsContent->VideoMedia->KeyVideo}}"
                            data-autoplay="false"
                            data-removedlogo="false" data-location="" data-displaymode="0"
                            data-thumb="{{$newsContent->VideoMedia->Poster}}"
                            data-contentid="" data-namespace="{{config('siteInfo.NAME_SPACE')}}"
                            data-originalid="7">
                        </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="container">
            <div class="box-video-main">
                @include('mobile::news.components.box-breadcrumb')

                <h1 class="title-detail" data-role="title">{{$newsContent->Title??''}}</h1>

                <div class="flex-audito-author">
                    <span class="date">
                          {{$newsContent->DateTime ??''}}
                    </span>
                </div>
                <h2 class="sapo" data-role="sapo">
                    {!! $newsContent->Sapo ?? '' !!}
                </h2>

                @include('mobile::news.components.box-tag')

                @include('mobile::news.components.social-bottom-photo')

            </div>
        </div>
    </div>

    <div class="insert-detail-video hidden"></div>

    <div class="configHidden no-auto-load">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
