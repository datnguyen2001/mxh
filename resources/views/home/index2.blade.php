@if(!empty($boxVideo))
    <div class="container mb-20">
        <!-- Ads Tap chi Zone -->
        <zone id="m1a71wwa"></zone>
        <script src="//media1.admicro.vn/cms/arf-m1a71wwa.min.js"></script>
        <!-- / Ads Zone -->
    </div>
<div class="home__video">
    <div class="container">
        <div class="box-focus-video">
            <x-template::box-layout8 :listNews="$boxVideo" zoneInfo="'">
                <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid4</x-slot>
                <x-slot name="cdTop">10</x-slot>
            </x-template::box-layout8>
        </div>
    </div>
</div>
@endif

@if(!empty($dataByZone['cong-nghe']['data']))
<div class="home__focus-hm">
    <div class="container">
        @if(!empty($dataByZone['cong-nghe']['info']??''))
        <div class="box-category-top">
            <h2>
                <a class="box-category-title" href="{{$dataByZone['cong-nghe']['info']->ZoneUrl??''}}" title="{{$dataByZone['cong-nghe']['info']->ZoneUrl??''}}">
                    {{$dataByZone['cong-nghe']['info']->Name??''}}
                </a>
            </h2>
        </div>
        @endif

        <div class="box-flex-focus">
            <div class="box-left">
                <x-template::box-layout1 :listNews="array_slice($dataByZone['cong-nghe']['data']??'',0,3)" zoneInfo="'">
                    <x-slot name="cdKey">{{$dataByZone['cong-nghe']['cdTop']??''}}</x-slot>
                    <x-slot name="cdTop">3</x-slot>
                </x-template::box-layout1>
            </div>

            <div class="box-right">
                <x-template::box-layout2 :listNews="array_slice($dataByZone['cong-nghe']['data']??'',3,4)">
                    <x-slot name="cdKey">{{$dataByZone['cong-nghe']['cdTop']??''}}</x-slot>
                    <x-slot name="cdTop">4</x-slot>
                </x-template::box-layout2>
            </div>
        </div>
    </div>
</div>
@endif
<div class="home__images-new">
    <div class="container">
        <div class="box-images-new">
            <x-template::box-layout9 :listNews="$boxAnh" :zoneInfo="''">
                <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid3</x-slot>
                <x-slot name="cdTop">5</x-slot>
                <x-slot name="zoneName">Ảnh</x-slot>
                <x-slot name="zoneUrl">/anh.htm </x-slot>
            </x-template::box-layout9>
        </div>
    </div>
</div>

