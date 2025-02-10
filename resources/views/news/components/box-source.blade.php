@if(!empty($newsContent->Source) && !empty($newsContent->SourceUrl) && empty($newsContent->SourceId) )
    <style>
        .t-contentdetail .author {
            text-align: right;
            font-weight: bold;
            font-size: 17px;
            font-family: "Time New Roman";
            margin-bottom: 0 !important;
            color: #333;
        }

        .t-contentdetail .source {
            font-style: italic;
            text-align: right;
            width: 100%;
            font-size: 16px;
            color: #333;
            margin: 0;
            margin-top: 8px;
        }

        .bottom-info {
            display: block;
            height: 50px;
        }

        .link-source-wrapper {
            width: auto;
            display: block;
            box-sizing: border-box;
            float: right;
            position: relative;
            padding-top: 15px;
            text-align: left;
            margin-bottom: 10px;
        }

        .link-source-wrapper .link-source-name {
            font: normal 12px/14px Arial;
        }

        .link-source-name {
            color: #888;
            box-sizing: border-box;
            background: #F2F2F2;
            border-radius: 100px;
            padding: 9px 11px;
            display: block;
        }

        .link-source-wrapper .link-source-name * {
            font-family: arial;
            font-size: 12px;
            line-height: normal;
        }

        .link-source-name span {
            color: #444;
            font-weight: bold;
            font-size: 12px;
        }

        .link-source-name span.btn-copy-link-source {
            margin-left: 10px;
            opacity: .8;
            border: none !important;
        }

        span.btn-copy-link-source {
            float: right;
            cursor: pointer;
        }

        span.btn-copy-link-source svg {
            position: relative;
            top: 1px;
        }

        .link-source-wrapper .link-source-name span.btn-copy-link-source i {
            color: #444 !important;
        }

        .link-source-wrapper span.btn-copy-link-source i {
            font: normal 10px/11px Arial;
            color: #fff;
        }

        .link-source-wrapper.active .link-source-detail {
            display: block;
        }

        .link-source-wrapper .link-source-detail, .link-source-wrapper .link-source-detail * {
            font-family: arial;
            line-height: normal;
        }

        .link-source-detail {
            bottom: 45px;
        }

        .link-source-detail {
            display: none;
            background: rgba(0, 0, 0, 0.9);
            border-radius: 6px;
            width: 300px;
            max-width: 300px;
            position: absolute;
            right: 0;
            bottom: 45px;
            padding: 10px 12px;
            z-index: 9999;
        }

        span.link-source-detail-title {
            color: rgba(255, 255, 255, 0.8);
            font: normal 10px/11px Arial;
        }

        .btn-copy-link-source.btncopy {
            border: 1px solid #fff;
            border-radius: 4px;
            padding: 1px 5px;
            line-height: 12px;
            pointer-events: none;
            opacity: .5;
            z-index: 9;
            position: relative;
        }

        .link-source-full {
            padding: 5px;
            border: 1px solid #fff;
            border-radius: 4px;
        }

        .link-source-full {
            font: normal 12px/14px Arial;
            color: #fff;
            display: block;
            margin-top: 5px;
            word-break: break-word;
        }

        .link-source-detail .arrow-down {
            width: 0;
            height: 0;
            border-left: 10px solid transparent;
            border-right: 10px solid transparent;
            border-top: 10px solid rgba(0, 0, 0, 0.9);
            position: absolute;
            bottom: -10px;
            right: 16px;
        }

        .link-source-detail.copy .btn-copy-link-source.btncopy {
            pointer-events: unset;
            opacity: 1;
        }

        .link-source-full.active {
            background: #aaa;
        }

        .bottom-info a:hover {
            color: #888;
        }

        @media (max-width: 767px) {
            .link-source-wrapper {
                width: 100%;
            }

            .link-source-wrapper .t-icon {
                position: relative;
                top: 3px;
            }
        }

    </style>
    <script>
        (runinit = window.runinit || []).push(function () {
            $('.bottom-info').on('click', '.link-source-name .btn-copy-link-source', function (e) {
                e.stopPropagation();
                $(this).closest('.link-source-wrapper').toggleClass('active');
            });
            $('.bottom-info .btncopy').on('click', function (e) {
                e.stopPropagation();
                copyStringToClipboard($('.link-source-full').text());
                $(this).children('i').text('Link đã copy!');
                setTimeout(function () {
                    $('.btn-copy-link-source').find('i').text('Lấy link');
                    $('.bottom-info  .btn-copy-link-source').addClass('disable');
                    $('.bottom-info .link-source-full').removeClass('active');
                    $('.bottom-info .link-source-wrapper').removeClass('active');
                    $('.link-source-detail').removeClass('copy');
                }, 3000);
            });
            $('.bottom-info').on('click', '.link-source-full', function (e) {
                e.stopPropagation();
                $('.bottom-info .link-source-full').addClass('active');
                $(this).closest('.link-source-detail').toggleClass('copy');
            });
        });
    </script>
    <div class="t-contentdetail content_source">
        <p class="author">{{!empty($newsContent->Author)?$newsContent->Author:'PV'}}</p>
        <p class="source" data-field="source"> {{!empty($newsContent->Source)?$newsContent->Source:''}}</p>
    </div>
    <div class="bottom-info clearfix">
        <div class="link-source-wrapper is-web clearfix" id="urlSourceCafef">
            <a class="link-source-name" title="{{!empty($newsContent->Source)?$newsContent->Source:''}}"
               href="javascript:;" rel="nofollow">
                Theo <span class="link-source-text-name">{{!empty($newsContent->Source)?$newsContent->Source:''}}</span>
                @if(env('SITE_MOBILE') == true)
                    <span class="t-icon">
                        <svg width="14" height="14" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">                        <path
                                fill-rule="evenodd" clip-rule="evenodd"
                                d="M2.91675 4.08334C2.76204 4.08334 2.61367 4.1448 2.50427 4.25419C2.39487 4.36359 2.33341 4.51196 2.33341 4.66667V11.0833C2.33341 11.238 2.39487 11.3864 2.50427 11.4958C2.61367 11.6052 2.76204 11.6667 2.91675 11.6667H9.33342C9.48812 11.6667 9.6365 11.6052 9.74589 11.4958C9.85529 11.3864 9.91675 11.238 9.91675 11.0833V7.58334C9.91675 7.26117 10.1779 7.00001 10.5001 7.00001C10.8222 7.00001 11.0834 7.26117 11.0834 7.58334V11.0833C11.0834 11.5475 10.899 11.9926 10.5709 12.3208C10.2427 12.649 9.79754 12.8333 9.33342 12.8333H2.91675C2.45262 12.8333 2.0075 12.649 1.67931 12.3208C1.35112 11.9926 1.16675 11.5475 1.16675 11.0833V4.66667C1.16675 4.20254 1.35112 3.75742 1.67931 3.42923C2.0075 3.10105 2.45262 2.91667 2.91675 2.91667H6.41675C6.73891 2.91667 7.00008 3.17784 7.00008 3.50001C7.00008 3.82217 6.73891 4.08334 6.41675 4.08334H2.91675Z"
                                fill="#888888"></path>                        <path fill-rule="evenodd"
                                                                                    clip-rule="evenodd"
                                                                                    d="M8.16675 1.75001C8.16675 1.42784 8.42792 1.16667 8.75008 1.16667H12.2501C12.5722 1.16667 12.8334 1.42784 12.8334 1.75001V5.25001C12.8334 5.57217 12.5722 5.83334 12.2501 5.83334C11.9279 5.83334 11.6667 5.57217 11.6667 5.25001V2.33334H8.75008C8.42792 2.33334 8.16675 2.07217 8.16675 1.75001Z"
                                                                                    fill="#888888"></path>                        <path
                                fill-rule="evenodd" clip-rule="evenodd"
                                d="M12.6626 1.33753C12.8904 1.56533 12.8904 1.93468 12.6626 2.16248L8.24589 6.57915C8.01809 6.80696 7.64874 6.80696 7.42094 6.57915C7.19313 6.35135 7.19313 5.982 7.42094 5.75419L11.8376 1.33753C12.0654 1.10972 12.4348 1.10972 12.6626 1.33753Z"
                                fill="#888888"></path></svg>
                    </span>
                @endif

                <span class="btn-copy-link-source">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd"
                     d="M2.5 2.08333C2.38949 2.08333 2.28351 2.12723 2.20537 2.20537C2.12723 2.28351 2.08333 2.38949 2.08333 2.5V8.33333C2.08333 8.44384 2.12723 8.54982 2.20537 8.62796C2.28351 8.7061 2.38949 8.75 2.5 8.75H7.5C7.61051 8.75 7.71649 8.7061 7.79463 8.62796C7.87277 8.54982 7.91667 8.44384 7.91667 8.33333V2.5C7.91667 2.38949 7.87277 2.28351 7.79463 2.20537C7.71649 2.12723 7.61051 2.08333 7.5 2.08333H6.66667C6.43655 2.08333 6.25 1.89679 6.25 1.66667C6.25 1.43655 6.43655 1.25 6.66667 1.25H7.5C7.83152 1.25 8.14946 1.3817 8.38388 1.61612C8.6183 1.85054 8.75 2.16848 8.75 2.5V8.33333C8.75 8.66485 8.6183 8.9828 8.38388 9.21722C8.14946 9.45164 7.83152 9.58333 7.5 9.58333H2.5C2.16848 9.58333 1.85054 9.45164 1.61612 9.21722C1.3817 8.9828 1.25 8.66485 1.25 8.33333V2.5C1.25 2.16848 1.3817 1.85054 1.61612 1.61612C1.85054 1.3817 2.16848 1.25 2.5 1.25H3.33333C3.56345 1.25 3.75 1.43655 3.75 1.66667C3.75 1.89679 3.56345 2.08333 3.33333 2.08333H2.5Z"
                     fill="black"></path>
               <path fill-rule="evenodd" clip-rule="evenodd"
                     d="M2.91666 1.25C2.91666 0.789762 3.28976 0.416667 3.75 0.416667H6.25C6.71023 0.416667 7.08333 0.789762 7.08333 1.25V2.08333C7.08333 2.54357 6.71023 2.91667 6.25 2.91667H3.75C3.28976 2.91667 2.91666 2.54357 2.91666 2.08333V1.25ZM6.25 1.25H3.75V2.08333H6.25V1.25Z"
                     fill="black"></path>
            </svg>
            <i>Copy link</i>
         </span>
            </a>
            <div class="link-source-detail">
                <span class="link-source-detail-title">Link bài gốc</span>
                <span class="btn-copy-link-source btncopy" style="cursor: pointer">
            <svg width="10" height="10" viewBox="0 0 10 10" fill="none" xmlns="http://www.w3.org/2000/svg">
               <path fill-rule="evenodd" clip-rule="evenodd"
                     d="M2.5 2.08333C2.38949 2.08333 2.28351 2.12723 2.20537 2.20537C2.12723 2.28351 2.08333 2.38949 2.08333 2.5V8.33333C2.08333 8.44384 2.12723 8.54982 2.20537 8.62796C2.28351 8.7061 2.38949 8.75 2.5 8.75H7.5C7.61051 8.75 7.71649 8.7061 7.79463 8.62796C7.87277 8.54982 7.91667 8.44384 7.91667 8.33333V2.5C7.91667 2.38949 7.87277 2.28351 7.79463 2.20537C7.71649 2.12723 7.61051 2.08333 7.5 2.08333H6.66667C6.43655 2.08333 6.25 1.89679 6.25 1.66667C6.25 1.43655 6.43655 1.25 6.66667 1.25H7.5C7.83152 1.25 8.14946 1.3817 8.38388 1.61612C8.6183 1.85054 8.75 2.16848 8.75 2.5V8.33333C8.75 8.66485 8.6183 8.9828 8.38388 9.21722C8.14946 9.45164 7.83152 9.58333 7.5 9.58333H2.5C2.16848 9.58333 1.85054 9.45164 1.61612 9.21722C1.3817 8.9828 1.25 8.66485 1.25 8.33333V2.5C1.25 2.16848 1.3817 1.85054 1.61612 1.61612C1.85054 1.3817 2.16848 1.25 2.5 1.25H3.33333C3.56345 1.25 3.75 1.43655 3.75 1.66667C3.75 1.89679 3.56345 2.08333 3.33333 2.08333H2.5Z"
                     fill="white"></path>
               <path fill-rule="evenodd" clip-rule="evenodd"
                     d="M2.91666 1.25C2.91666 0.789762 3.28976 0.416667 3.75 0.416667H6.25C6.71023 0.416667 7.08333 0.789762 7.08333 1.25V2.08333C7.08333 2.54357 6.71023 2.91667 6.25 2.91667H3.75C3.28976 2.91667 2.91666 2.54357 2.91666 2.08333V1.25ZM6.25 1.25H3.75V2.08333H6.25V1.25Z"
                     fill="white"></path>
            </svg>
            <i>Lấy link!</i>
            </span>
                <span class="link-source-full">
                {{!empty($newsContent->SourceUrl)?$newsContent->SourceUrl:''}}
            </span>
                <div class="arrow-down"></div>
            </div>
        </div>
    </div>
    <script>
        (runinit = window.runinit || []).push(function () {
            $(document).ready(function () {
                var sourceUrl = "{{!empty($newsContent->SourceUrl)?$newsContent->SourceUrl:''}}";
                var ogId = {{!empty($newsContent->OriginalId)?$newsContent->OriginalId:0}};
                if (sourceUrl == '') {
                    if (ogId > 0)
                        getOrgUrl($('#hdNewsId').val(), 174, '#urlSourceCafef', '{{$newsContent->DistributionDate}}', ogId, "{{htmlentities($newsContent->Title)}}");
                } else
                    $('#urlSourceCafef').show();
                $('#urlSourceCafef .link-source-full').mouseup(function () {
                    if ($(this).hasClass('active')) {
                        $('#urlSourceCafef .btn-copy-link-source').addClass('disable');
                        $(this).removeClass('active');
                    } else {
                        $('#urlSourceCafef .btn-copy-link-source').removeClass('disable');
                        $(this).addClass('active');
                    }
                });

                function getOrgUrl(newsId, channelId, elem, pubDate, originalId, title) {
                    var sDate = new Date('11/15/2019').getTime();
                    var pDate = new Date(pubDate).getTime();
                    if (pDate < sDate) {
                        $(elem).hide();
                        return false;
                    }

                    $(elem).show();
                    var DOMAIN_ORG_URL = '{{(env('APP_ENV')=='local')?'https://sudo.cnnd.vn':'https://sudo.cnnd.vn'}}';
                    $.ajax({
                        type: "GET",
                        contentType: "application/json",
                        dataType: "json",
                        url: DOMAIN_ORG_URL + '/Handlers/RequestHandler.ashx?c=getOrgUrl&newsId=' + newsId + '&channelId=' + channelId,
                        success: function (rs) {
                            try {
                                if (rs != null && JSON.stringify(rs) != '{}') {
                                    var orgUrl = rs.Domain + rs.Url;
                                    //$(elem).find('.link-source-name').attr('href', orgUrl);
                                    $(elem).find('.btn-copy-link-source').attr('data-link', orgUrl);
                                    //$(elem).find('.link-source-full').attr('href', orgUrl);
                                    $(elem).find('.link-source-full').html(orgUrl);
                                } else {
                                    var orgUrlSearch = getSearchOrgUrl(originalId, title);
                                    $(elem).find('.btn-copy-link-source').attr('data-link', orgUrlSearch);
                                    $(elem).find('.link-source-full').html(orgUrlSearch);
                                }
                            } catch (e) {
                                console.log(e);
                            }
                        },
                        error: function (e) {
                            console.log(e);
                        }
                    });
                }
            });
        });
    </script>
@else
    <style>
        .t-contentdetail .author {
            text-align: right;
            font-weight: bold;
            font-size: 17px;
            font-family: "Time New Roman";
            margin-bottom: 0 !important;
            color: #333;
        }

        .t-contentdetail .source {
            font-family: "Times New Roman";
            font-style: italic;
            text-align: right;
            width: 100%;
            font-size: 16px;
            color: #333;
            margin: 0;
        }

        .content_source p {
            line-height: 26px;
        }

        .bottom-info {
            display: block;
            height: 50px;
        }
    </style>
    <div class="t-contentdetail content_source">
        @if(!empty($newsContent->Author))
            <p class="author">{{$newsContent->Author}}</p>
        @endif
        @if(!empty($newsContent->Source))
            <p class="source" data-field="source">{{$newsContent->Source}}</p>
        @endif
    </div>
@endif
