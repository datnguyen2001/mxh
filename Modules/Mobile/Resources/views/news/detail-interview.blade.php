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
@if(!empty($exclusive_post_other_site))
@section('Canonical'){{$exclusive_post_other_site}}@endsection
@endif
@section('css')
    @include('mobile::expert.Css-detail')
    @if(!empty($zoneDetail))
        @include('news.components.GOOGLE_SEARCH')
    @endif
@endsection
@section('script')
    @include('mobile::expert.Js-detail')
    <script>
        (runinit = window.runinit || []).push(function () {
            $(function () {
                quickAnswer.init();

            });
        });
    </script>
    @include('mobile::news.components.ads-inpage')
@endsection
@section('content')
    @if(!empty($zoneDetail))
        @include('mobile::news.components.box-breadcrumb')
    @endif
    <div class="detail__content-page">
        <div class="detail-container" data-layout="1" data-cd-key="keycd">
            <div class="container">
                <div class="detail__contenent-main">
                    <p class="detail-time">{{$newsContent->DistributionDate}} (GMT+7)</p>
                    <div class="news-audio"></div>
                    <h1 class="detail-title" data-role="title">{{$newsContent->Title}}</h1>
                    <h2 class="detail-sapo" data-role="sapo">
                        {{$newsContent->Sapo}}
                    </h2>
                    <div class="mt-30">
                        <x-box-ads nameAds="MSapo"></x-box-ads>
                    </div>
                    <div class="detail-content afcbc-body" data-role="content">
                        @if (!empty($newsContent->Avatar) && $ShowAvatar=='true' && empty($newsContent->jframeAvartar))
                            <div class="media VCSortableInPreviewMode ">
                                <img src="{{UserInterfaceHelper::formatThumbZoom($newsContent->Avatar,740,463)}}"
                                     alt="{{$newsContent->AvatarDesc}}"
                                     title="{{$newsContent->AvatarDesc}}"/>
                                <div class="PhotoCMS_Caption"><p class="" data-placeholder="nhập chú thích" style="text-align: center;">{{$newsContent->AvatarDesc}}</p></div>
                            </div>
                        @elseif(!empty($newsContent->jframeAvartar))
                            <div class="VCSortableInPreviewMode" type="insertembedcode">
                                {!! $newsContent->jframeAvartar !!}
                            </div>
                        @endif
                        {!! $newsContent->Body !!}
                        {{-- Link bài độc quyền--}}
                        @if(!empty($exclusive_post_other_site))
                            <span id="hdExclusive" style="display:none!important">{{$exclusive_post_other_site}}</span>
                        @elseif(!empty($exclusive_post_other))
                            <span id="hdExclusive" style="display:none!important">{{$exclusive_post_other}}</span>
                        @endif
                        @include('mobile::news.components.box_QA')
                    </div>
                    @if($newsContent->Author)
                        <div data-role="author" class="detail-author"> {{$newsContent->Author}} </div>
                    @endif
                </div>
                @include('mobile::news.components.box-social-bottom')
                @include('mobile::news.components.box-tag')
                @include('mobile::news.components.box-comment')
                @include('mobile::news.components.box-related')

            </div>
        </div>

    </div>
    @include('mobile::news.components.box-same-category')

    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
