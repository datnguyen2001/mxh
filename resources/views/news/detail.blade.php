@extends('layout.master')
@section('title'){{(!empty($newsContent->MetaTitle))?$newsContent->MetaTitle:$newsContent->Title}}@endsection
@section('description'){{(!empty($newsContent->MetaDescription))?$newsContent->MetaDescription:$newsContent->Sapo}}@endsection
@section('keywords'){{(!empty($newsContent->MetaKeyword))?$newsContent->MetaKeyword:$newsContent->TagItem}}@endsection
@section('news_keywords'){{(!empty($newsContent->MetaNewsKeyword))?$newsContent->MetaNewsKeyword:$newsContent->TagItem}}@endsection
@section('og-title'){{(!empty($newsContent->MetaTitleFaceBook))?$newsContent->MetaTitleFaceBook:$newsContent->Title}}@endsection
@section('og-description'){{(!empty($newsContent->Sapo))?$newsContent->Sapo:''}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').$newsContent->Url}}@endsection
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
        <link rel="preload" href="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,764)}}" as="image" fetchpriority="high">
    @endif
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-detail')
@endsection
@section('js')
    @include('expert.Js-detail')
@endsection
@section('content')
    <div class="detail__section">
        <div class="container">
            <div class="detail__sflex-main">
                <div class="detail__sright">
                    <div class="box-top-title">
                        @include('news.components.box-breadcrumb')
                        <h1 class="title-detail" data-role="title">{{$newsContent->Title??''}}</h1>
                        @include('news.components.box-date-audio')
                    </div>

                    <div class="box-detail-main">
                        @include('news.components.box-sticky')
                        <div class="box-main">
                            <h2 class="sapo" data-role="sapo">
                                {!! $newsContent->Sapo ?? '' !!}
                            </h2>
                            <div class="detail-cmain">
                                <div class="detail-content afcbc-body  {{(!empty($newsContent->checkOld))?'detail-old':''}}"
                                    data-role="content" itemprop="articleBody">
                                    <div data-check-position="body_start"></div>
                                    @if (!empty($newsContent->Avatar) && $newsContent->showAvatar==true && $newsContent->OriginalId != 2)
                                        <div class="detail-cover">
                                            <div class="media VCSortableInPreviewMode ">
                                                <img fetchpriority="high"
                                                    src="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,764)}}"
                                                    alt="{{$newsContent->AvatarDesc}}"
                                                    title="{{$newsContent->AvatarDesc}}"
                                                    data-role='avatar' width="764" height="509"/>
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

                            @include('news.components.box-tag')
                        </div>
                    </div>

                    <div class="box-news-category">
                        <!--box cùng chuyên mục-->
                        <div class="insert-detail-relate hidden" zone-id="{{$newsContent->ZoneId ?? 0}}"></div>
                    </div>

                    <!-- Có thể bạn quan tâm | đọc nhiều -->
                    <div class="insert-detail-bottom hidden"></div>


                </div>

                <div class="detail__sleft">

                    <!--  box nổi bật-->
                    <div class="insert-box-focus"></div>

                    @include('components.category.box-ads-right')
                    <div class="insert-hapodigital"></div>
                </div>
            </div>
        </div>
    </div>

    <script>
        (runinit = window.runinit || []).push(function () {
            $.ajax({
                url: `https://api.hapodigital.com/api/v2/keywords?uri={{config('siteInfo.site_path').Request::getPathInfo()}}`,
                type: 'GET',
                success: function (res) {
                    if (res) {
                        $(res).insertBefore('.insert-hapodigital');
                    }
                },
                timeout: 5000
            });
        });
    </script>
    <div class="configHidden no-auto-load">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
