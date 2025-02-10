@extends('mobile::layout.master-podcast')
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
    @include('mobile::expert.Css-detail')
@endsection
@section('js')
    @include('mobile::expert.Js-detail')
    <script>
        @if(!empty($newsContent->Avatar3->FileName))
        var UrlNextPodcast = "{{!empty($relationNewsList[0]->Url)?$relationNewsList[0]->Url:''}}";
        window.addEventListener('load', (event) => {
            var playerid = "{{'audio-'.$newsContent->NewsId}}";
            var secureToken = "{{env('AUDIO_TOKEN')}}";
            var params = {
                autoplay: true,
                colorAudioPodcast: "#fff",
                file: '{{$newsContent->Avatar3->FileName}}'
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
        @endif
    </script>
@endsection
@section('content')

    <div class="main">
        <div class="list__podcast-detail"
             style="background: linear-gradient(0deg, rgba(0, 0, 0, 0.3), rgba(0, 0, 0, 0.3)), url({{UserInterfaceHelper::formatThumbWidth($newsContent->Avatar,660)}}) no-repeat center center;
                 background-size: cover;min-height: 237px">
            <div class="player-funcs active">
                @if(!empty($newsContent->Avatar3->FileName))
                    <audio id="{{'audio-'.$newsContent->NewsId}}" playsinline webkit-playsinline height="237"
                           width="100%"
                           autoplay="true" data-item-id="{{$newsContent->NewsId}}"
                           title="{{ htmlspecialchars(str_replace(['\\'],'',$newsContent->Title), ENT_QUOTES, 'UTF-8')}}"></audio>
                @else
                    {!! !empty($newsContent->audioIframe)?$newsContent->audioIframe:'' !!}
                @endif
            </div>
        </div>

        <div class="list__podcast-detail-list">
            <div class="container">
                <div class="box-category box-border-top" data-layout="22" data-cd-key="keycd">
                    <div class="box-category-middle">
                        <div class="swiper podcast-swiper">
                            <div class="swiper-wrapper">

                                <div class="swiper-slide">
                                    <div class="box-category-item  is-live">
                                        <a class="box-category-link-with-avatar img-resize" href="{{$newsContent->Url}}"
                                           title="{{$newsContent->Title}}" data-id="{{$newsContent->NewsId}}">
                                            <img data-type="avatar"
                                                 src="{{UserInterfaceHelper::formatThumbZoom($newsContent->Avatar,175,110)}}"
                                                 alt=" {{$newsContent->Title}}" class="box-category-avatar">
                                        </a>
                                        <div class="box-category-content">
                                            <h3>
                                                <a data-type="title" data-linktype="newsdetail"
                                                   data-id="{{$newsContent->NewsId}}"
                                                   class="box-category-link-title is-live"
                                                   data-newstype="{{$newsContent->Type}}" href="{{$newsContent->Url}}"
                                                   title="{{$newsContent->Title}}">
                                                <span class="stt-live">
                                                    <svg width="6" height="7" viewBox="0 0 6 7" fill="none"
                                                         xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M0 6.9662L6 3.50068L0 0.0351562V6.9662Z"
                                                              fill="white"/>
                                                    </svg>
                                                    Đang phát
                                                </span>
                                                    {{$newsContent->Title}}
                                                </a>
                                            </h3>
                                        </div>
                                    </div>
                                </div>
                                @if(!empty($relationNewsList) )
                                    @foreach($relationNewsList as $key=> $value)
                                        @if(!empty($value))
                                            <div class="swiper-slide">
                                                <div class="box-category-item ">
                                                    <a class="box-category-link-with-avatar img-resize"
                                                       href="{{$value->Url}}"
                                                       title="{{$value->Title}}" data-id="{{$value->NewsId}}">
                                                        <img data-type="avatar"
                                                             src="{{$value->ThumbImage}}"
                                                             alt="{{$value->Title}}" class="box-category-avatar">
                                                    </a>
                                                    <div class="box-category-content">
                                                        <h3>
                                                            <a data-type="title" data-linktype="newsdetail"
                                                               data-id="{{$value->NewsId}}"
                                                               class="box-category-link-title is-live"
                                                               data-newstype="{{$value->Type}}"
                                                               href="{{$value->Url}}" title="{{$value->Title}}">
                                                                {{$value->Title}}
                                                            </a>
                                                        </h3>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                @endif

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="detail__podcast">
            <div class="container">
                <div class="detail-container" data-layout="1" data-cd-key="keycd">
                    <div class="detail-cate">
                        <a href="{{(!empty($zoneInfo->ZoneUrl))?$zoneInfo->ZoneUrl:''}}">{{(!empty($zoneInfo->Name))?$zoneInfo->Name:''}}</a>
                    </div>

                    <h1 class="detail-title" data-role="title">{{$newsContent->Title}}</h1>
                    <h2 class="detail-sapo" data-role="sapo">
                        {{$newsContent->Sapo}}
                    </h2>
                    <div class="detail__cmain">
                        <div class="detail-cmain">
                            <div class="detail-content afcbc-body" data-role="content">
                                {!! $newsContent->Body !!}
                                <div class="detail-author">
                                    <p style="text-align: right">
                                        <b>{{!empty($newsContent->Author)?$newsContent->Author:''}}</b></p>
                                </div>
                            </div>

                        </div>

                        <div class="detail-like-fb">
                            @include('news.components.box-social-bottom')
                        </div>

                        <div class="detail-tab">
                            @if(!empty($newsContent->Tag))
                                @foreach($newsContent->Tag as $key => $item)
                                    <a href="{{$item->Url}}" class="item">{{$item->Name}}</a>
                                @endforeach
                            @endif
                        </div>

                        <div class="detail-comment unactive">
                            @include('mobile::news.components.box-comment')
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @if(!empty($listSubCat))
            <div class="list__podcast">
                <div class="container">
                    <div class="box-category box-border-top" data-layout="21" data-cd-key="keycd">
                        <div class="box-category-top">
                            <h2 class="title-category">
                                <a class="box-category-title" href="value-zone-url" title="value-zone-alt">
                            <span class="icon">
                                <svg width="16" height="18" viewBox="0 0 16 18" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M10.584 0.320312C10.7352 0.119644 10.9832 -2.83911e-08 11.248 0L15.1898 8.51107e-07C15.8351 9.7074e-07 16.2206 0.663265 15.8637 1.15956L5.99546 17.6662C5.84558 17.8747 5.59255 18 5.32151 18L0.810274 18C0.156981 18 -0.226801 17.3221 0.146235 16.827L10.584 0.320312Z"
                                        fill="#B70002"/>
                                </svg>

                            </span>
                                    Xem thêm
                                </a>
                            </h2>
                        </div>
                        <div class="box-category-middle">
                            @foreach($listSubCat as $item)
                                <div class="box-category-item" data-id="{{$item->Id}}"
                                     style="{{($item->Id == $newsContent->ZoneId)?'display:none;':''}}">
                                    <a class="box-category-link-with-avatar img-resize" href="{{$item->ZoneUrl}}"
                                       title="{{$item->Name}}">
                                        <img data-type="avatar"
                                             src="{{!empty($item->squareAvatar)?UserInterfaceHelper::formatThumbZoom($item->squareAvatar,320,320):$item->ThumbImage}}"
                                             alt="{{!empty($item->Name)?$item->Name:''}}" class="box-category-avatar">
                                    </a>
                                    <div class="box-category-right">
                                        <div class="box-category-content">
                                            <h3>
                                                <a data-type="title" data-linktype="newsdetail" data-id="{{$item->Id}}"
                                                   class="box-category-link-title"
                                                   href="{{$item->ZoneUrl}}" title="{{$item->Name}}">{{$item->Name}}</a>
                                            </h3>
                                            <span class="box-category-time time-ago" title="{{$item->CreatedDate}}">
                                    {{date('H:i , d/m/Y',strtotime($item->CreatedDate))}}
                                </span>

                                        </div>
                                        <a href="{{$item->ZoneUrl}}" class="box-category-bottom" title=" Nghe tất cả">
                                            <div class="text">
                                    <span class="icon">
                                        <svg width="20" height="20" viewBox="0 0 20 20" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M6.19066 9.9997H7.61923C7.87182 9.9997 8.11406 10.1 8.29267 10.2786C8.47127 10.4573 8.57161 10.6995 8.57161 10.9521V13.333C8.57161 13.5856 8.47127 13.8279 8.29267 14.0065C8.11406 14.1851 7.87182 14.2854 7.61923 14.2854H6.19066C5.93808 14.2854 5.69583 14.1851 5.51723 14.0065C5.33862 13.8279 5.23828 13.5856 5.23828 13.333V9.9997C5.23828 7.3697 7.37019 5.23779 10.0002 5.23779C12.6302 5.23779 14.7621 7.3697 14.7621 9.9997V13.333C14.7621 13.5856 14.6618 13.8279 14.4831 14.0065C14.3045 14.1851 14.0623 14.2854 13.8097 14.2854H12.3811C12.1286 14.2854 11.8863 14.1851 11.7077 14.0065C11.5291 13.8279 11.4288 13.5856 11.4288 13.333V10.9521C11.4288 10.6995 11.5291 10.4573 11.7077 10.2786C11.8863 10.1 12.1286 9.9997 12.3811 9.9997H13.8097C13.8097 8.98935 13.4084 8.02038 12.6939 7.30596C11.9795 6.59153 11.0105 6.19017 10.0002 6.19017C8.98984 6.19017 8.02087 6.59153 7.30645 7.30596C6.59202 8.02038 6.19066 8.98935 6.19066 9.9997Z"
                                                fill="#686868"/>
                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                  d="M10 18.7143C14.8128 18.7143 18.7143 14.8128 18.7143 10C18.7143 5.18723 14.8128 1.28571 10 1.28571C5.18723 1.28571 1.28571 5.18723 1.28571 10C1.28571 14.8128 5.18723 18.7143 10 18.7143ZM10 20C15.5228 20 20 15.5228 20 10C20 4.47715 15.5228 0 10 0C4.47715 0 0 4.47715 0 10C0 15.5228 4.47715 20 10 20Z"
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
                                </div>

                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        @endif

    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
