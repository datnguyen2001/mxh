@extends('mobile::layout.master')
@section('title'){{ !empty($newsContent->MetaTitle) ? $newsContent->MetaTitle : $newsContent->Title }}@endsection
@section('description'){{ !empty($newsContent->MetaDescription) ? $newsContent->MetaDescription : $newsContent->Sapo }}@endsection
@section('keywords'){{ !empty($newsContent->MetaKeyword) ? $newsContent->MetaKeyword : $newsContent->TagItem }}@endsection
@section('og-title'){{ !empty($newsContent->Title) ? $newsContent->Title : '' }}@endsection
@section('og-description'){{ !empty($newsContent->Sapo) ? $newsContent->Sapo : '' }}@endsection
@section('OgUrl'){{ config('siteInfo.site_path').Request::getPathInfo() }}@endsection
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
    @include('mobile::expert.Css-detail-magazine')
    @if (!empty($newsContent->Avatar3))
        <link rel="preload" href="{{UserInterfaceHelper::formatThumbMagazine(!empty($newsContent->Avatar4)?$newsContent->Avatar4:$newsContent->Avatar3,null,1)}}" as="image" fetchpriority="high">
    @endif
    <style>
        .magazine,.sp-body-content {
            background: {{(!empty($newsContent->bgColor))?$newsContent->bgColor:'white'}} !important;
        }

        [data-role="content"] p, .VCSortableInPreviewMode[type="credit"] .credit-item label, .VCSortableInPreviewMode[type="credit"] .credit-item div, .VCSortableInPreviewMode[type="credit"] .ttvn-link, .publish-date {
            color: {{(!empty($newsContent->textColor))?$newsContent->textColor:'#333'}}   !important;
        }
        [data-role="content"] .kbwscwl-relatedbox.type-3 .kbwscwlrl-next{
            text-align: center;
        }

        @if(!empty($newsContent->bgImage))
             .magazine, .sp-body-content {
            background-image: url('{{(!empty($newsContent->bgImage))?$newsContent->bgImage:""}}')!important;
        }
         @endif
    </style>

    @if (!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
@endsection
@section('js')
    @include('mobile::expert.Js-detail')
@endsection
@section('content')
    <div class="detail__emagazine">
            <div class="detail__emaga-flex-col">
                <div class="detail__magazine magazine">
                    <div class="sp-cover" style="text-align: center;">
                        @if(!empty($newsContent->embedCode))
                            {!! $newsContent->embedCode !!}
                        @elseif(!empty($newsContent->Avatar3))
                            <img data-role="cover"
                                src="{{UserInterfaceHelper::formatThumbMagazine(!empty($newsContent->Avatar4)?$newsContent->Avatar4:$newsContent->Avatar3,null,1)}}"
                                alt="img">
                        @endif
                    </div>
                    <div class="detail__maga-content">
                        <div class="sp-body-content" id="contentMagazine">
                            <div class="container-magazine  detail-cmain">
                                <div class="detail-content  contentOuter {{(!empty($newsContent->checkOld))?'detail-old':''}}"
                                    data-role="content" itemprop="articleBody" data-io-article-url="{{$newsContent->Url}}">
                                    @if(!empty($zoneDetail->ZoneUrl) && $zoneDetail->ZoneUrl=='/danh-cho-ban-doc-vip.htm')
                                        <div id="contentDetailAjax"></div>
                                    @else
                                        <div data-check-position="body_start"></div>
                                        {!! $newsContent->Body !!}

                                        <div data-check-position="body_end" class="clearfix"></div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        <div class="container">
            @include('mobile::news.components.box-tag')

            @include('mobile::news.components.social-bottom')
        </div>
    </div>

    <div class="insert-bottom-magazine hidden"></div>


    <div class="configHidden">
        {!! $ZoneInfoClientScriptNewtype ??'' !!}
            {!!$ZoneInfoClientScript ??''!!}
    </div>
@endsection
