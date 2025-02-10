@extends('layout.master-magazine')
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

@section('css')
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-bigstory')
    <style>
        .topwrapper{
            display: none;
        }
        .admsectionfull{
            width: 100%!important;
        }
        .VCSortableInPreviewMode[type="VideoStream"] .AfPlayer,
        .VCSortableInPreviewMode[type="VideoStream"] .BetaAfPlayer,
        .VCSortableInPreviewMode[type="VideoStream"] .videoNewsPlayer {
            padding-top: 56.26% !important;
            height: 0 !important;
        }
        .iframe iframe{
            width: 100% !important;
            max-height: 450px!important;
        }
        .fb_iframe_widget{
            height: 20px!important;
        }
    </style>
@endsection
@section('js')
    @include('expert.Js-bigstory')
    <script src="https://statics.lotuscdn.vn/web/v1/embed/w.embedlink.js" async></script>
    <script src="https://apigames.kenh14.vn/Static/js/embed-template-product.js" async></script>
    <script src="https://event.mediacdn.vn/257766952064241664/2021/7/20/embed-special-box-html-config-1626773084303819043504.js" async></script>
    <script async type="text/javascript" src="https://ims.mediacdn.vn/micro/quiz/sdk/dist/play.js"></script>
    <script type="text/javascript">
        var newsBigsId = '{{!empty($bigStoryInfo->id)?$bigStoryInfo->id:0}}';
        var indexItem = '{{!empty($bigStoryItems)?count($bigStoryItems):0}}';
        var ch = new Date().getHours();
        if (ch < 10) ch = '0' + ch;
        var cm = new Date().getMinutes();
        if (cm < 10) cm = '0' + cm;
        var cs = new Date().getSeconds();
        if (cs < 10) cs = '0' + cs;
        var currentTime = parseFloat(ch + '' + cm + '' + cs + '');
        (runinit = window.runinit || []).push(function () {

            @if(!empty($bigIdInContent))
            $('html, body').animate({scrollTop: $('[data-id={{$bigIdInContent}}]').offset().top - 200}, 'slow');
            @endif
            // social.init();

            // videoHD.isAd = true;
            // videoHD.init(".detail-content", {
            //     type: videoHD.videoType.newsDetail
            // });
            // videoInContent.init('.detail-content');



            big_Stor.fixLinkDetailFooter();
            ProcessDetail();

            //bigs 30/03/2020
            function dragscroll(select) {
                const slider = document.querySelector(select);
                let isDown = false;
                let startX;
                let scrollLeft;

                slider.addEventListener('mousedown', (e) => {
                    e.preventDefault();
                    isDown = true;
                    slider.classList.add('drag');
                    startX = e.pageX - slider.offsetLeft;
                    scrollLeft = slider.scrollLeft;
                });
                slider.addEventListener('mouseleave', (e) => {
                    e.preventDefault();
                    isDown = false;
                    slider.classList.remove('drag');
                });
                slider.addEventListener('mouseup', (e) => {
                    e.preventDefault();
                    isDown = false;
                    slider.classList.remove('drag');
                });
                slider.addEventListener('mousemove', (e) => {
                    if (!isDown) return;
                    e.preventDefault();
                    const x = e.pageX - slider.offsetLeft;
                    const walk = (x - startX) * 1; //scroll-fast
                    slider.scrollLeft = scrollLeft - walk;
                    //console.log(walk);
                });
            }

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

            var pos = $('.kbwscw-list').offset().top - 93;
            var lastScrollTop = 0;
            $(window).scroll(function () {
                var st = $(this).scrollTop();
                if (st > lastScrollTop) {
                    // downscroll code
                    $('.go-to-first').hide();
                    if ($(window).scrollTop() > $('.kbwscw-list').offset().top - 93) {
                        $('.lst-labels').addClass('sticky');
                    }
                } else {
                    // upscroll code
                    $('.lst-labels').removeClass('sticky');
                    if ($('.go-to-first-unread').is(':hidden')) {
                        $('.go-to-first').show();
                    }
                }
                lastScrollTop = st;
                if ($(window).scrollTop() > $('.kbwscw-list').offset().top - 93) {
                    $('.block-dien-bien').addClass('sticky');
                } else {
                    $('.block-dien-bien').removeClass('sticky');
                    $('.go-to-first').hide();
                }
            });

            $('.closelst').click(function () {
                $('.box-exten').removeClass('showlist');
            });
            $('.showlst').click(function () {
                $(this).closest('.box-exten').addClass('showlist');
            });
            $('.lst-exten .copylink').click(function () {
                copyStringToClipboard($(this).data('link'));
                $(this).children('.boxcopy').show().fadeOut(2000);
            });

            $('.kbwscw-list .kbwscwl').each(function (index) {
                $(this).attr('data-sort', index);
                var bdate = new Date($(this).data('date'));
                var nowdate = new Date();
                if (nowdate > bdate) {
                    var diffMinus = Math.round((nowdate - bdate) / (1000 * 60 * 60));
                    if (diffMinus < 5) {
                        $(this).find('.timeago').addClass('redtime');
                    }
                }
            });
            var bsId = '{{!empty($bigStoryInfo->id)?$bigStoryInfo->id:0}}';
            if (bsId != null && bsId != "") {
                if ($('.kbwscw-list .kbwscwl[data-id=' + bsId + ']').length) {
                    var $this = $('.kbwscw-list .kbwscwl[data-id=' + bsId + ']');
                    var thisIndex = parseInt($this.data('sort'));
                    if (thisIndex > 0) {
                        //for (var i = 0; i < thisIndex; i++) {
                        //    $('.kbwscw-list .kbwscwl[data-sort=' + i + ']').addClass('hide');
                        //}
                        $('.go-to-first-unread span').html(thisIndex);
                        $('.go-to-first-unread').show();
                    }
                    var itemss = "loaditem" + bsId;
                    if (typeof (Storage) !== "undefined") {
                        if (sessionStorage.getItem(itemss) == null) {
                            $('html, body').animate({scrollTop: $('.kbwscw-list').offset().top - 93}, 'slow');
                        }
                        sessionStorage.setItem(itemss, "1");
                    }
                } else
                    $('.error-box').addClass('showerr');
            } else {
                if ($('.lst-labels a.lb0').length) {
                    $('.lst-labels a.lb0').closest('li').addClass('active');
                    showHideLabels($('.lst-labels a.lb0').data('code'));
                }
            }
            dragscroll('.lst-labels');
            $('.block-dien-bien .c .sp2').html($('.kbwscw-list .kbwscwl:visible').length);
            $('.lst-labels a').click(function () {
                if ($(this).hasClass('lbitem')) {
                    var lbid = $(this).data('code');
                    console.log(lbid);
                    showHideLabels(lbid);
                } else {
                    $('.kbwscw-list .kbwscwl').removeClass('notshow');
                    $('.kbwscw-list .kbwscwl').removeClass('hide');
                    $('.go-to-first-unread').fadeOut(1000);
                    //$('.top-content').addClass('show');
                }

                $('.block-dien-bien .c .sp2').html($('.kbwscw-list .kbwscwl:visible').length);
                $('.lst-labels li').removeClass('active');
                $(this).closest('li').addClass('active');
                $('html, body').animate({scrollTop: $('.kbwscw-list').offset().top - 93}, 'slow');
            });
            $('.sel-option').unbind('click').click(function (e) {
                $(this).toggleClass('open');
            });
            $('.sel-option li').click(function (e) {
                e.stopPropagation();
                e.preventDefault();
                $('.sel-option>span').html($(this).text());
                if ($(this).text().indexOf('Cũ nhất') != -1)
                    $('.kbwscw-list').addClass('older');
                else
                    $('.kbwscw-list').removeClass('older');
                $('.sel-option').removeClass('open');
            });

            $('.go-to-first').click(function () {
                $('html, body').animate({scrollTop: $('.kbwscw-list').offset().top - 93}, 'slow');
            });

            $('.go-to-first-unread >a').click(function () {
                $('.sel-option .lastest').click();
                $('.lst-labels a.lball').click();
            });

            $('.list-new.scroll li').click(function () {
                var nid = $(this).children('a').data('id');
                if ($('.kbwscwl[data-id=' + nid + ']').length) {
                    var offsetTo = $('.kbwscwl[data-id=' + nid + ']').offset().top;
                    $('html, body').animate({scrollTop: offsetTo}, 'slow');
                }
            });



            $('.list-new-article.scroll').slimScroll({
                height: '239px',
                alwaysVisible: false,
                allowPageScroll: true,
                color: '#555',
                size: '3px'
            });

            var heightScrollFocus = 210;
            if ($('.list-new-article.scroll').length == 0) {
                heightScrollFocus = 362;
            }

            $('.list-new-focus.scroll').slimScroll({
                height: heightScrollFocus + 'px',
                alwaysVisible: false,
                size: '3px',
                color: '#555',
                allowPageScroll: true
            });

            $('.big-date').html("Cập nhật lúc " + $('.kbwscw-list .kbwscwl').first().find('.timeago').data('date'));
            $('.block-dien-bien .c .sp2').html($('.kbwscw-list .kbwscwl:visible').length);
            $('.timeago').timeago();

            $('.kbwscwl-content a').each(function () {
                var link = $(this).attr('href');
                var target = $(this).attr('target');
                if (target != '_blank' && link != '' && (link.indexOf('https://soha.vn') == 0 || link.indexOf('/') == 0) && /[0-9]+\.htm/g.test(link)) {
                    $(this).addClass('show-popup-comment');
                }
            });

        });

    </script>
