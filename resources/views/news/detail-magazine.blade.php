@extends('layout.master')
@section('title'){{(!empty($newsContent->MetaTitle))?$newsContent->MetaTitle:$newsContent->Title ?? ''}}@endsection
@section('description'){{(!empty($newsContent->MetaDescription))?$newsContent->MetaDescription:strip_tags($newsContent->Sapo)??''}}@endsection
@section('keywords'){{(!empty($newsContent->MetaKeyword))?$newsContent->MetaKeyword:$newsContent->TagItem ?? ''}}@endsection
@section('og-title'){{(!empty($newsContent->Title))?$newsContent->Title:''}}@endsection
@section('og-description'){{(!empty($newsContent->Sapo))?strip_tags($newsContent->Sapo):''}}@endsection
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
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-detail-magazine')
    @if (!empty($newsContent->Avatar3))
        <link rel="preload" href="{{UserInterfaceHelper::formatThumbMagazine($newsContent->Avatar3,null,1)}}" as="image" fetchpriority="high">
    @endif

    <style>
        .sp-body-content {
            background: {{(!empty($newsContent->bgColor))?$newsContent->bgColor:'#fff'}};
        }

        [data-role="content"] p, [data-role="content"] p span, .VCSortableInPreviewMode[type="credit"] .credit-item label, .VCSortableInPreviewMode[type="credit"] .credit-item div, .VCSortableInPreviewMode[type="credit"] .ttvn-link, .publish-date {
            color: {{(!empty($newsContent->textColor))?$newsContent->textColor:'#292929'}}   !important;
        }

        [data-role="content"] .backgroundoff .IMSRadioLabel.showResult {
            background-image: unset !important;
        }


        .magazine .detail-like-fb {
            background: transparent;
            padding: 0 150px 40px 150px;
        }

        .container-magazine {
            padding-bottom: 40px;
        }

        .magazine .detail-comment {
            width: 680px;
            margin: 0 auto;
        }

        @if(!empty($newsContent->bgImage))
                 .sp-body-content {
            background-image: url('{{(!empty($newsContent->bgImage))?$newsContent->bgImage:""}}') !important;
        }

        @endif
          .detail__sm-flex-img{
            justify-content: center;
        }
        .mt-50{
            margin-top: 50px;
        }
        .container-magazine .detail-content {
            background: transparent;
            padding: 48px 150px 0px;
        }
        .container-magazine {
            padding-bottom: unset;
        }
    </style>
@endsection
@section('js')
    @include('expert.Js-detail-magazine')
@endsection
@section('content')

    <div class="detail__emagazine">
        <div class="detail__maga-content magazine">
            <div class="detailmaincontent" data-layout="1">
                @if(empty($newsContent->VideoCover)  )
                    @if(!empty($newsContent->embedCode))
                        {!! $newsContent->embedCode !!}
                    @elseif(!empty($newsContent->Avatar3))
                        <img data-role="cover" class="box-category-avatar"
                            src="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar3,1920)}}"
                            alt="img">
                    @endif
                @else
                    <div class="sp-cover video-cover">
                        <img class="bg-cover" data-role="cover" src="{{UserInterfaceHelper::formatThumbWidth($newsContent->VideoCover->thumb??'',1920)}}" alt="img" id="playOnSite">
                        <div class="videobg-content hidden" id="vPlayerv2">
                            <div class="VCSortableInPreviewMode active" type="VideoStream" embed-type="4"
                                data-width="1170px" data-height="658px" data-item-id="{{$newsContent->NewsId}}"
                                data-vid="{{UserInterfaceHelper::formatAddDomainVid($newsContent->VideoCover->filename)}}"
                                data-info="{{$newsContent->VideoCover->key}}" data-autoplay="false"
                                data-removedlogo="false" data-location="" data-displaymode="0"
                                data-thumb="{{$newsContent->VideoCover->thumb}}" data-contentid=""
                                data-namespace="{{config('siteInfo.NAME_SPACE')}}" data-originalid="7" data-cover="true">
                                @if(!empty($newsContent->VideoCoverText))
                                    <span class="layer-4"
                                        style="background: url({{UserInterfaceHelper::formatThumbMagazine($newsContent->VideoCoverText,null,1)}}) center center no-repeat;"></span>
                                @endif
                            </div>

                        </div>
                    </div>
                @endif
                <div class="sp-body-content" id="contentMagazine">
                    <div class="container-magazine detail__cmain">
                        <div class="detail-content  contentOuter" data-role="content" itemprop="articleBody">
                            <div data-check-position="body_start"></div>
                            {!! $newsContent->Body !!}
                            <div data-check-position="body_end" class="clearfix"></div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="w830">
                @include('news.components.box-tag')

                @include('news.components.social-bottom')

                <div class="box-news-category">
                    <div class="insert-bottom-magazine hidden"></div>
                </div>

            </div>

        </div>

    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection




