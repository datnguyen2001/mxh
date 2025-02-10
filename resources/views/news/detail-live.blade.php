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
@section('css')
    @include('expert.Css-detail')
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
@endsection
@section('js')
    @include('expert.Js-detail')
    <script type="text/javascript">
        (runinit = window.runinit || []).push(function () {
            var rollingOption = {
                duration: 15000,
                contentPlaceHolder: $("#divRollingNews"),
                hotContentPlaceHolder: $("#hotRollingNews"),
                displayHotContentCallback: function () {
                },
                finallyCallback: function () {
                }
            };

            $(function () {
                rollingNews_api.init('{{$RollingNewsId}}', rollingOption);
            });



            var reverseStatus = 'news';
            $('.btn-reverse').on('click',function (){
                var status = $(this).attr('data-id');

                if (reverseStatus != status) {
                    var cntPlaceHolder = $('#divRollingNews');
                    rollingNews_api.reverse(cntPlaceHolder);
                    reverseStatus = status;
                }
            })

        });

    </script>
@endsection

@section('content')

    <div class="detail__section ">
        <div class="container">
            <div class="detail__flex">
                <div class="detail__sticky">
                    @include('news.components.box-sticky')
                </div>
                <div class="detail__main">
                    <div class="detail__cmain live">
                        <div class="detail__image-main">
                            <div class="detail-top">
                                @include('news.components.box-breadcrumb')
                            </div>

                            @include("news.components.box-title")


                            @include('news.components.box-social-bottom')
                            <h2 class="detail-sapo" data-role="sapo">{!! $newsContent->Sapo ?? '' !!}</h2>
                            @if (!empty($newsContent->Avatar) && $newsContent->showAvatar==true)
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
                                <div class="entry-content-iframe">
                                    {!! $newsContent->jframeAvartar !!}
                                </div>
                            @endif
                            <div class="detail-timelive hidden">
                                <div class="detail__timelive-content">
                                    <div class="swiper detail-time-live-sw">
                                        <div class="swiper-wrapper">
                                        </div>

                                    </div>
                                    <div class="detail-time-live-sw-next">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2937_40758)">
                                                <path d="M24 23.9997V-0.000272751C15.7165 -0.000272751 9 5.36789 9 11.9965C9 18.625 15.7165 23.9997 24 23.9997Z" fill="#0098D1" />
                                            </g>
                                            <path d="M16.2221 8.37892L19.1682 11.5038L16.2221 14.6286C15.926 14.9427 15.926 15.4501 16.2221 15.7642C16.5182 16.0782 16.9966 16.0782 17.2927 15.7642L20.7779 12.0675C21.074 11.7534 21.074 11.246 20.7779 10.9319L17.2927 7.2353C16.9966 6.9212 16.5182 6.9212 16.2221 7.2353C15.9336 7.54939 15.926 8.06483 16.2221 8.37892Z" fill="white" />
                                            <defs>
                                                <clipPath id="clip0_2937_40758">
                                                    <rect width="15" height="24" fill="white" transform="matrix(1 0 0 -1 9 23.9997)" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                    <div class="detail-time-live-sw-prev">
                                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <g clip-path="url(#clip0_2937_40753)">
                                                <g clip-path="url(#clip1_2937_40753)">
                                                    <path d="M9.53674e-07 23.9997V-0.000272751C8.28346 -0.000272751 15 5.36789 15 11.9965C15 18.625 8.28346 23.9997 9.53674e-07 23.9997Z" fill="#0098D1" />
                                                </g>
                                                <path d="M7.7779 15.6205L4.83181 12.4957L7.7779 9.37087C8.07403 9.05677 8.07403 8.54939 7.7779 8.2353C7.48178 7.9212 7.00342 7.9212 6.70729 8.2353L3.2221 11.9319C2.92597 12.246 2.92597 12.7534 3.2221 13.0675L6.70729 16.7642C7.00342 17.0782 7.48178 17.0782 7.7779 16.7642C8.06644 16.4501 8.07403 15.9346 7.7779 15.6205Z" fill="white" />
                                            </g>
                                            <defs>
                                                <clipPath id="clip0_2937_40753">
                                                    <rect width="24" height="24" fill="white" transform="translate(0 -0.000274658)" />
                                                </clipPath>
                                                <clipPath id="clip1_2937_40753">
                                                    <rect width="15" height="24" fill="white" transform="translate(15 23.9997) rotate(-180)" />
                                                </clipPath>
                                            </defs>
                                        </svg>

                                    </div>
                                </div>
                            </div>

                            <div class="detail-timeline" >
                                <div class="detail-tab ">

                                    <div class="title-timeline">
                                        <a href="javascript:void(0);" title="Tin mới nhất" data-id="news" class="item  btn-reverse active">
                                            Tin mới nhất
                                        </a>
                                        <a href="javascript:void(0);" title="Tin cũ nhất" data-id="old" class="item btn-reverse ">
                                            Tin cũ nhất
                                        </a>
                                    </div>
                                    <div class="detail-tab-content " style="width: 100%">
                                        <div class="tab list show" id="divRollingNews" data-role="content" itemprop="articleBody">
                                        </div>
                                    </div>
                                </div>
                            </div>


                            <div class="detail-cmain">
                                <div class="detail-content afcbc-body" data-role="content" data-io-article-url="{{$newsContent->Url}}">
                                    <div data-check-position="body_start"></div>


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
                                </div>

                                @include('news.components.box-source')
                            </div>

                        <!-- dòng sự kiện detail info= {{env('SITE_ID')}}thread:id{{ $newsContent->ThreadId?? 0}} ; data = {{env('SITE_ID')}}threadnews:threadid{{ $newsContent->ThreadId?? 0}}-->
                            <div id="dsk--appen" data-iddsk="{{ $newsContent->ThreadId?? 0}}"></div>

                            @include('news.components.box-related')

                            @include('news.components.box-social-bottom')

                            @include('news.components.box-tag')
                            @include('news.components.box-comment')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