@endsection


@section('content')

    <input type="hidden" name="hidLastModifiedDate" id="hidLastModifiedDate"
           value="{{$newsContent->DistributionDate ?? 0}}"/>
    <div class="bigstories">
        <div class="clearfix mgt15">
            <div class="khungdetail container">
                <div class="bigstories-wrapper clearfix detail-content" data-role="content">
                    <div class="newscontent adm-leftsection">
                        <div class="top-content">
                            <div class="top-focus">
                                <div class="big-date" data-role="publishdate">Cập nhật lúc </div>
                                <div class="description">
                                    <h1 class="big-desc" data-role="title">
                                        {{!empty($bigStoryInfo->title)?$bigStoryInfo->title:$newsContent->Title ?? ''}}
                                    </h1>
                                    <div class="kbsw-title" >
                                        @if(!empty($bigStoryInfo->description))
                                            {!! $bigStoryInfo->description ?? '' !!}
                                        @else
                                            {{$newsContent->Sapo ?? ''}}
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>


                        <div data-check-position="body_start"></div>
                        <div class="kbws-content-wrapper news-content">
                            <div class="clearfix"></div>
                            <ul class="lst-labels">
                                <li style="" class="active"><a class="lball" href="javascript:;" title="tất cả">Tất cả</a>
                                </li>
                                @if(!empty($bigStoryInfo->labels))
                                    @foreach($bigStoryInfo->labels as $key=>$value)
                                        <li><a class="lbitem lb{{$key}} notshow " href="javascript:;"
                                               title="{{$value->name ??''}}"
                                               data-code="{{$value->code ??''}}">{{$value->name??''}}</a></li>
                                    @endforeach
                                @endif
                            </ul>
                            <div class="block block-dien-bien">
                                <div class="header" style="background-image: none">
                                    <div class="l">
                                        <div class="c">
                                            <span class="sp2"></span>
                                        </div>
                                        &nbsp;diễn biến
                                    </div>
                                    <div class="go-to-first">
                                        <a href="javascript:;" rel="nofollow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="13" height="16"
                                                 viewBox="0 0 10 12" fill="none">
                                                <path
                                                    d="M9.78405 4.52166L5.45371 0.191317C5.3302 0.0678049 5.16541 0 4.9862 0C4.81049 0 4.6458 0.0678049 4.52229 0.191317L0.191854 4.52166C-0.0639512 4.77756 -0.0639512 5.19405 0.191854 5.44976L0.585024 5.84312C0.708537 5.96654 0.873317 6.03444 1.04912 6.03444C1.22483 6.03444 1.39527 5.96654 1.51868 5.84312L4.05059 3.31668V11.3431C4.05059 11.7049 4.3339 12 4.69566 12H5.25176C5.61351 12 5.92551 11.7049 5.92551 11.3431V3.28819L8.47176 5.84312C8.59517 5.96654 8.75556 6.03444 8.93137 6.03444C9.10717 6.03444 9.26951 5.96654 9.39312 5.84312L9.78512 5.44976C10.041 5.19395 10.04 4.77756 9.78405 4.52166Z"
                                                    fill="white"/>
                                            </svg>
                                        </a>
                                    </div>
                                    <div class="go-to-first-unread">
                                        <a href="javascript:;" rel="nofollow">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="10" height="12"
                                                 viewBox="0 0 10 12" fill="none">
                                                <path
                                                    d="M9.78405 4.52166L5.45371 0.191317C5.3302 0.0678049 5.16541 0 4.9862 0C4.81049 0 4.6458 0.0678049 4.52229 0.191317L0.191854 4.52166C-0.0639512 4.77756 -0.0639512 5.19405 0.191854 5.44976L0.585024 5.84312C0.708537 5.96654 0.873317 6.03444 1.04912 6.03444C1.22483 6.03444 1.39527 5.96654 1.51868 5.84312L4.05059 3.31668V11.3431C4.05059 11.7049 4.3339 12 4.69566 12H5.25176C5.61351 12 5.92551 11.7049 5.92551 11.3431V3.28819L8.47176 5.84312C8.59517 5.96654 8.75556 6.03444 8.93137 6.03444C9.10717 6.03444 9.26951 5.96654 9.39312 5.84312L9.78512 5.44976C10.041 5.19395 10.04 4.77756 9.78405 4.52166Z"
                                                    fill="white"/>
                                            </svg>
                                            <span>0</span>&nbsp;mới
                                        </a>
                                    </div>
                                    <div class="r">
                                        <div class="sel-option">
                                            <span>Mới nhất</span>
                                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="7" viewBox="0 0 12 7"
                                                 fill="none">
                                                <path
                                                    d="M11.8801 0.721401L11.2789 0.120283C11.1988 0.0400099 11.1066 0 11.0022 0C10.8982 0 10.8059 0.0400099 10.7258 0.120283L6.00006 4.8458L1.27451 0.120409C1.19436 0.0401364 1.10213 0.000126278 0.997933 0.000126278C0.893696 0.000126278 0.801463 0.0401364 0.721359 0.120409L0.120283 0.721569C0.04001 0.801673 0 0.893907 0 0.998143C0 1.1023 0.0401363 1.19453 0.120283 1.27463L5.72349 6.87797C5.80359 6.95811 5.89587 6.99816 6.00006 6.99816C6.10426 6.99816 6.19637 6.95811 6.27643 6.87797L11.8801 1.27463C11.9602 1.19449 12 1.10225 12 0.998143C12 0.893907 11.9602 0.801674 11.8801 0.721401Z"
                                                    fill="#4D4D4D"/>
                                            </svg>
                                            <ul>
                                                <li class="oldest"><a href="javascript:;">
                                                        <span>Cũ nhất</span>
                                                    </a></li>
                                                <li class="lastest"><a href="javascript:;">
                                                        <span>Mới nhất</span>
                                                    </a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="clearfix">
                            </div>
                            <ul class="kbwscw-list list-news-2">
                                @if(!empty($bigStoryItems))
                                    @foreach($bigStoryItems as $key=>$item)
                                        <li class="kbwscwl clearfix cc" data-id="{{$item->Id ??''}}"
                                            data-date="{{date('Y-m-d H:i:s',strtotime($item->PublishedDate))}}"
                                            data-labels="{{$item->ListLabels ??''}}"
                                            id="BigStoryItem{{$item->Id??''}}">
                                            <div class="kbwscwl-header">
                                                <div class="timeago" title="{{date('Y-m-d H:i:s',strtotime($item->PublishedDate))}}"
                                                     data-date="{{date('Y-m-d H:i:s',strtotime($item->PublishedDate))}}"> {{$item->PublishedDate ?? ''}}</div>
                                                <h3 class="kbwscwl-title kbwc-title">{{$item->Title ?? ''}}</h3>
                                            </div>

                                            <div class="kbwscwl-content">
                                                {!! $item->Body ?? '' !!}
                                            </div>
                                            <div class="kbwscwl-extention">
                                                <div class="box-exten">
                                                    <div class="lst-exten">
                                                        <a href="javascript:;" class="item sendsocial" rel="facebook" data-title="{{$item->Title ?? ''}}" data-href="{{config('siteInfo.site_path').str_replace('.chn','/bigid'.$item->Id.'.chn',$newsContent->Url)}}" >
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="6"
                                                                 height="14"
                                                                 viewBox="0 0 6 14"
                                                                 fill="none">
                                                                <path fill-rule="evenodd" clip-rule="evenodd"
                                                                      d="M3.98974 14V6.99918H5.76477L6 4.58666H3.98974L3.99275 3.37917C3.99275 2.74995 4.04767 2.41279 4.87776 2.41279H5.98743V0H4.21215C2.07975 0 1.3292 1.17033 1.3292 3.13846V4.58693H0V6.99945H1.3292V14H3.98974Z"
                                                                      fill="#333333"/>
                                                            </svg>
                                                            Chia sẻ lên Facebook</a>
                                                        <span class="item copylink" data-link="{{config('siteInfo.site_path').str_replace('.chn','/bigid'.$item->Id.'.chn',$newsContent->Url)}}">
                                                    <svg xmlns="http://www.w3.org/2000/svg" width="14" height="14"
                                                         viewBox="0 0 14 14"
                                                         fill="none">
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M7.45221 1.60456C8.11231 0.967009 8.99642 0.614228 9.91411 0.622203C10.8318 0.630177 11.7096 0.998268 12.3586 1.6472C13.0075 2.29613 13.3756 3.17397 13.3836 4.09166C13.3915 5.00935 13.0388 5.89345 12.4012 6.55356L12.3941 6.56079L10.6442 8.31072C10.2894 8.66567 9.86235 8.94015 9.39212 9.11556C8.92189 9.29097 8.41943 9.3632 7.91883 9.32735C7.41823 9.2915 6.93119 9.14841 6.49076 8.90777C6.05032 8.66714 5.66679 8.33461 5.36617 7.93272C5.1732 7.67474 5.2259 7.30917 5.48388 7.1162C5.74186 6.92323 6.10743 6.97593 6.3004 7.23391C6.50081 7.50184 6.7565 7.72353 7.05012 7.88395C7.34375 8.04437 7.66844 8.13976 8.00217 8.16366C8.3359 8.18757 8.67087 8.13941 8.98436 8.02247C9.29785 7.90553 9.58252 7.72254 9.81907 7.48591L11.5654 5.73962C11.9883 5.29992 12.2222 4.71199 12.2169 4.10179C12.2116 3.49 11.9662 2.90477 11.5336 2.47215C11.101 2.03954 10.5158 1.79414 9.90397 1.78883C9.29351 1.78352 8.70534 2.01767 8.26558 2.44096L7.2654 3.43533C7.03693 3.66247 6.66758 3.66139 6.44044 3.43292C6.2133 3.20445 6.21438 2.83511 6.44285 2.60797L7.44618 1.61047L7.45221 1.60456Z"
                                                              fill="#333333"/>
                                                        <path fill-rule="evenodd" clip-rule="evenodd"
                                                              d="M4.60779 4.8844C5.07802 4.70899 5.58048 4.63676 6.08108 4.67261C6.58168 4.70846 7.06871 4.85155 7.50915 5.09218C7.94958 5.33281 8.33312 5.66535 8.63373 6.06724C8.8267 6.32522 8.774 6.69079 8.51603 6.88376C8.25805 7.07673 7.89248 7.02403 7.69951 6.76605C7.4991 6.49812 7.24341 6.27643 6.94978 6.11601C6.65616 5.95559 6.33147 5.8602 5.99774 5.8363C5.664 5.81239 5.32903 5.86055 5.01555 5.97749C4.70206 6.09443 4.41739 6.27742 4.18084 6.51405L2.43455 8.26034C2.01161 8.70004 1.77766 9.28797 1.78297 9.89816C1.78828 10.51 2.03368 11.0952 2.4663 11.5278C2.89891 11.9604 3.48414 12.2058 4.09594 12.2111C4.70613 12.2164 5.29405 11.9825 5.73375 11.5596L6.72748 10.5658C6.95528 10.338 7.32463 10.338 7.55243 10.5658C7.78024 10.7936 7.78024 11.163 7.55243 11.3908L6.55493 12.3883L6.5477 12.3954C5.88759 13.033 5.00349 13.3857 4.0858 13.3778C3.16811 13.3698 2.29027 13.0017 1.64134 12.3528C0.992409 11.7038 0.624318 10.826 0.616343 9.9083C0.608369 8.99061 0.961149 8.10651 1.5987 7.4464L1.60581 7.43917L3.35573 5.68924C3.35571 5.68927 3.35576 5.68922 3.35573 5.68924C3.71054 5.33433 4.13759 5.05979 4.60779 4.8844Z"
                                                              fill="#333333"/>
                                                    </svg>
                                                    Copy link dẫn<span class="boxcopy">Đã copy!</span></span>
                                                    </div>
                                                    <div class="showlst">
                                                        Chia sẻ
                                                        <svg xmlns="http://www.w3.org/2000/svg" width="13" height="12"
                                                             viewBox="0 0 13 12"
                                                             fill="none">
                                                            <path fill-rule="evenodd" clip-rule="evenodd"
                                                                  d="M5.93097 0.54126V3.64125C2.04698 3.82416 0 5.84249 0 9.55857V10.9904L1.01248 9.97795C2.34506 8.64537 3.96794 8.08705 5.93097 8.29637V11.4587L12.1695 5.99999L5.93097 0.54126ZM7.11716 4.81385V3.15541L10.3682 6.00004L7.11716 8.84467V7.2769L6.62157 7.1943C4.59639 6.85677 2.81391 7.19484 1.30556 8.20431C1.74936 5.91168 3.43958 4.81385 6.52407 4.81385H7.11716Z"
                                                                  fill="#555555"/>
                                                        </svg>
                                                    </div>
                                                </div>
                                            </div>

                                        </li>
                                    @endforeach
                                @else
                                    {{--                                    <li class="error-box">--}}
                                    {{--                                        <div class="err">Diễn biến đã gỡ hoặc không tồn tại!</div>--}}
                                    {{--                                        <div class="txt">Vui lòng xem tiếp các diễn biến mới nhất dưới đây hoặc quay về <a--}}
                                    {{--                                                href="{{$newsContent->DistributionDate ?? ''}}" title="{{$newsContent->Title ??''}}">link bài gốc</a></div>--}}
                                    {{--                                    </li>--}}
                                @endif
                            </ul>

                        </div>
                        <div data-check-position="body_end"></div>
                    </div>
                    <div class="contentright contentright2 adm-rightsection">

                        <div class="r-block">
                            <div class="block-header">
                                <div class="title">Nóng</div>
                            </div>
                            <div class="block-body">
                                <div class="list-new list-new-article scroll" style="height: 145px">
                                    <ul>
                                        @if(!empty($bigStoryIsHot))
                                            @foreach($bigStoryIsHot as $key=>$item)
                                                <li class="clearfix">
                                                    <a href="javascript:;"
                                                       title="{{$item->Title ?? ''}}"
                                                       data-id="{{$item->Id ?? ''}}"
                                                       data-date="{{strtotime($item->PublishedDate)}}">
                                                        <div class="news-meta">
                                                            <span class="time">{{date('H:i',strtotime($item->PublishedDate))}}</span><br>
                                                            <span class="date">{{date('m/d',strtotime($item->PublishedDate))}}</span>
                                                        </div>
                                                        <div class="news-title">
                                                            {{$item->Title ?? ''}}
                                                        </div>
                                                    </a>
                                                </li>
                                            @endforeach
                                        @endif
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="r-block block-highlight">
                            <div class="block-header">
                                <div class="title">Tâm điểm</div>
                            </div>
                            <div class="block-body">
                                <div class="list-new list-new-focus scroll">
                                    @if(!empty($bigStoryIsHighlight))
                                        @foreach($bigStoryIsHighlight as $key=>$item)
                                            <li class="clearfix">
                                                <a href="javascript:;"
                                                   title="{{$item->Title ?? ''}}"
                                                   data-id="{{$item->Id ?? ''}}"
                                                   data-date="{{strtotime($item->PublishedDate)}}">

                                                    <div class="news-title">
                                                        {{$item->Title}}
                                                    </div>
                                                </a>
                                                <div class="news-meta">
                                                    {{date('H:i',strtotime($item->PublishedDate))}} | {{date('m/d',strtotime($item->PublishedDate))}}
                                                </div>
                                            </li>
                                        @endforeach
                                    @endif
                                </div>

                            </div>
                        </div>



                    </div>
                </div>
            </div>
        </div>
    </div>




@endsection
