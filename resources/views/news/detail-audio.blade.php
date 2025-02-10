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
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-detail')
@endsection
@section('js')

{{--    @if(!empty($newsContent->Avatar3->FileName))--}}
{{--        <script>--}}
{{--            var playeridAudioDetail = "{{'audio-'.$newsContent->NewsId}}";--}}
{{--            var secureTokenAudioDetail = "{{env('AUDIO_TOKEN')}}";--}}
{{--            var paramsAudioDetail = {--}}
{{--                autoplay: true,--}}
{{--                colorAudioPodcast: "#626161",--}}
{{--                file: '{{!empty($newsContent->Avatar3->FileName)?$newsContent->Avatar3->FileName:''}}'--}}
{{--            };--}}
{{--        </script>--}}
{{--    @endif--}}

    @include('expert.Js-detail')
    <script>
        var UrlNextPodcast = "{{!empty($relationNewsList[0]->Url)?$relationNewsList[0]->Url:''}}";
        @if(!empty($newsContent->Avatar3->FileName))
            window.addEventListener('load', (event) => {
            var playerid = "{{'audio-'.$newsContent->NewsId}}";
            var secureToken = "{{env('AUDIO_TOKEN')}}";
            var params = {
                autoplay: true,
                colorAudioPodcast: "#fff",
                file: '{{!empty($newsContent->Avatar3->FileName)?$newsContent->Avatar3->FileName:'
        '}}'
            };
            playerInitScript(playerid, {
                params: params,
                secure: secureToken,
            }, function () {
                var player = this; // callback trả về player khi init thành công
                addListenVideoEnd();
                if ($.cookie('isNotAutoNext') == null) {
                    $(".auto-play").addClass("active");
                    $("#auto-play").attr("checked", true);
                }
                clickAutoNext();
            });

        });
        @endif
        function clickAutoNext() {
            $('.auto-play .switch').click(function () {
                if ($(this).parents('auto-play').hasClass('active')) {
                    $(this).parents('auto-play').removeClass('active')
                    $("#auto-play").attr("checked", false);
                } else {
                    $(this).parents('auto-play').addClass('active')
                    $("#auto-play").attr("checked", true);
                }
                if ($.cookie('isNotAutoNext') == null) {
                    $.cookie("isNotAutoNext", 1, {
                        expires: 10
                    });
                } else {
                    $.removeCookie("isNotAutoNext");
                }
                addListenVideoEnd();
            });
        }

        function addListenVideoEnd() {
            var currentVideoStream = $('.player-funcs .audioPodcastPlayer');
            var currentPlayerId = '';

            if (currentVideoStream.find('audio').length > 0) {
                currentPlayerId = currentVideoStream.find('audio').attr('id').replace('_html5_api', '');
            }
            var players = playerInitScript.getPlayers();
            if (players != null) {
                var player = playerInitScript.getPlayers()[currentPlayerId];

                if (player != null) {
                    player.one('player:endedcontent', function () {
                        if ($.cookie('isNotAutoNext') == 1)
                            return;
                        // var currentVideoId = currentVideoStream.attr("data-item-id");
                        //
                        // var item = $('#relate-audio-slider .swiper-slide[data-id="' + currentVideoId + '"]');
                        // if (item.length == 0) {
                        //     itemNext = $('#relate-audio-slider .swiper-slide').first();
                        // }else{
                        //     itemNext = $('#relate-audio-slider .swiper-slide').first();
                        // }
                        var url = UrlNextPodcast;
                        window.location.href = url;

                    });
                }
            }
        }
    </script>
