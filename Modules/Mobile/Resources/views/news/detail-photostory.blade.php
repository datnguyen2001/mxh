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
        .detail-cmain [data-role=content] .VCSortableInPreviewMode.alignJustifyFull {
            width: 100vw!important;
            position: relative;
            margin-left: calc(-50vw + 8px);
            left: 50%;
            max-width: calc(100vw - 20px);
        }
        .detail-cmain [data-role=content] h2,
        .detail-cmain [data-role=content] h3,
        .detail-cmain [data-role=content] h4,
        .detail-cmain [data-role=content] h5,
        .detail-cmain [data-role=content] h6{
            color: #fff;
        }
        .detail-cmain [data-role=content]{
            color: #fff;
        }
        .detail-cmain [data-role="content"] .VCSortableInPreviewMode[type="RelatedNewsBox"] .kbwscwl-relatedbox .kbwscwlrl-title a.title,
        .detail-cmain [data-role="content"] .kbwscwl-relatedbox a.title{
            color: #fff;
        }
        .detail-cmain [data-role=content] .VideoCMS_Caption,
        .detail-cmain [data-role=content] .PhotoCMS_Caption{
            color: #111111;
        }
        .detail-cmain [data-role="content"] .VCSortableInPreviewMode[type="RelatedNewsBox"][relatednewsboxtype="type-6"] .kbwscwl-relatedbox .kbwscwlrl-title a.title,
        .detail-cmain [data-role="content"] .VCSortableInPreviewMode[type="RelatedNewsBox"][relatednewsboxtype="type-1"] .kbwscwl-relatedbox .kbwscwlrl-title a.title{
            color: #333333;
        }

        [data-role="content"] .VCSortableInPreviewMode[type=BoxTable]::-webkit-scrollbar{
            display: none;
        }
        [data-role="content"] .VCSortableInPreviewMode[type=BoxTable]{
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;
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
    <div class="detail__section bg">
        <div class="container">
            <div class="detail__smain">
                @include('mobile::news.components.box-breadcrumb')

                <h1 class="title-detail" data-role="title">{{$newsContent->Title??''}}</h1>
                @include('mobile::news.components.box-date-audio')
                <h2 class="sapo" data-role="sapo">
                    {!! $newsContent->Sapo ?? '' !!}
                </h2>

                <div class="detail-cmain">
                    <div class="detail-content afcbc-body  {{(!empty($newsContent->checkOld))?'detail-old':''}}" data-role="content" itemprop="articleBody">
                        <div data-check-position="body_start"></div>
                        @if($newsContent->Type == 13)
                            @if(!empty($newsContent->VideoYoutube))
                                <div class="entry-content">
                                    <div class="VCSortableInPreviewMode" type="insertembedcode">
                                        {!!  $newsContent->VideoYoutube !!}
                                    </div>
                                </div>
                            @endif
                            @if(!empty($newsContent->VideoMedia))
                                <div class="VCSortableInPreviewMode active" type="VideoStream" embed-type="4"
                                    data-width="1170px" data-height="658px"
                                    data-item-id="{{$newsContent->NewsId}}"
                                    data-vid="{{UserInterfaceHelper::formatAddDomainVid($newsContent->VideoMedia->FileName)}}"
                                    data-info="{{$newsContent->VideoMedia->KeyVideo}}" data-autoplay="false"
                                    data-removedlogo="false" data-location="" data-displaymode="0"
                                    data-thumb="{{$newsContent->VideoMedia->Poster}}"
                                    data-contentid="" data-namespace="{{config('siteInfo.NAME_SPACE')}}" data-originalid="7">
                                </div>
                            @endif
                        @else
                            @if (!empty($newsContent->Avatar) && $newsContent->showAvatar==true && $newsContent->OriginalId != 2)
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

                @include('mobile::news.components.box-tag')

                @include('mobile::news.components.social-bottom-photo')
            </div>
        </div>
    </div>
    <!--box cùng chuyên mục-->
    <div class="insert-detail-relate hidden" zone-id="{{$newsContent->ZoneId ?? 0}}"></div>
    <!-- Có thể bạn quan tâm | đọc nhiều -->
    <div class="insert-detail-bottom hidden"></div>
    <div class="configHidden no-auto-load">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
