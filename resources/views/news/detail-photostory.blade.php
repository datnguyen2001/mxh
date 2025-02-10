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
        <link rel="preload" href="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,1160)}}" as="image" fetchpriority="high">
    @endif
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-detail')
    <style>
        .detail__cnt-top-image .text{
            text-align: center;
        }
        .detail-container-full [data-role=content] .VCSortableInPreviewMode.alignJustifyFull {
            width: 100vw!important;
            position: relative;
            margin-left: calc(-50vw + 8px);
            left: 50%;
            max-width: calc(100vw - 20px);
        }
        .detail-container-full [data-role=content] h2,
        .detail-container-full [data-role=content] h3,
        .detail-container-full [data-role=content] h4,
        .detail-container-full [data-role=content] h5,
        .detail-container-full [data-role=content] h6{
            color: #fff;
        }
        .detail-container-full [data-role=content]{
            color: #fff;
        }
        .detail-container-full [data-role="content"] .VCSortableInPreviewMode[type="RelatedNewsBox"] .kbwscwl-relatedbox .kbwscwlrl-title a.title,
        .detail-container-full [data-role="content"] .kbwscwl-relatedbox a.title{
            color: #fff;
        }
        .detail-container-full [data-role=content] .VideoCMS_Caption,
        .detail-container-full [data-role=content] .PhotoCMS_Caption{
            color: #111111;
        }
        .detail-container-full [data-role="content"] .VCSortableInPreviewMode[type="RelatedNewsBox"][relatednewsboxtype="type-6"] .kbwscwl-relatedbox .kbwscwlrl-title a.title,
        .detail-container-full [data-role="content"] .VCSortableInPreviewMode[type="RelatedNewsBox"][relatednewsboxtype="type-1"] .kbwscwl-relatedbox .kbwscwlrl-title a.title{
            color: #333333;
        }

        [data-role="content"] .VCSortableInPreviewMode[type=BoxTable]::-webkit-scrollbar{
            display: none;
        }
        [data-role="content"] .VCSortableInPreviewMode[type=BoxTable]{
            -ms-overflow-style: none;  /* IE and Edge */
            scrollbar-width: none;
        }
        .layout__sticky-icon{
            background: #ffffff;
        }
        .detail__col-images .box-main .flex-audito-author{
            flex-direction: column;
        }
    </style>
@endsection
@section('js')
    @include('expert.Js-detail')
@endsection
@section('content')
    <div class="detail__col-images">
        <div class="box-main">
            <div class="w830">
                @include('news.components.box-breadcrumb')
            </div>
            <h1 class="title-detail" data-role="title">{{$newsContent->Title??''}}</h1>

            <div class="flex-audito-author w830">
                    <span class="date">
                          {{$newsContent->DateTime ??''}}
                    </span>
                <div class="audio">
                      <span class="af-tts">
                        </span>
                </div>
            </div>
            <h2 class="sapo w830" data-role="sapo">
                {!! $newsContent->Sapo ?? '' !!}
            </h2>

            <div class="detail-container-full w830">
                <div class="detail-cmain contentOuter ">
                    <div class="detail-content afcbc-body {{(!empty($newsContent->checkOld))?'detail-old':''}}" data-role="content" itemprop="articleBody">
                        <div class="detail-cover">
                            @if (!empty($newsContent->Avatar) && $newsContent->showAvatar==true && $newsContent->OriginalId != 2)
                                <div class="media VCSortableInPreviewMode alignCenterOverflow">
                                    <img loading="lazy" fetchpriority="high"
                                        src="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,1160)}}"
                                        alt="{{$newsContent->AvatarDesc}}"
                                        title="{{$newsContent->AvatarDesc}}"
                                        data-role='avatar' />
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
                    </div>
                </div>

            </div>

            <div class="w830">
                @include('news.components.box-tag')

                @include('news.components.social-bottom-photo')
            </div>
        </div>

        <div class="box-news-category w830">
            <!--box cùng chuyên mục-->
            <div class="insert-detail-relate hidden" zone-id="{{$newsContent->ZoneId ?? 0}}"></div>
        </div>

        <div class="w830">
            <!-- Có thể bạn quan tâm | đọc nhiều -->
            <div class="insert-detail-bottom hidden"></div>
        </div>

    </div>
    <div class="configHidden no-auto-load">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