@endsection
@section('content')
    <div class="list__podcast-detail" style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,1920)}}) no-repeat center center;
        background-size: cover;min-height: 520px">
        <div class="container">
            <div class="list__pd-content ">
                <div class="list__pd-content">
                    @if(!empty($zoneInfo))
                    <div class="box-category-info">
                        <a class="box-category-category" href="{{$zoneInfo->ZoneUrl}}" title="{{$zoneInfo->Name}}">{{$zoneInfo->Name}}</a>
                        <span class="box-category-time time-ago" >
                            {{date("d/m/Y H:i",strtotime($newsContent->DistributionDate))}}
                        </span>
                    </div>
                    @endif
                    <h2>
                        <a data-type="title" data-linktype="newsdetail" data-id="{{$newsContent->NewsId}}"
                           class="box-category-link-title" href="{{$newsContent->Url}}"
                           title="{{$newsContent->Title}}">{{$newsContent->Title}}</a>
                    </h2>

                    <p data-type="sapo" class="box-category-sapo" data-trimline="4">{{$newsContent->Sapo}}</p>

                    <div class="box-player box-radio">
                        <div class="player-funcs">
                            @if(!empty($newsContent->Avatar3->FileName))
                            <audio id="{{'audio-'.$newsContent->NewsId}}" playsinline webkit-playsinline height="300"
                                   width="545" autoplay="true" data-item-id="{{$newsContent->NewsId}}"
                                   title="{{ htmlspecialchars(str_replace(['\\'],'',$newsContent->Title), ENT_QUOTES, 'UTF-8')}}"></audio>
                            @else
                            {!! !empty($newsContent->audioIframe)?$newsContent->audioIframe:'' !!}
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="list__podcast-detail-list">
        <div class="container">
            <div class="box-category box-border-top" data-layout="22">
                <div class="box-category-middle">
                    <div class="swiper podcast-swiper">
                        <div class="swiper-wrapper">
                            <div class="swiper-slide" data-id="{{$newsContent->NewsId}}">
                                <div class="box-category-item  is-live">
                                    <a class="box-category-link-with-avatar img-resize" href="{{$newsContent->Url}}"
                                       title="{{$newsContent->Title}}">
                                        <img data-type="avatar"
                                             src="{{UserInterfaceHelper::formatThumbZoom($newsContent->Avatar,96,60)}}"
                                             alt="{{$newsContent->Title}}" class="box-category-avatar">
                                    </a>
                                    <div class="box-category-content">
                                        <h3>
                                            <a data-type="title" data-linktype="newsdetail"
                                               class="box-category-link-title" href="{{$newsContent->Url}}"
                                               title="{{$newsContent->Title}}" data-trimline="2">
                                            <span class="stt-live">
                                                <svg width="6" height="7" viewBox="0 0 6 7" fill="none"
                                                     xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M0 6.9662L6 3.50068L0 0.0351562V6.9662Z" fill="white"/>
                                                </svg>
                                                Đang phát
                                            </span>
                                                {{$newsContent->Title}}
                                            </a>
                                        </h3>
                                        <span class="box-category-time time-ago">
                                        {{date('H:i , d/m/Y',strtotime($newsContent->DistributionDate))}}
                                    </span>
                                    </div>
                                </div>
                            </div>

                            @if(!empty($relationNewsList))
                                @foreach($relationNewsList as $key => $item)
                                    <div class="swiper-slide" data-id="{{$item->NewsId}}">
                                        <div class="box-category-item ">
                                            <a class="box-category-link-with-avatar img-resize" href="{{$item->Url}}"
                                               title="{{$item->Title}}">
                                                <img data-type="avatar" src="{{$item->ThumbImage}}"
                                                     alt="{{$item->Title}}"
                                                     class="box-category-avatar">
                                            </a>
                                            <div class="box-category-content">
                                                <h3>
                                                    <a data-type="title" data-linktype="newsdetail"
                                                       class="box-category-link-title" href="{{$item->Url}}"
                                                       title="{{$item->Title}}" data-trimline="2">
                                                        {{$item->Title}}
                                                    </a>
                                                </h3>
                                                <span class="box-category-time time-ago">
                                        {{$item->DateTime}}
                                    </span>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>

                    </div>
                    <div class="podcast-next">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="M7.00053 0.455078L5.83053 1.59481L10.396 6.18235H0.455078V7.81871H10.396L5.83053 12.3784L7.00053 13.546L13.546 7.00053L7.00053 0.455078Z"
                                fill="#686868"/>
                        </svg>
                    </div>
                    <div class="podcast-prev">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M7 0L8.25125 1.21887L3.36875 6.125H14V7.875H3.36875L8.25125 12.7514L7 14L0 7L7 0Z"
                                  fill="#686868"/>
                        </svg>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="list__postcast-content">
        <div class="container-660">
            <div class="detail-container" data-layout="1">
                    <div class="detail-cmain">
                        <div class="detail-podcast-content detail-content" data-role="content">
                            <div class="media VCSortableInPreviewMode ">
                                {!! $newsContent->Body !!}
                            </div>
                        </div>
                    </div>
                <p class="detail-podcast-author">{{$newsContent->Author}}</p>
                <div class="detail-like-fb box-category-like-share">
                    @include('news.components.box-social-bottom')
                </div>
                <div class="detail-comment unactive">
                                    @include('news.components.box-comment')
                                </div>
                <div class="detail-tab">
                    @if(!empty($newsContent->Tag))
                        @foreach($newsContent->Tag as $key => $item)
                            <a href="{{$item->Url}}" class="item">{{$item->Name}}</a>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="list__podcast-detail-related">
        <div class="container">
            <div class="box-category box-border-top" data-layout="21" >
                <div class="box-category-top top-news-more">
                    <h2 class="title-category">
                        <a class="box-category-title">
                        <span class="icon">
                            <svg width="14" height="15" viewBox="0 0 14 15" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M8.80881 0.749132C8.91465 0.593056 9.08827 0.5 9.27363 0.5L13.4328 0.500001C13.8845 0.500001 14.1544 1.01587 13.9046 1.40188L5.59682 14.2404C5.4919 14.4025 5.31479 14.5 5.12506 14.5L0.567192 14.5C0.109886 14.5 -0.158761 13.9727 0.102364 13.5877L8.80881 0.749132Z"
                                    fill="#B70002"/>
                            </svg>

                        </span>
                            xem thêm
                        </a>
                    </h2>
                </div>
                <div class="box-category-middle">
                    @if(!empty($listSubCat))
                        @foreach($listSubCat as $key => $item)
                            @if($item->Id!=$zoneInfo->Id)
                                <div class="box-category-item" data-id="{{$item->Id}}">
                                <a class="box-category-link-with-avatar img-resize" href="{{$item->ZoneUrl}}"
                                   title="{{$item->Name}}" data-id="{{$item->Id}}">
                                    <img data-type="avatar" src="{{!empty($item->squareAvatar)?UserInterfaceHelper::formatThumbZoom($item->squareAvatar,272,272):$item->ThumbImage}}"
                                         alt="{{!empty($item->Name)?$item->Name:''}}" class="box-category-avatar">
                                </a>
                                <div class="box-category-content">
                                    <h3>
                                        <a data-type="title" data-linktype="newsdetail"
                                           class="box-category-link-title"
                                           href="{{$item->ZoneUrl}}"
                                           title="{{$item->Name}}">{{$item->Name}}</a>
                                    </h3>
                                    <span class="box-category-time time-ago" >
                            {{date('H:i , d/m/Y',strtotime($item->CreatedDate))}}
                        </span>
                                </div>
                                <a href="{{$item->ZoneUrl}}" class="box-category-bottom">
                                    <div class="text">
                            <span class="icon">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M7.42801 11.9994H9.1423C9.4454 11.9994 9.73609 12.1199 9.95042 12.3342C10.1647 12.5485 10.2852 12.8392 10.2852 13.1423V15.9994C10.2852 16.3025 10.1647 16.5932 9.95042 16.8076C9.73609 17.0219 9.4454 17.1423 9.1423 17.1423H7.42801C7.12491 17.1423 6.83422 17.0219 6.61989 16.8076C6.40556 16.5932 6.28516 16.3025 6.28516 15.9994V11.9994C6.28516 8.84344 8.84344 6.28516 11.9994 6.28516C15.1554 6.28516 17.7137 8.84344 17.7137 11.9994V15.9994C17.7137 16.3025 17.5933 16.5932 17.379 16.8076C17.1647 17.0219 16.874 17.1423 16.5709 17.1423H14.8566C14.5535 17.1423 14.2628 17.0219 14.0485 16.8076C13.8341 16.5932 13.7137 16.3025 13.7137 15.9994V13.1423C13.7137 12.8392 13.8341 12.5485 14.0485 12.3342C14.2628 12.1199 14.5535 11.9994 14.8566 11.9994H16.5709C16.5709 10.787 16.0892 9.62426 15.2319 8.76695C14.3746 7.90964 13.2119 7.42801 11.9994 7.42801C10.787 7.42801 9.62426 7.90964 8.76695 8.76695C7.90964 9.62426 7.42801 10.787 7.42801 11.9994Z"
                                        fill="#686868"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M12 22.4571C17.7753 22.4571 22.4571 17.7753 22.4571 12C22.4571 6.22468 17.7753 1.54286 12 1.54286C6.22468 1.54286 1.54286 6.22468 1.54286 12C1.54286 17.7753 6.22468 22.4571 12 22.4571ZM12 24C18.6274 24 24 18.6274 24 12C24 5.37258 18.6274 0 12 0C5.37258 0 0 5.37258 0 12C0 18.6274 5.37258 24 12 24Z"
                                          fill="#686868"/>
                                </svg>

                            </span>
                                        Nghe tất cả
                                    </div>
                                    <span class="icon-more">
                            <svg width="14" height="14" viewBox="0 0 14 14" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M7 0L5.74875 1.21887L10.6312 6.125H0V7.875H10.6312L5.74875 12.7514L7 14L14 7L7 0Z"
                                    fill="#686868"/>
                            </svg>
                        </span>
                                </a>
                            </div>
                            @endif
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    {!!$ZoneInfoClientScriptNewtype!!}
@endsection
