@extends('mobile::layout.master')
@section('title'){{(!empty($newsContent->MetaTitle))?$newsContent->MetaTitle:$newsContent->Title}}@endsection
@section('description'){{(!empty($newsContent->MetaDescription))?$newsContent->MetaDescription:$newsContent->Sapo}}@endsection
@section('keywords'){{(!empty($newsContent->MetaKeyword))?$newsContent->MetaKeyword:$newsContent->TagItem}}@endsection
@section('news_keywords'){{(!empty($newsContent->MetaNewsKeyword))?$newsContent->MetaNewsKeyword:$newsContent->TagItem}}@endsection
@section('og-title'){{(!empty($newsContent->Title))?$newsContent->Title:''}}@endsection
@section('og-description'){{(!empty($newsContent->Sapo))?$newsContent->Sapo:''}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').$newsContent->Url}}@endsection
@section('OgImage'){{(!empty($newsContent->Avatar))?UserInterfaceHelper::formatThumbZoom($newsContent->Avatar,600,315):''}}@endsection
@section('css')
    @include("mobile::expert.Css-bigstory")
    @include('mobile::news.components.ads-inpage')
@endsection
@section('js')
    @include("mobile::expert.Js-detail")
@endsection
@section('content')
    <input type="hidden" name="hiddenOriginalId" id="hidNewsId" value="{{$newsContent->NewsId ?? ''}}">
    <input type='hidden' name='hdZoneId' id='hdZoneId' value='{{$newsContent->ZoneId ?? ''}}' />
    <input type="hidden" name="hiddenOriginalId" id="hiddenOriginalId" value="7">
    <input type="hidden" name="hiddenTitle" id="hiddenTitle"
           value="{{$newsContent->Title ?? ''}}">
    <input type="hidden" name="hidLastModifiedDate" id="hidLastModifiedDate" value="{{$newsContent->DistributionDate ?? ''}}">
    <div class="cf submn_w" style="margin-top: 0px;">
        <div class="ovh submn-head">
            <h1><a class="itp" href="{{!empty($zoneDetail->ZoneUrl)?$zoneDetail->ZoneUrl:""}}"  data-role="cate-name">{{!empty($zoneDetail->Name)?$zoneDetail->Name:""}}</a></h1>

            <a class="expand_ico_big" onclick="toggle_catsub(this,'.cat-sub')" href="javascript:void(0)"
               rel="nofollow" data="o"></a>
        </div>
        <div class="ovh cat-sub equal-height" style="display: none;">
            <ul>
                @if(!empty($listSubCat))
                    @foreach($listSubCat as $key =>$item)
                        <li style="height: auto;"><a title="{{$item->Name ?? ''}}" href="{{$item->ZoneUrl ?? ''}}" class="">{{$item->Name ?? ''}}</a>
                        </li>
                    @endforeach
                @endif
            </ul>
        </div>
    </div>

    <div class="news-detail-container">
        <div class="ovh detail_w">
            <div class="bigstop">
                <div class="big-date" data-role="publishdate">Cập nhật lúc {{date('H:i d/m/Y',strtotime($newsContent->DistributionDate))}}</div>
                <h1 class="big-title" style="font-size: 28px;"  data-role="title"> {{!empty($bigStoryInfo->title)?$bigStoryInfo->title:$newsContent->Title ?? ''}}</h1>
                <x-layout::box-ads nameAds="adm-slot-484644"></x-layout::box-ads>
                <div class="big-desc"><p><br></p></div>
            </div>
            <div id="start-post-bigs"></div>
            <div class="go-to-first">
                <a href="javascript:;" rel="nofollow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="13" height="16" viewBox="0 0 10 12" fill="none">
                        <path d="M9.78405 4.52166L5.45371 0.191317C5.3302 0.0678049 5.16541 0 4.9862 0C4.81049 0 4.6458 0.0678049 4.52229 0.191317L0.191854 4.52166C-0.0639512 4.77756 -0.0639512 5.19405 0.191854 5.44976L0.585024 5.84312C0.708537 5.96654 0.873317 6.03444 1.04912 6.03444C1.22483 6.03444 1.39527 5.96654 1.51868 5.84312L4.05059 3.31668V11.3431C4.05059 11.7049 4.3339 12 4.69566 12H5.25176C5.61351 12 5.92551 11.7049 5.92551 11.3431V3.28819L8.47176 5.84312C8.59517 5.96654 8.75556 6.03444 8.93137 6.03444C9.10717 6.03444 9.26951 5.96654 9.39312 5.84312L9.78512 5.44976C10.041 5.19395 10.04 4.77756 9.78405 4.52166Z"
                              fill="white"></path>
                    </svg>
                </a>
            </div>
            <div class="go-to-first-unread sticky" style="display: none;">
                <a href="javascript:;" rel="nofollow">
                    <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12" viewBox="0 0 10 12" fill="none">
                        <path
                            d="M9.78405 4.52166L5.45371 0.191317C5.3302 0.0678049 5.16541 0 4.9862 0C4.81049 0 4.6458 0.0678049 4.52229 0.191317L0.191854 4.52166C-0.0639512 4.77756 -0.0639512 5.19405 0.191854 5.44976L0.585024 5.84312C0.708537 5.96654 0.873317 6.03444 1.04912 6.03444C1.22483 6.03444 1.39527 5.96654 1.51868 5.84312L4.05059 3.31668V11.3431C4.05059 11.7049 4.3339 12 4.69566 12H5.25176C5.61351 12 5.92551 11.7049 5.92551 11.3431V3.28819L8.47176 5.84312C8.59517 5.96654 8.75556 6.03444 8.93137 6.03444C9.10717 6.03444 9.26951 5.96654 9.39312 5.84312L9.78512 5.44976C10.041 5.19395 10.04 4.77756 9.78405 4.52166Z"
                            fill="white"></path>
                    </svg>
                    <span>0</span>&nbsp;mới
                </a>
            </div>
            <div class="post-content news-bigstory">
                <ul class="lst-labels">
                    <li class="active"><a class="lball" href="javascript:;" title="tất cả">Tất cả</a></li>
                    @if(!empty($bigStoryInfo->labels))
                        @foreach($bigStoryInfo->labels as $key => $item)
                            <li ><a class="lbitem lb{{$key}}" href="javascript:;" title="{{!empty($item->name)?$item->name:""}}"
                                    data-code="{{!empty($item->code)?$item->code:""}}">{{!empty($item->name)?$item->name:""}}</a></li>
                        @endforeach
                    @endif
                </ul>
                <div class="block-dien-bien">
                    <div class="l">
                        <span class="sp2"></span>
                        &nbsp;diễn biến
                    </div>
                    <div class="sel-option">
                        <span>Mới nhất</span>
                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7"
                             fill="none">
                            <path
                                d="M11.8801 0.721401L11.2789 0.120283C11.1988 0.0400099 11.1066 0 11.0022 0C10.8982 0 10.8059 0.0400099 10.7258 0.120283L6.00006 4.8458L1.27451 0.120409C1.19436 0.0401364 1.10213 0.000126278 0.997933 0.000126278C0.893696 0.000126278 0.801463 0.0401364 0.721359 0.120409L0.120283 0.721569C0.04001 0.801673 0 0.893907 0 0.998143C0 1.1023 0.0401363 1.19453 0.120283 1.27463L5.72349 6.87797C5.80359 6.95811 5.89587 6.99816 6.00006 6.99816C6.10426 6.99816 6.19637 6.95811 6.27643 6.87797L11.8801 1.27463C11.9602 1.19449 12 1.10225 12 0.998143C12 0.893907 11.9602 0.801674 11.8801 0.721401Z"
                                fill="#4D4D4D"></path>
                        </svg>
                        <ul>
                            <li class="oldest">
                                <a href="javascript:;">
                                    <span>Cũ nhất</span>
                                </a>
                            </li>
                            <li class="lastest">
                                <a href="javascript:;">
                                    <span>Mới nhất</span>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <ul class="kbwscw-list">
                    @if(!empty($bigStoryItems))
                        @foreach($bigStoryItems as $key => $item)
                            <li class="item-bigstory kbwscwl" id="BigstoryItem{{$item->Id }}"
                                data-id="{{$item->Id }}"
                                data-labels="{{$item->ListLabels }}"
                                data-date="{{str_replace(" ","T",date('Y-m-d H:i:s', strtotime($item->PublishedDate)))}}" data-sort="0">
                                <div class="timeago">
                                    <span class="time-ago" title="{{str_replace(" ","T",date('Y-m-d H:i:s', strtotime($item->PublishedDate)))}}">{{str_replace(" ","T",date('Y-m-d H:i:s', strtotime($item->PublishedDate)))}}</span>
                                </div>
                                <div class="item-bigstory-tit">
                                    <h3>
                                        {{$item->Title}}
                                    </h3>
                                </div>
                                <div class="item-bigstory-cont">
                                    {!!$item->Body!!}
                                </div>
                                <div class="kbwscwl-extention">
                                    <div class="box-exten">
                                        <div class="lst-exten">
                                            <a class="item sharefb sendsocial" rel="facebook"
                                               href="javascript:;" data-title="{{$item->Title ?? ''}}" data-href="{{config('siteInfo.site_path').str_replace('.chn','/bigid'.$item->Id.'.chn',$newsContent->Url)}}">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="6" height="14"
                                                     viewBox="0 0 6 14" fill="none">
                                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                                          d="M3.98974 14V6.99918H5.76477L6 4.58666H3.98974L3.99275 3.37917C3.99275 2.74995 4.04767 2.41279 4.87776 2.41279H5.98743V0H4.21215C2.07975 0 1.3292 1.17033 1.3292 3.13846V4.58693H0V6.99945H1.3292V14H3.98974Z"
                                                          fill="#333333"></path>
                                                </svg>
                                                Chia sẻ
                                            </a>
                                            <span class="item copylink"
                                                  data-link="{{config('siteInfo.site_path').str_replace('.chn','/bigid'.$item->Id.'.chn',$newsContent->Url)}}">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14" viewBox="0 0 14 14"
                                         fill="none">
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M7.45221 1.60456C8.11231 0.967009 8.99642 0.614228 9.91411 0.622203C10.8318 0.630177 11.7096 0.998268 12.3586 1.6472C13.0075 2.29613 13.3756 3.17397 13.3836 4.09166C13.3915 5.00935 13.0388 5.89345 12.4012 6.55356L12.3941 6.56079L10.6442 8.31072C10.2894 8.66567 9.86235 8.94015 9.39212 9.11556C8.92189 9.29097 8.41943 9.3632 7.91883 9.32735C7.41823 9.2915 6.93119 9.14841 6.49076 8.90777C6.05032 8.66714 5.66679 8.33461 5.36617 7.93272C5.1732 7.67474 5.2259 7.30917 5.48388 7.1162C5.74186 6.92323 6.10743 6.97593 6.3004 7.23391C6.50081 7.50184 6.7565 7.72353 7.05012 7.88395C7.34375 8.04437 7.66844 8.13976 8.00217 8.16366C8.3359 8.18757 8.67087 8.13941 8.98436 8.02247C9.29785 7.90553 9.58252 7.72254 9.81907 7.48591L11.5654 5.73962C11.9883 5.29992 12.2222 4.71199 12.2169 4.10179C12.2116 3.49 11.9662 2.90477 11.5336 2.47215C11.101 2.03954 10.5158 1.79414 9.90397 1.78883C9.29351 1.78352 8.70534 2.01767 8.26558 2.44096L7.2654 3.43533C7.03693 3.66247 6.66758 3.66139 6.44044 3.43292C6.2133 3.20445 6.21438 2.83511 6.44285 2.60797L7.44618 1.61047L7.45221 1.60456Z"
                                              fill="#333333"></path>
                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                              d="M4.60779 4.8844C5.07802 4.70899 5.58048 4.63676 6.08108 4.67261C6.58168 4.70846 7.06871 4.85155 7.50915 5.09218C7.94958 5.33281 8.33312 5.66535 8.63373 6.06724C8.8267 6.32522 8.774 6.69079 8.51603 6.88376C8.25805 7.07673 7.89248 7.02403 7.69951 6.76605C7.4991 6.49812 7.24341 6.27643 6.94978 6.11601C6.65616 5.95559 6.33147 5.8602 5.99774 5.8363C5.664 5.81239 5.32903 5.86055 5.01555 5.97749C4.70206 6.09443 4.41739 6.27742 4.18084 6.51405L2.43455 8.26034C2.01161 8.70004 1.77766 9.28797 1.78297 9.89816C1.78828 10.51 2.03368 11.0952 2.4663 11.5278C2.89891 11.9604 3.48414 12.2058 4.09594 12.2111C4.70613 12.2164 5.29405 11.9825 5.73375 11.5596L6.72748 10.5658C6.95528 10.338 7.32463 10.338 7.55243 10.5658C7.78024 10.7936 7.78024 11.163 7.55243 11.3908L6.55493 12.3883L6.5477 12.3954C5.88759 13.033 5.00349 13.3857 4.0858 13.3778C3.16811 13.3698 2.29027 13.0017 1.64134 12.3528C0.992409 11.7038 0.624318 10.826 0.616343 9.9083C0.608369 8.99061 0.961149 8.10651 1.5987 7.4464L1.60581 7.43917L3.35573 5.68924C3.35571 5.68927 3.35576 5.68922 3.35573 5.68924C3.71054 5.33433 4.13759 5.05979 4.60779 4.8844Z"
                                              fill="#333333"></path>
                                    </svg>
                                    Copy link<span class="boxcopy">Đã copy!</span>
                                </span>
                                        </div>
                                    </div>
                                </div>
                            </li>
                        @endforeach
                    @endif
                </ul>
            </div>
            <div id="end-post-content"></div>
        </div>

    </div>
    <div id="timelinetotaldetailMobile"></div>
    <script type="text/javascript">
        (runinit = window.runinit || []).push(function () {

            @if(!empty($bigIdInContent))
            $('html, body').animate({scrollTop: $('[data-id={{$bigIdInContent}}]').offset().top - 90}, 'slow');
            @endif

            var formatDetail = {
                imgMobile: function (ele) {
                    if (ele != null) {
                        var $img = $(ele).find("img");
                        $img.each(function () {
                            if ($(this).data("mobile-url") != null && $(this).attr("src") != $(this).data("mobile-url")) {
                                $(this).attr("src", $(this).data("mobile-url"));
                            }
                        });
                    }
                },
                relation: function (ele) {
                    var $rl = $(ele), $img, $a, rUri;
                    $rl.each(function () {
                        $img = $(this).find(".kbwscwlrl-thumb");
                        if ($img.length == 1) {
                            $img.parents(".kbwscwl-relatedbox, .kbwscwlrl-relatedbox").addClass("rlshowimg");
                        }

                        $a = $(this).find("a");
                        $a.each(function () {
                            if ($(this).attr("href").indexOf("soha.vn") != -1) {
                                $(this).addClass("open-popup-comment-link").attr("data-strsg", false);
                                rUri = getLocation($(this).attr("href"));
                                $(this).attr("href", rUri.pathname);

                                if ($(this).parent("h3").length > 0) {
                                    $(this).append('<i class="open-icon"></i>');
                                }
                            }
                        });
                    });

                    var $linkFooter = $(".link-content-footer a:not(.open-popup-comment-link)");
                    $linkFooter.each(function () {
                        if ($(this).attr("href").indexOf("soha.vn") != -1) {
                            $(this).addClass("open-popup-comment-link").attr("data-strsg", false);
                            rUri = getLocation($(this).attr("href"));
                            $(this).attr("href", rUri.pathname);
                        }
                    });
                }
            };
            formatDetail.imgMobile(".news-bigstory");
            $("#bigstory-focuslist a[data-position]").click(function () {
                var idScroll = $(this).attr("data-position");
                $('html, body').animate({
                    scrollTop: $(idScroll).offset().top
                }, 1000);
            });

            function copyStringToClipboard(string) {
                let textarea;
                let result;

                try {
                    textarea = document.createElement('textarea');
                    textarea.setAttribute('readonly', true);
                    textarea.setAttribute('contenteditable', true);
                    textarea.style.position = 'fixed';
                    textarea.value = string;

                    document.body.appendChild(textarea);

                    textarea.focus();
                    textarea.select();

                    const range = document.createRange();
                    range.selectNodeContents(textarea);

                    const sel = window.getSelection();
                    sel.removeAllRanges();
                    sel.addRange(range);

                    textarea.setSelectionRange(0, textarea.value.length);
                    result = document.execCommand('copy');
                } catch (err) {
                    console.error(err);
                    result = null;
                } finally {
                    document.body.removeChild(textarea);
                }

                if (!result) {
                    const isMac = navigator.platform.toUpperCase().indexOf('MAC') >= 0;
                    const copyHotkey = isMac ? '⌘C' : 'CTRL+C';
                    result = prompt(`Press ${copyHotkey}`, string);
                    if (!result) {
                        return false;
                    }
                }
                return true;
            }

            //bigs 29/02/2020
            function showHideLabels(lbCode) {
                $('.kbwscw-list .kbwscwl').each(function () {
                    if ($(this).data('labels') != null && $(this).data('labels') != '') {
                        var lbls = $(this).data('labels').split(',');
                        var flg = false;
                        for (i = 0; i < lbls.length; i++) {
                            if (lbls[i] == lbCode) {
                                flg = true;
                                break;
                            }
                        }
                        if (flg)
                            $(this).removeClass('notshow');
                        else
                            $(this).addClass('notshow');
                    } else
                        $(this).addClass('notshow');
                });
            }

            var pos = $('#start-post-bigs').offset().top;
            $('.go-to-first-unread').hide();
            console.log('pos: ' + pos);
            var lastScrollTop = 0;

            if (window.addEventListener)
                window.addEventListener('scroll', bigscroll, false);
            else if (window.attachEvent)
                window.attachEvent('onscroll', bigscroll);

            function bigscroll() {
                var st = $(window).scrollTop();
                if (st > lastScrollTop) {
                    // downscroll code
                    $('.go-to-first').removeClass('sticky');
                    if ($(window).scrollTop() > $('#start-post-bigs').offset().top - 45) {
                        $('.lst-labels').addClass('sticky');
                    }
                } else {
                    // upscroll code
                    $('.lst-labels').removeClass('sticky');
                    if ($('.go-to-first-unread').is(':hidden') && $(window).scrollTop() > $('#start-post-bigs').offset().top - 45) {
                        $('.go-to-first').addClass('sticky');
                    }
                }
                lastScrollTop = st;

                //console.log($(window).scrollTop() + '|' + $('.lst-labels').offset().top + '|' + $('#end-post-content').offset().top)
                if ($(window).scrollTop() > $('#start-post-bigs').offset().top - 45 && $(window).scrollTop() < $('#end-post-content').offset().top) {
                    //$('.go-to-first-unread').addClass('sticky');
                } else {
                    //$('.go-to-first-unread').removeClass('sticky');
                    $('.go-to-first').removeClass('sticky');
                    $('.lst-labels').removeClass('sticky');
                }
            }

            $('.go-to-first').click(function () {
                $('html, body').animate({scrollTop: $('#start-post-bigs').offset().top - 45}, 'slow');
            });

            $('body').click(function () {
                $('.box-exten').removeClass('showlist');
            });
            $('.showlst').click(function (e) {
                e.stopPropagation();
                $(this).closest('.box-exten').toggleClass('showlist');
            });
            $('.lst-exten .copylink').click(function () {
                copyStringToClipboard($(this).data('link'));
                $(this).children('.boxcopy').show().fadeOut(2000);
            });
            $('.lst-exten .item').click(function (e) {
                e.stopPropagation();
            });
            $('.kbwscw-list .kbwscwl').each(function (index) {
                $(this).attr('data-sort', index);
                var bdate = new Date($(this).data('date'));
                var nowdate = new Date();
                if (nowdate > bdate) {
                    var diffMinus = Math.round((nowdate - bdate) / (1000 * 60 * 60));
                    if (diffMinus < 5) {
                        $(this).find('.time-ago').addClass('redtime');
                    }
                }
            });

            var bsId = '{{!empty($bigStoryInfo->id)?$bigStoryInfo->id:0}}';
            if (bsId != null && bsId != "1") {
                if ($('.kbwscw-list .kbwscwl[data-id=' + bsId + ']').length) {
                    var thisIndex = parseInt($('.kbwscw-list .kbwscwl[data-id=' + bsId + ']').data('sort'));
                    if (thisIndex > 0) {
                        //for (var i = 0; i < thisIndex; i++) {
                        //    $('.kbwscw-list .kbwscwl[data-sort=' + i + ']').addClass('hide');
                        //}
                        $('.go-to-first-unread span').html(thisIndex);
                        $('.go-to-first-unread').show().addClass('animated zoomIn');
                    }
                    //$('html, body').animate({ scrollTop: $('#start-post-bigs').offset().top - 45 }, 'slow');
                    var itemss = "loaditem" + bsId;
                    if (typeof (Storage) !== "undefined") {
                        if (sessionStorage.getItem(itemss) == null) {
                            $('html, body').animate({scrollTop: $('#start-post-bigs').offset().top - 45}, 'slow');
                        }
                        sessionStorage.setItem(itemss, "1");
                    }
                } else {
                    $('.error-box').addClass('showerr');
                }
            } else {
                if ($('.lst-labels a.lb0').length) {
                    $('.lst-labels a.lb0').closest('li').addClass('active');
                    showHideLabels($('.lst-labels a.lb0').data('code'))

                }
            }
            $('.error-box .btnhide').click(function () {
                $('.error-box').removeClass('showerr');
            });
            $('.lst-labels a').click(function () {
                if ($(this).hasClass('lbitem')) {
                    var lbid = $(this).data('code');
                    showHideLabels(lbid);
                } else {
                    $('.kbwscw-list .kbwscwl').removeClass('notshow');
                    $('.kbwscw-list .kbwscwl').removeClass('hide');
                    $('.go-to-first-unread').fadeOut(1000);
                    $('#adm-slot-7299, .adsbigs').addClass('show');
                }
                $('.block-dien-bien .sp2').html($('.kbwscw-list .kbwscwl:visible').length);
                $('.lst-labels li').removeClass('active');
                $(this).closest('li').addClass('active');
                $('html, body').animate({scrollTop: $('#start-post-bigs').offset().top - 45}, 'slow');
            });
            $('.sel-option').click(function () {
                $(this).toggleClass('open');
            });
            $('.sel-option li').click(function (e) {
                e.stopPropagation();
                $('.sel-option>span').html($(this).text());
                if ($(this).text().indexOf('Cũ nhất') != -1)
                    $('.kbwscw-list').addClass('older');
                else
                    $('.kbwscw-list').removeClass('older');
                $('.sel-option').removeClass('open');
            });

            $('.go-to-first-unread >a').click(function () {
                $('.sel-option .lastest').click();
                $('.lst-labels a.lball').click();
            });


            $('.block-dien-bien .sp2').html($('.kbwscw-list .kbwscwl:visible').length);





        });
    </script>


    <style>
        .seriesindetail {
            display: inline-block;
            margin: 20px 0;
            width: 100%;
            padding: 0 10px;
            box-sizing: border-box;
        }

        .seriesindetail .qleft {
            width: 100%;
            padding: 0 20px 40px;
            border: solid 1px #e1e4ed;
            border-radius: 3px;
            box-sizing: border-box;
            position: relative;
            float: left;
            background-color: #fbfcff;
        }

        .seriesindetail .titlebox {
            display: inline-block;
            border-bottom: solid 1px #c90000;
            margin-bottom: 24px;
        }

        .seriesindetail .titlebox p {
            font: normal 15px/21px 'lato-regular';
            color: #979ba7;
            text-transform: uppercase;
            margin: 0;
            padding: 20px 4px 6px 0;
        }

        .seriesindetail .titlebox p span {
            color: #222;
            font-weight: bold;
        }

        .seriesindetail .lstnews {
            padding-left: 20px;
            border-left: solid 1px #d2d2d2;
        }

        .seriesindetail .lstnews ul li {
            position: relative;
            top: -2px;
            margin-bottom: 15px;
            line-height: 18px;
        }

        .seriesindetail .lstnews ul li:last-child {
            margin-bottom: 0;
        }

        .seriesindetail .lstnews ul li:before {
            content: '';
            width: 6px;
            height: 6px;
            background-color: #d2d2d2;
            border-radius: 50%;
            border: solid 4px #fbfcff;
            left: -28px;
            display: inline-block;
            position: absolute;
            top: 1px;
        }

        .seriesindetail .lstnews ul li a {
            color: #2a4a84;
            font: normal 13px/18px Arial;
        }

        .seriesindetail .qleft .viewall {
            font: normal 11px Arial;
            color: #959595;
            position: absolute;
            bottom: 10px;
            right: 20px;
        }

        .seriesindetail .qright {
            width: 175px;
            height: 260px;
            float: right;
            background-color: #f4f4f4;
        }

        .seriesindetail .qright img {
            width: 175px;
            height: 260px;
        }

        .seriesindetail .qleft .viewall span {
            letter-spacing: -1px;
        }
    </style>






    <script type="text/javascript">
        var ajaxDomain = 'https://cafebizs.cnnd.vn';
        var quizNamespace = 'admin.cafebiz.vn';

        function InitQuizz() {
            (function () {
                if (typeof (quizNamespace) != "undefined") {
                    if (typeof (IMSQuizEmbed) != "undefined") {
                        IMSQuizEmbed.init({
                            nameSpace: quizNamespace,
                            userName: '',
                            getTokenFunction: function (callback) {
                                $.ajax({
                                    type: 'POST',
                                    url: ajaxDomain + '/handlers/gettokenquizz.ashx',
                                    dataType: "json",
                                    success: function (res) {
                                        var data = res;
                                        if (typeof (data) == 'string') data = JSON.parse(data);
                                        callback(data.message.token);
                                    }
                                });
                            }
                        });
                    } else {
                        var ims3 = document.createElement("script");
                        ims3.type = "text/javascript";
                        ims3.async = true;
                        ims3.id = "quizid";
                        ims3.onload =
                            ims3.onreadystatechange = function () {
                                IMSQuizEmbed.init({
                                    nameSpace: quizNamespace,
                                    userName: '',
                                    getTokenFunction: function (callback) {
                                        $.ajax({
                                            type: 'POST',
                                            url: ajaxDomain + '/handlers/gettokenquizz.ashx',
                                            dataType: "json",
                                            success: function (res) {
                                                var data = res;
                                                if (typeof (data) == 'string') data = JSON.parse(data);
                                                callback(data.message.token);
                                            }
                                        });
                                    }
                                });
                            };
                        ims3.src = "https://ims.mediacdn.vn/micro/widget/dist/plugins/quiz-embed.js";
                        var s = document.getElementsByTagName("script")[0];
                        s.parentNode.insertBefore(ims3, s);
                    }
                }
            })();
        }

        window.readCookie = function (name) {
            var nameEQ = name + "=";
            var ca = document.cookie.split(';');
            for (var i = 0; i < ca.length; i++) {
                var c = ca[i];
                while (c.charAt(0) == ' ') c = c.substring(1, c.length);
                if (c.indexOf(nameEQ) == 0) return c.substring(nameEQ.length, c.length);
            }
            return null;
        }

        InitQuizz();
        //var div = document.querySelector("#admbackground");

        //if (div != null) {
        //    div.innerHTML = '<div class="clearfix adv-box" id="adm-slot-8895"></div>';
        //    'undefined' == typeof admicroMAD.show ? admicroMAD.unit.push(function () { admicroMAD.show('adm-slot-8895') }) : admicroMAD.show('adm-slot-8895');
        //}
        //var div2 = document.querySelector("#admbackground2");
        //if (div2 != null) {
        //    div2.innerHTML = '<div class="clearfix adv-box" id="adm-slot-498716"></div>';
        //    'undefined' == typeof admicroMAD.show ? admicroMAD.unit.push(function () { admicroMAD.show('adm-slot-498716') }) : admicroMAD.show('adm-slot-498716');
        //}
        function ProcessVideov2(container, VideoToken) {
            if (container == null || container == '')
                container = '.detail';
            var secureToken = VideoToken;
            var iw = $(container).width(), ih = iw * 9 / 16;
            $(container).find('.VCSortableInPreviewMode[type=VideoStream]').each(function () {
                var $this = $(this);
                if ($this.attr("embed-type") == "4") {
                    var fileName = $this.attr('data-vid'),
                        location = $this.attr('data-location'),
                        contentId = $this.attr('data-contentId'),
                        info = $this.attr('data-info'),
                        namespace = $this.attr('data-namespace'),
                        midroll = "0.8;20s",
                        avatar = $this.attr('data-thumb');
                    var iw = $("body").width(), ih = iw * 9 / 16;


                    //check dạng cũ đổi namespace
                    if (fileName != null && fileName != "" && fileName.startsWith('cafebiz/')) {
                        fileName = fileName.replace('cafebiz/', 'cafebiz.mediacdn.vn/');
                    }

                    $this.prepend('<video id="player_' + info + '" playsinline="" webkit-playsinline="" height="' + ih + '" width="' + iw + '"></video>');

                    var params = { vid: fileName, location: location, _info: info, shareUrl: window.location.href, midroll: midroll, nopre: true };
                    //check video thuộc pr thì chuyển sang param file
                    if ((fileName + "").startsWith('pr/')) {
                        params.vid = "";
                        params.file = "https://channel.mediacdn.vn/" + fileName.replace('pr/', '');
                    }
                    playerInitScript('player_' + info, { params: params, secure: secureToken }, function () { var player = this; });

                } else {
                    var src = $(this).attr('data-src'), videoId = $(this).attr('videoid');
                    src = src.replace('&amp;', '&');
                    var fileName = GetValueByName("vid", src);
                    var keyvideo = GetValueByName("_info", src);

                    //check dạng cũ đổi namespace
                    if (fileName != null && fileName != "" && fileName.startsWith('cafebiz/')) {
                        fileName = fileName.replace('cafebiz/', 'cafebiz.mediacdn.vn/');
                    }
                    var params = { vid: fileName, _info: keyvideo };
                    //check video thuộc pr thì chuyển sang param file
                    if (fileName.startsWith('pr/')) {
                        params.vid = "";
                        params.file = "https://channel.mediacdn.vn/" + fileName.replace('pr/', '');
                    }
                    InitVideo($(this), videoId, function () {
                        playerInitScript('player-init' + videoId, {
                            params: params,
                            secure: secureToken
                        });
                    });
                }
            });
        }

    </script>

    <script type="text/javascript">
        (runinit = window.runinit || []).push(function () {
            var $timeago = $(".time-ago");
            $timeago.timeago();
        });
    </script>
@endsection
