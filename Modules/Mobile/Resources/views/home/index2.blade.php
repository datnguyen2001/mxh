<div class="home__video">
    <div class="container">
        <div class="box-video">
            <x-mobile:template::box-layout6 :listNews="$boxVideo" zoneInfo="">
                <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid4</x-slot>
                <x-slot name="cdTop">10</x-slot>
            </x-mobile:template::box-layout6>
        </div>
    </div>
</div>

<div class="home__tech">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['cong-nghe']['data']??[]" :zoneInfo="$dataByZone['cong-nghe']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['cong-nghe']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['cong-nghe']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>


<div class="home__images-new">
    <div class="container">
        <div class="box-images-new">
            <x-mobile:template::box-layout7 :listNews="$boxAnh" :zoneInfo="''">
                <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid3</x-slot>
                <x-slot name="cdTop">2</x-slot>
                <x-slot name="zoneName">{{'Ảnh'}}</x-slot>
                <x-slot name="zoneUrl">{{'/anh.htm'}}</x-slot>
            </x-mobile:template::box-layout7>
        </div>
    </div>
</div>

<div class="home__tech">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['giao-duc']['data']??[]" :zoneInfo="$dataByZone['giao-duc']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['giao-duc']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['giao-duc']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech bg">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['tai-chinh']['data']??[]" :zoneInfo="$dataByZone['tai-chinh']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['tai-chinh']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['tai-chinh']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['ly-luan-tre']['data']??[]" :zoneInfo="$dataByZone['ly-luan-tre']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['ly-luan-tre']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['ly-luan-tre']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech bg">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['can-biet']['data']??[]" :zoneInfo="$dataByZone['can-biet']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['can-biet']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['can-biet']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['suc-khoe']['data']??[]" :zoneInfo="$dataByZone['suc-khoe']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['suc-khoe']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['suc-khoe']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech bg">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['doanh-nhan']['data']??[]" :zoneInfo="$dataByZone['doanh-nhan']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['doanh-nhan']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['doanh-nhan']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['the-thao']['data']??[]" :zoneInfo="$dataByZone['the-thao']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['the-thao']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['the-thao']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech bg">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['giai-tri']['data']??[]" :zoneInfo="$dataByZone['giai-tri']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['giai-tri']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['giai-tri']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__tech">
    <div class="container">
        <div class="box-tech">
            <x-mobile:template::box-layout2 :listNews="$dataByZone['ban-doc']['data']??[]" :zoneInfo="$dataByZone['ban-doc']['info']??[]">
                <x-slot name="cdTop">{{$dataByZone['ban-doc']['cdTop']??''}}</x-slot>
                <x-slot name="cdKey">{{$dataByZone['ban-doc']['cdKey']??''}}</x-slot>
            </x-mobile:template::box-layout2>
        </div>
    </div>
</div>

<div class="home__info">
    <div class="container">
        <div class="box-info">
            <x-mobile:template::box-layout8 :listNews="$boxInfographic" :zoneInfo="''">
                <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid2</x-slot>
                <x-slot name="cdTop">2</x-slot>
                <x-slot name="zoneName">{{'Infographic'}}</x-slot>
                <x-slot name="zoneUrl">{{'/infographic.htm'}}</x-slot>
            </x-mobile:template::box-layout8>
        </div>
    </div>
</div>

<div class="home__read">
    <div class="container">
        <div class="box-read">
            <x-mobile:template::box-layout9 :listNews="$boxMostView">
                <x-slot name="cdKey">{{config('siteInfo.SITE_ID') }}highestviewnews:zoneid0hour24</x-slot>
                <x-slot name="cdTop">6</x-slot>
            </x-mobile:template::box-layout9>
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
    var swiper = new Swiper(".video-home-sw", {
        slidesPerView: "auto",
        autoplay: 5000,
        speed: 800,
        // pagination: {
        //     el: ".video-home-sw-pagination",
        // },
    });
</script>
