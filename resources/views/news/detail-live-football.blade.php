@extends('layout.master')
@section('title'){{$newsContent->Title}}@endsection
@section('description'){{(!empty($newsContent->Sapo))?strip_tags($newsContent->Sapo):''}}@endsection
@section('keywords'){{(!empty($newsContent->MetaKeyword))?$newsContent->MetaKeyword:$newsContent->TagItem}}@endsection
@section('news_keywords'){{(!empty($newsContent->MetaNewsKeyword))?$newsContent->MetaNewsKeyword:$newsContent->TagItem}}@endsection
@section('og-title'){{$newsContent->Title}}@endsection
@section('og-description'){{(!empty($newsContent->Sapo))?strip_tags($newsContent->Sapo):''}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').$newsContent->Url}}@endsection
@section('OgImage'){{(!empty($newsContent->OgImage))?UserInterfaceHelper::formatThumbZoom($newsContent->OgImage,600,315):config('siteInfo.default_share')}}@endsection
@section('published_time'){{!empty($newsContent->DistributionDate)?$newsContent->DistributionDate:''}}@endsection
@section('article_author'){{!empty($newsContent->Author)?$newsContent->Author:''}}@endsection
@section('pageDetail')@endsection
@section('css')
    @if (!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @include('expert.Css-detail')

    <style>
        .entry-content-iframe:has(iframe):before {
            padding-bottom: 56.25% !important;
            content: "";
            display: block;
        }
        .entry-content-iframe{
            width: 100%;
            position: relative;
            margin-bottom: 24px;
        }
        .entry-content-iframe iframe{
            width:100%;
        }
        .entry-content-iframe iframe{
            max-width: 100% !important;
            max-height: 100%;
            position: absolute;
            top: 0;
            left: 0;
            height: 100%;
            width: 100%;
        }
    </style>
@endsection
@section('js')
    @include('expert.Js-detail')

    <script type="text/javascript">
        var Widgetkey = 'be16ece1aae06870a4871101f455276c8fb3bf7527270b206555d3d45add032e';
        var customTeams = [];
        var customPlayers = [];
        var apiFootball = pageSettings.DomainUtils2 ;


        // var apiFootball = "{{ !empty($newsContent->MatchIDv2) ? 'https://apiv2.apifootball.com' : 'https://apiv3.apifootball.com' }}";
        var apikey = '0b30677a59ed56b50b20069d6101898398026ccaba18c98f5ee1dd97e05c8ac5';
    </script>
    <script type="text/javascript">
        (runinit = window.runinit || []).push(function () {
            $(document).ready(function () {
                @if(!empty($LiveMatchId))
                    liveSport.init({
                        matchId: '{{ $LiveMatchId }}',
                        updateTimeInterval: 30000, //120000,//30000
                        requestUrl: pageSettings.DomainUtils2,
                        displayLiveMatchTimelineCallback: function () {
                            $('#pnlTimeline .VCSortableInPreviewMode[type="LayoutAlbum"]').addClass(
                                'LastestLayoutAlbum');
                            videoHD.isAd = true;
                            videoHD.init("#pnlTimeline", {
                                type: videoHD.videoType.newsDetail
                            });
                        }
                    });
                @endif
            });
        });

    </script>

@endsection
@section('content')
    <div data-check-position="body_start"></div>
    <div class="detail__live-football" data-io-article-url="{{$newsContent->Url}}">
        <div class="w-672">
            <div class="detail__cmain">
                <div class="detail-top">
                    @include('news.components.box-breadcrumb')
                </div>
                @if(!empty($newsContent->titleTop))


                    <div class="detail-title-top">{{$newsContent->titleTop ?? ''}}</div>
                @endif
                <h1 class="detail-title">
                    @if ($newsContent->NewsType == 5 || $newsContent->NewsType == 7)
                        <span class="icon-live">Live <span class="ic"><i></i></span></span>
                    @endif

                    <span data-role="title"> {{$newsContent->Title ?? ''}}</span>
                    @if(!empty($newsContent->titleBottom))
                        <div class="detail-title-bottom">{{$newsContent->titleBottom ?? ''}}</div>
                    @endif
                </h1>

                <div class="social-top">
                    <div class="detail-fb-like-share">
                        <div class="fb-like" data-href="{{ config('siteInfo.site_path') . Request::getPathInfo() }}" data-width=""
                             data-layout="button_count" data-action="like" data-size="small" data-share="true"></div>
                    </div>
                    <div class="detail-social">
                        <div class="box">
                            <a href="javascript:;" class="item sendsocial" rel="facebook"
                               data-href="{{ config('siteInfo.site_path') . Request::getPathInfo() }}"
                               data-title="{{ $newsContent->Title ?? '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M3 12.0541C3.00105 16.5089 6.22045 20.3019 10.5931 21V14.6712H8.30981V12.0541H10.5958V10.062C10.4935 9.118 10.814 8.17719 11.4702 7.49472C12.1263 6.81225 13.0503 6.45885 13.9914 6.53037C14.6668 6.54136 15.3405 6.60188 16.0073 6.71149V8.93821H14.8697C14.4781 8.8866 14.0843 9.01675 13.7994 9.29198C13.5145 9.56722 13.3692 9.95775 13.4046 10.3535V12.0541H15.8984L15.4997 14.6721H13.4046V21C18.1334 20.248 21.4494 15.9025 20.9504 11.1116C20.4512 6.32062 16.3116 2.76144 11.5307 3.0125C6.74959 3.26356 3.00076 7.23697 3 12.0541Z"
                                        fill="#8B8B8B"/>
                                </svg>
                            </a>


                            <div class="zalo-share-button item" data-href="{{ config('siteInfo.site_path') . Request::getPathInfo() }}"
                                 data-oaid="3853758560685742933" data-layout="2" data-color="blue" data-customize=true">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2832_14399)">
                                        <path
                                            d="M19.9997 11.674C19.9997 11.7623 19.9997 11.8574 19.9997 11.9457C19.9797 12.0204 19.9463 12.0951 19.9397 12.1698C19.793 14.275 18.913 16.0272 17.333 17.365C14.9197 19.4092 12.1797 19.8438 9.21299 18.8795C8.97299 18.8048 8.77966 18.798 8.55299 18.9202C7.95966 19.2462 7.34633 19.545 6.73966 19.8506C6.63966 19.9049 6.52633 19.9389 6.38633 20C6.38633 19.8506 6.37966 19.7623 6.38633 19.674C6.43299 19.0221 6.46633 18.3633 6.52633 17.7114C6.55299 17.4261 6.46633 17.2224 6.25966 17.0255C5.37299 16.1834 4.73299 15.1715 4.37966 13.9966C4.19966 13.399 4.11299 12.7674 3.98633 12.1494C3.98633 11.7895 3.98633 11.4228 3.98633 11.0628C4.03966 10.7708 4.07966 10.472 4.15299 10.18C4.92633 7.06961 6.88633 5.1545 9.87299 4.27844C10.3063 4.14941 10.7597 4.08829 11.1997 4C11.713 4 12.2197 4 12.733 4C12.793 4.02037 12.853 4.05433 12.9197 4.06112C13.8463 4.14941 14.7263 4.39389 15.5597 4.81494C17.813 5.94228 19.2797 7.71477 19.813 10.2411C19.9063 10.7097 19.9397 11.1986 19.9997 11.674ZM8.53299 10.1664C8.36633 10.3973 8.26633 10.5399 8.15966 10.6825C7.57966 11.4499 6.97966 12.2105 6.41966 12.9983C6.09966 13.4465 6.33966 13.9015 6.87966 13.9151C7.75299 13.9355 8.63299 13.9219 9.51299 13.9219C9.79299 13.9219 9.97966 13.7861 9.99966 13.4805C10.0197 13.1885 9.86633 12.9983 9.54633 12.9779C9.09299 12.9508 8.63966 12.9643 8.17966 12.9643C8.03299 12.9643 7.88633 12.9643 7.65966 12.9643C7.99299 12.5229 8.27299 12.163 8.53966 11.7895C8.97299 11.1986 9.39966 10.6146 9.80633 10.0034C10.033 9.66384 9.88633 9.36503 9.49966 9.26995C9.41299 9.24958 9.32633 9.23599 9.23966 9.23599C8.49299 9.2292 7.75299 9.2292 7.00633 9.23599C6.88633 9.23599 6.73966 9.23599 6.65299 9.30391C6.52633 9.40577 6.37299 9.56876 6.37299 9.71138C6.37299 9.8472 6.53299 10.0102 6.65966 10.1121C6.73966 10.18 6.89299 10.1664 7.01299 10.1664C7.48633 10.1664 7.95966 10.1664 8.53299 10.1664ZM12.2597 13.6367C12.313 13.6842 12.3597 13.7453 12.4263 13.7861C12.7263 13.9966 13.1397 13.8472 13.153 13.4805C13.1797 12.6723 13.1797 11.8574 13.153 11.0424C13.1397 10.6757 12.773 10.5263 12.4597 10.7165C12.3863 10.764 12.3197 10.8251 12.253 10.8727C11.5063 10.4312 10.833 10.5059 10.3663 11.0832C9.81966 11.7555 9.81299 12.7742 10.3463 13.4329C10.8063 14.0034 11.493 14.0849 12.2597 13.6367ZM16.253 13.9287C17.1663 14.0102 17.873 13.1749 17.8797 12.3328C17.8863 11.3345 17.2463 10.5942 16.3263 10.5806C15.353 10.5603 14.6797 11.2326 14.653 12.2037C14.6263 13.1681 15.3263 13.983 16.253 13.9287ZM13.4597 11.5382C13.453 11.5382 13.453 11.5382 13.4597 11.5382C13.4597 12.129 13.4597 12.7131 13.4597 13.3039C13.4597 13.6978 13.5997 13.8676 13.913 13.8676C14.233 13.8676 14.3863 13.6978 14.393 13.3175C14.3997 12.7878 14.393 12.2513 14.393 11.7216C14.393 11.0628 14.3997 10.4109 14.3863 9.75212C14.3797 9.39898 14.193 9.22241 13.9063 9.2292C13.6197 9.23599 13.4663 9.41935 13.4663 9.7725C13.453 10.3633 13.4597 10.9474 13.4597 11.5382Z"
                                            fill="#8B8B8B"/>
                                        <path
                                            d="M12.1997 12.2581C12.1997 12.7606 11.953 13.0662 11.5464 13.0662C11.1597 13.0662 10.8997 12.7335 10.9064 12.2377C10.913 11.7487 11.153 11.4567 11.553 11.4567C11.973 11.4635 12.1997 11.7419 12.1997 12.2581Z"
                                            fill="#8B8B8B"/>
                                        <path
                                            d="M16.9322 12.2649C16.9322 12.7402 16.6589 13.0594 16.2656 13.0594C15.8789 13.0594 15.6122 12.7335 15.6056 12.2581C15.5989 11.8031 15.8922 11.4567 16.2789 11.4567C16.6656 11.4567 16.9322 11.7827 16.9322 12.2649Z"
                                            fill="#8B8B8B"/>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2832_14399">
                                            <rect width="16" height="16" fill="white" transform="translate(4 4)"/>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </div>

                            <a href="javascript:;" class="item sendsocial" rel="twitter"
                               data-href="{{ config('siteInfo.site_path') . Request::getPathInfo() }}"
                               data-title="{{ $newsContent->Title ?? '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" clip-rule="evenodd"
                                          d="M19.7711 8.08878C19.7779 8.26367 19.7802 8.43849 19.7802 8.61337C19.7802 13.9156 16.0503 20.0366 9.22975 20.0366C7.13458 20.0366 5.18638 19.3689 3.54492 18.2321C3.83508 18.2639 4.12976 18.2878 4.42896 18.2878C6.16614 18.2878 7.76615 17.6438 9.03531 16.5627C7.41269 16.5388 6.04255 15.3703 5.57 13.7804C5.79685 13.8281 6.03047 13.852 6.26938 13.852C6.60627 13.852 6.93335 13.8044 7.24687 13.709C5.54888 13.3433 4.26994 11.7217 4.26994 9.77414C4.26994 9.75029 4.26994 9.74229 4.26994 9.72639C4.77037 10.0205 5.34314 10.2033 5.95134 10.2271C4.95501 9.50372 4.30007 8.2716 4.30007 6.88047C4.30007 6.14913 4.48246 5.45751 4.80351 4.86131C6.63188 7.29381 9.36542 8.89164 12.4471 9.05858C12.3838 8.76445 12.3514 8.45451 12.3514 8.14448C12.3514 5.92662 14.0117 4.13004 16.0601 4.13004C17.1265 4.13004 18.0897 4.61501 18.7657 5.39405C19.6121 5.21916 20.405 4.88531 21.1224 4.42425C20.8443 5.36227 20.2572 6.14909 19.49 6.64195C20.2407 6.54656 20.9566 6.33209 21.6206 6.01412C21.1224 6.817 20.4954 7.52438 19.7711 8.08878Z"
                                          fill="#8B8B8B"/>
                                </svg>

                            </a>
                            <a href="javascript:;" class="item sendmail"
                               data-href="{{ config('siteInfo.site_path') . Request::getPathInfo() }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M20 4H4C2.9 4 2.01 4.9 2.01 6L2 18C2 19.1 2.9 20 4 20H20C21.1 20 22 19.1 22 18V6C22 4.9 21.1 4 20 4ZM19.6 8.25L12.53 12.67C12.21 12.87 11.79 12.87 11.47 12.67L4.4 8.25C4.15 8.09 4 7.82 4 7.53C4 6.86 4.73 6.46 5.3 6.81L12 11L18.7 6.81C19.27 6.46 20 6.86 20 7.53C20 7.82 19.85 8.09 19.6 8.25Z"
                                        fill="#8B8B8B"/>
                                </svg>
                            </a>
                        </div>
                        <div class="box">
                            <a class="item clipboard" href="javascript:;" title="Copy link"
                               data-href="{{ config('siteInfo.site_path') . Request::getPathInfo() }}" rel="nofollow">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M11.8891 16.0579C11.2292 16.7658 10.5985 17.6095 9.80285 18.2592C8.35704 19.4422 6.18348 19.1901 4.94145 17.8034C3.6703 16.378 3.68001 14.2543 5.00937 12.8773C6.32903 11.5197 7.6584 10.1815 9.01687 8.87238C10.3851 7.54387 12.578 7.54387 13.9365 8.83359C14.3926 9.26026 14.4508 9.74512 14.1112 10.1621C13.7521 10.5985 13.2573 10.6082 12.743 10.2009C11.8697 9.4736 10.9284 9.51239 10.1231 10.3172C8.90043 11.5391 7.67781 12.7609 6.45518 13.9828C5.6498 14.7973 5.61098 15.9125 6.35814 16.6592C7.10531 17.4058 8.2406 17.3768 9.02658 16.5428C9.51175 16.0289 9.9387 15.6216 10.7344 15.9707C11.0934 16.1355 11.5689 16.0386 11.8891 16.0579Z"
                                        fill="#8B8B8B"></path>
                                    <path
                                        d="M11.1804 6.96127C11.8305 6.25338 12.4613 5.36124 13.2861 4.71153C14.7416 3.55758 16.886 3.85819 18.0989 5.24488C19.341 6.66066 19.3216 8.77463 18.0116 10.1322C16.6822 11.4995 15.3432 12.8474 13.9653 14.1759C12.6165 15.4753 10.4235 15.4656 9.08448 14.1953C8.60901 13.7493 8.55079 13.245 8.92922 12.8377C9.29795 12.4304 9.76372 12.4304 10.2586 12.8183C11.1804 13.5553 12.0925 13.5068 12.9367 12.6632C14.1497 11.451 15.3626 10.2486 16.5658 9.03645C17.3712 8.22189 17.4197 7.11642 16.6725 6.36005C15.9351 5.61337 14.7804 5.62306 14.0041 6.45702C13.4995 7.00975 13.0338 7.34915 12.2478 7.01945C11.8888 6.89339 11.4424 6.97097 11.1804 6.96127Z"
                                        fill="#8B8B8B"></path>
                                </svg>
                            </a>
                            <a href="javacript:;" title="Bình luận" class="item scoll-comment">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M4 6.12591V20.9333L6.47493 18.0365H18.2904C19.5341 18.0365 19.8747 16.6743 19.8895 15.9932V5.82124C19.8895 4.43537 18.8234 4.02963 18.2904 4H5.9419C4.41389 4 4.01063 5.41727 4 6.12591Z"
                                        fill="#8B8B8B"></path>
                                    <rect x="6.25293" y="6.57617" width="11.1935" height="1.37694" rx="0.688469"
                                          fill="#292929"></rect>
                                    <rect x="6.25293" y="9.92383" width="11.1935" height="1.37694" rx="0.688469"
                                          fill="#292929"></rect>
                                    <rect x="6.25293" y="13.2734" width="11.1935" height="1.37694" rx="0.688469"
                                          fill="#292929"></rect>
                                </svg>
                            </a>

                            <a href="javascript:;" title="In" class="item sendprint"
                               data-href="{{ !empty($newsContent->Url) ? '/print' . $newsContent->Url : '' }}">
                                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                     xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_2991_17222)">
                                        <path
                                            d="M17.8628 16.9854C17.8628 16.0717 17.8628 15.172 17.8628 14.2513C18.0035 14.2302 18.1442 14.2232 18.2778 14.1951C18.5381 14.1388 18.6858 13.9701 18.6858 13.7031C18.6929 13.4219 18.5381 13.2392 18.2567 13.19C18.1301 13.1689 18.0035 13.1689 17.8699 13.1689C13.9449 13.1689 10.0199 13.1689 6.09496 13.1689C5.97538 13.1689 5.86284 13.1619 5.74326 13.1759C5.4408 13.2111 5.26495 13.4008 5.26495 13.689C5.26495 13.9772 5.43377 14.1669 5.73623 14.2091C5.84174 14.2232 5.94021 14.2302 6.07386 14.2372C6.07386 15.158 6.07386 16.0646 6.07386 17.0065C5.41266 17.0908 4.78664 16.9783 4.21688 16.6058C3.43611 16.0928 3.02111 15.3548 3.00704 14.427C2.98594 13.0002 2.98594 11.5664 3.00704 10.1396C3.02814 8.74094 4.08324 7.65855 5.47597 7.55312C5.58148 7.54609 5.68699 7.53906 5.7925 7.53906C9.92849 7.53906 14.0645 7.53906 18.2005 7.53906C19.5369 7.53906 20.5569 8.27706 20.8804 9.48596C20.9437 9.7179 20.9789 9.97093 20.9789 10.2099C20.9859 11.5945 20.993 12.9721 20.9789 14.3567C20.9789 16.0365 19.5369 17.2595 17.8628 16.9854ZM6.63658 10.8354C6.89684 10.8354 7.15006 10.8354 7.41032 10.8354C7.43142 10.8354 7.45956 10.8354 7.48066 10.8354C7.79016 10.8073 7.98007 10.6527 8.00118 10.3294C8.01524 10.0272 7.81829 9.80927 7.48066 9.79521C6.91794 9.78116 6.36225 9.78116 5.79953 9.79521C5.483 9.80224 5.30012 9.99201 5.27198 10.2942C5.24385 10.5754 5.483 10.8143 5.79953 10.8284C6.08089 10.8495 6.36225 10.8354 6.63658 10.8354Z"
                                            fill="#8B8B8B"></path>
                                        <path
                                            d="M7.15723 14.2305C10.3858 14.2305 13.5722 14.2305 16.7727 14.2305C16.7797 14.35 16.7938 14.4484 16.7938 14.5538C16.7938 16.2968 16.7938 18.0469 16.7938 19.79C16.7938 20.5983 16.3929 20.9989 15.584 20.9989C13.1783 20.9989 10.7797 20.9989 8.37411 20.9989C7.57223 20.9989 7.15723 20.5842 7.15723 19.79C7.15723 18.0469 7.15723 16.2968 7.15723 14.5538C7.15723 14.4624 7.15723 14.371 7.15723 14.2305ZM11.9685 15.4113C11.5394 15.4113 11.1033 15.4042 10.6742 15.4113C10.2944 15.4183 10.0552 15.6291 10.0552 15.9314C10.0552 16.2336 10.2944 16.4515 10.6742 16.4585C11.5535 16.4655 12.4257 16.4655 13.3049 16.4585C13.7059 16.4585 13.9169 16.2617 13.9169 15.9384C13.9169 15.6151 13.7059 15.4183 13.312 15.4113C12.8548 15.4042 12.4116 15.4113 11.9685 15.4113ZM11.9825 18.7147C12.4116 18.7147 12.8477 18.7217 13.2768 18.7147C13.6918 18.7076 13.9169 18.5108 13.9099 18.1805C13.9028 17.8572 13.6918 17.6744 13.2909 17.6674C12.4257 17.6604 11.5605 17.6604 10.6953 17.6674C10.2944 17.6674 10.0412 17.8853 10.0552 18.2016C10.0623 18.5038 10.3014 18.7076 10.6883 18.7147C11.1174 18.7147 11.5464 18.7076 11.9825 18.7147Z"
                                            fill="#8B8B8B"></path>
                                        <path
                                            d="M6.07422 6.45716C6.11642 5.94408 6.09532 5.46614 6.1938 5.01631C6.43999 3.85661 7.50915 3.01319 8.71197 3.00616C10.8925 2.99913 13.073 2.99211 15.2466 3.00616C16.6745 3.01319 17.814 4.14478 17.8491 5.56454C17.8562 5.85271 17.8491 6.1479 17.8491 6.46419C13.9312 6.45716 10.0414 6.45716 6.07422 6.45716Z"
                                            fill="#8B8B8B"></path>
                                    </g>
                                    <defs>
                                        <clipPath id="clip0_2991_17222">
                                            <rect width="18" height="18" fill="white"
                                                  transform="translate(3 3)"></rect>
                                        </clipPath>
                                    </defs>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>

                <h2 class="detail-sapo" data-role="sapo">
                    {!! $newsContent->Sapo ?? '' !!}
                </h2>
                @if(!empty($newsContent->jframeAvartar))
                    <div class="entry-content-iframe">
                        {!! $newsContent->jframeAvartar??'' !!}
                    </div>
                @endif
            </div>
            <div class="detail__lf-main hidden">
                <div class="box-lf ">
                    <section id="widgetMatchResults"></section>
                    @include('news.components.box-fooball-body')
                </div>
            </div>
        </div>
    </div>
    <div class="detail__section">
        <div class="detail__cmain">
            <div class="w-672">
                <div class="detail-content afcbc-body" data-role="content" itemprop="articleBody"
                        data-io-article-url="{{config('siteInfo.site_path').$newsContent->Url??''}}">


                    {!! $newsContent->Body !!}
                </div>
                @include('news.components.box-comment')
            </div>
        </div>
    </div>
    <div data-check-position="body_end"></div>



    <div class="configHidden">
        {!! $ZoneInfoClientScript !!}
        <div class="hidden" id="detailBody" >

            @if (!empty($newsContent->MatchID))
                {!! $newsContent->Body ?? '' !!}
            @endif
        </div>
    </div>
@endsection
