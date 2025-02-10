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
@section('css')
    @include('mobile::expert.Css-detail')

    @if (!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
@endsection
@section('js')
    @include('mobile::expert.Js-detail')
@endsection
@section('content')

    <div class="detail__section">
        <div class="container detail-container-full detail__cmain">
            <h2 class="detail-sapo" data-role="sapo">{!! $newsContent->Sapo ?? '' !!}</h2>
            <div class="detail-cmain">
                <div class="detail-content afcbc-body" data-role="content" itemprop="articleBody"
                     data-io-article-url="{{$newsContent->Url}}">
                    <div data-check-position="body_start"></div>

                    @if (!empty($newsContent->Avatar) && $newsContent->showAvatar== true )
                        <div class="media VCSortableInPreviewMode ">
                            <img loading="lazy"
                                 src="{{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,672)}}"
                                 alt="{{$newsContent->AvatarDesc}}"
                                 title="{{$newsContent->AvatarDesc}}"
                                 data-role='avatar'/>
                            @if(!empty($newsContent->AvatarDesc))
                                <div class="PhotoCMS_Caption">
                                    <p data-placeholder="nhập chú thích"
                                       style="text-align: center;">
                                        {{!empty($newsContent->AvatarDesc)?$newsContent->AvatarDesc:''}}</p>
                                </div>
                            @endif
                        </div>
                    @elseif(!empty($newsContent->jframeAvartar))
                        <div class="VCSortableInPreviewMode" type="insertembedcode">
                            {!! $newsContent->jframeAvartar !!}
                        </div>
                    @endif

                    {!! $newsContent->Body !!}




                    {{-- Link bài độc quyền--}}
                    @if(!empty($newsContent->exclusivePostOtherSite))
                        <span id="hdExclusive"
                              style="display:none!important">{{$newsContent->exclusivePostOtherSite}}</span>
                    @elseif(!empty($newsContent->exclusivePostOther))
                        <span id="hdExclusive"
                              style="display:none!important">{{$newsContent->exclusivePostOther}}</span>
                    @endif

                    <div data-check-position="body_end"></div>
                    <x-layout.box-ads nameAds="Inpage"></x-layout.box-ads>

                </div>


            </div>


        </div>
    </div>



    <div class="configHidden">
        {!! $ZoneInfoClientScript !!}
    </div>
@endsection