<div class="home__strim-news">
    <div class="container">
        <div class="box-flex-strim">
            <div class="col-left">
                <div class="strim-news-top">
                    <x-template::box-layout111 :listNews="$dataByZone['giao-duc']['data']??''" :zoneInfo="$dataByZone['giao-duc']['info']??''">
                        <x-slot name="cdKey">{{$dataByZone['giao-duc']['cdKey']??''}}</x-slot>
                        <x-slot name="cdTop">{{$dataByZone['giao-duc']['cdTop']??''}}</x-slot>
                    </x-template::box-layout111>
                </div>

                <div class="strim-news-top">
                    <div class="flex-strim-child">
                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['tai-chinh']['data']??''" :zoneInfo="$dataByZone['tai-chinh']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['tai-chinh']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['tai-chinh']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>

                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['ly-luan-tre']['data']??''" :zoneInfo="$dataByZone['ly-luan-tre']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['ly-luan-tre']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['ly-luan-tre']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>

                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['can-biet']['data']??''" :zoneInfo="$dataByZone['can-biet']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['can-biet']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['can-biet']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>
                    </div>
                </div>

                <div class="strim-news-top">
                    <div class="flex-strim-child">
                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['suc-khoe']['data']??''" :zoneInfo="$dataByZone['suc-khoe']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['suc-khoe']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['suc-khoe']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>

                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['doanh-nhan']['data']??''" :zoneInfo="$dataByZone['doanh-nhan']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['doanh-nhan']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['doanh-nhan']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>

                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['the-thao']['data']??''" :zoneInfo="$dataByZone['the-thao']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['the-thao']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['the-thao']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>
                    </div>
                </div>

                <div class="strim-news-top">
                    <div class="flex-strim-child">
                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['giai-tri']['data']??''" :zoneInfo="$dataByZone['giai-tri']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['giai-tri']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['giai-tri']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>

                        <div class="col-child">
                            <x-template::box-layout10 :listNews="$dataByZone['ban-doc']['data']??''" :zoneInfo="$dataByZone['ban-doc']['info']??''">
                                <x-slot name="cdKey">{{$dataByZone['ban-doc']['cdKey']??''}}</x-slot>
                                <x-slot name="cdTop">{{$dataByZone['ban-doc']['cdTop']??''}}</x-slot>
                            </x-template::box-layout10>
                        </div>
                    </div>
                </div>

                <div class="strim-info">
                    <x-template::box-infographic :listNews="$boxInfographic">
                        <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid2</x-slot>
                        <x-slot name="cdTop">4</x-slot>
                        <x-slot name="zoneName">Infographic </x-slot>
                        <x-slot name="zoneUrl">/infographic.htm </x-slot>
                    </x-template::box-infographic>
                </div>
            </div>

            <div class="col-right">
                <div class="adtnv-right mb-20">
                    <a href="http://hcm.thanhnienviet.vn/" title="Thanhnienviet">
                        <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/images/banner-sai-gon-1553828595.jpg" alt="img" loading="lazy">
                    </a>
                </div>
                <div class="box-read">
                    <x-template::box-layout12 :listNews="$boxMostView">
                        <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}highestviewnews:zoneid0hour24</x-slot>
                        <x-slot name="cdTop">6</x-slot>
                    </x-template::box-layout12>
                </div>
                <div class="adtnv-right mt-10">
                    <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/Lam_theo_ao_uc_HCM.jpg" alt="img" loading="lazy">
                </div>
                <div class="adtnv-right mt-10">
                    <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/tu_tuong_cua_ang.jpg" alt="img" loading="lazy">
                </div>
                <div class="adtnv-right mt-10">
                    <a href="https://thanhnienviet.vn/thoi-su/bao-hiem-xa-hoi.htm" title="Bảo hiểm xã hội">
                        <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/bao_hiem_xa_hoi.jpg" alt="img" loading="lazy">
                    </a>
                </div>
                <div class="adtnv-right mt-10">
                    <a href="https://thanhnienviet.vn/giao-duc/viec-lam.htm" title="Việc làm">
                        <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/dien_an_giao_duc_nghe_nghiep.jpg" alt="img" loading="lazy">
                    </a>
                </div>
                <div class="adtnv-right mt-10">
                    <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/truyen_thong_giam_ngheo.jpg" alt="img" loading="lazy">
                </div>
                <div class="adtnv-right mt-10">
                    <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/thanh_nien_dan_toc.jpg" alt="img" loading="lazy">
                </div>
                <div class="adtnv-right mt-10">
                    <a href="https://www.agribank.com.vn/default.aspx" title="Agribank" target="_blank" rel="nofollow">
                        <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/agribank.jpg" alt="img" loading="lazy">
                    </a>
                </div>
                <div class="adtnv-right mt-10">
                    <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/Bac_ninh.jpg" alt="img" loading="lazy">
                </div>
                <div class="adtnv-right mt-10">
                    <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/MB.jpg" alt="img" loading="lazy">
                </div>
                <div class="adtnv-right mt-10">
                    <a href="https://hdbank.com.vn" title="HDbank" target="_blank" rel="nofollow">
                    <img src="https://static.mediacdn.vn/thumb_w/330/thanhnienviet.vn/banner/hd_bank.jpg" alt="img" loading="lazy">
                    </a>
                </div>
                    <div class="adtnv-right mt-10">
                        <div class="insert-hapodigital"></div>
                    </div>
            </div>
        </div>
    </div>
</div>
<script type="text/javascript">
    var swiper = new Swiper(".video-cate-vtv", {
        slidesPerView: "auto",

        pagination: {
            el: ".video-cate-vtv-pagination",
            clickable: true,
            type: "fraction",
        },

        navigation: {
            nextEl: ".video-cate-vtv-next",
            prevEl: ".video-cate-vtv-prev",
        },
    });

    $.ajax({
        url: `https://api.hapodigital.com/api/v2/keywords?uri={{ config('siteInfo.site_path')}}`,
        type: 'GET',
        success: function (res) {
            console.log(res)
            if (res) {
                $(res).insertBefore('.insert-hapodigital');
            }
        },
        timeout: 5000
    });

</script>
