@extends('layout.master')
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
    @if (!empty($newsContent->Avatar) && $newsContent->showAvatar != false && empty($newsContent->jframeAvartar))
        <link rel="preload" href="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,1245)}}" as="image" fetchpriority="high">
    @endif
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-detail-magazine')
    <style>
        .container-magazine .detail-content {
            padding: 0 150px 0;
        }
        .container-magazine{
            width: 1130px;
        }
    </style>
@endsection
@section('js')
    @include('expert.Js-detail')
@endsection
@section('content')
    <div class="detail__section">
        <div class="detail__special">
            <div class="box-top-title">
                <div class="w830">
                    @include('news.components.box-breadcrumb')
                </div>

                <h1 class="title-detail" data-role="title">{{$newsContent->Title??''}}</h1>

                <div class="w830">
                    @include('news.components.box-date-audio')

                </div>
                <h2 class="sapo w830" data-role="sapo">
                    {!! $newsContent->Sapo ?? '' !!}
                </h2>
                <div class="detail__maga-content magazine">
                    <div class="detailmaincontent" data-layout="1">
                        <div class="sp-body-content" id="contentMagazine">
                            <div class="container-magazine detail__cmain">
                                <div class="detail-content  contentOuter" data-role="content" itemprop="articleBody">
                                    <div data-check-position="body_start"></div>
                                    <div class="detail-cover">
                                        @if (!empty($newsContent->Avatar) && $newsContent->showAvatar==true && $newsContent->OriginalId != 2)
                                            <div class="media VCSortableInPreviewMode alignCenterOverflow">
                                                <img loading="lazy" fetchpriority="high"
                                                    src="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,1245)}}"
                                                    alt="{{$newsContent->AvatarDesc}}"
                                                    title="{{$newsContent->AvatarDesc}}"
                                                    data-role='avatar' width="1245" height="779"/>
                                                @if(!empty($newsContent->AvatarDesc))
                                                    <div class="PhotoCMS_Caption">
                                                        <p >{{!empty($newsContent->AvatarDesc)?$newsContent->AvatarDesc:''}}</p>
                                                    </div>
                                                @endif
                                            </div>
                                        @elseif(!empty($newsContent->jframeAvartar))
                                            <div class="VCSortableInPreviewMode" type="insertembedcode">
                                                {!! $newsContent->jframeAvartar !!}
                                            </div>
                                        @endif
                                    </div>
                                    {!! $newsContent->Body !!}
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

                <div class="w830">
                    @include('news.components.box-tag')

                    @include('news.components.social-bottom')

                    <div class="box-news-category">
                        <!--box cùng chuyên mục-->
                        <div class="insert-detail-relate hidden" zone-id="{{$newsContent->ZoneId ?? 0}}"></div>
                    </div>

                    <!-- Có thể bạn quan tâm | đọc nhiều -->
                    <div class="insert-detail-bottom hidden"></div>
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden no-auto-load">
        {!!$ZoneInfoClientScript!!}
    </div>

@endsection
