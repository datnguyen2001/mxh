@extends('layout.master')
@section('title'){{config('metapage.Media.title')}}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Media.og:title')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('css')
    @include('expert.Css-list')
    <script type="text/javascript">
        var _ADM_Channel = '%2fmultimedia%2f';
    </script>
@endsection
@section('js')
    @include('expert.Js-list')
@endsection

@section('content')
    <div class="list__multimedia-main">
        <div class="container">
            <div class="list__multi-focus">
                <div class="box-category box-border-top" data-layout="19" data-cd-key="multimedia:zone0">
                    <div class="box-category-top">
                        <h1 class="title-category">
                            <a class="box-category-title" href="/multimedia.htm" title="Multimedia">
                                    <span class="icon">
                                        <svg width="28" height="28" viewBox="0 0 28 28" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M4.97656 23.8438C5.42923 23.8438 5.79688 23.4761 5.79688 23.0234C5.79688 22.5708 5.42923 22.2031 4.97656 22.2031C4.5239 22.2031 4.15625 22.5708 4.15625 23.0234C4.15625 23.4761 4.5239 23.8438 4.97656 23.8438Z" fill="#B70002" />
                                            <path d="M0.820312 28H13.1797V14.8203H0V27.1797C0 27.633 0.367004 28 0.820312 28ZM4.97656 20.5625C5.26559 20.5625 5.53903 20.6217 5.79688 20.7135V18.1016C5.79688 17.8172 5.94427 17.5536 6.1861 17.4039C6.42813 17.2541 6.73019 17.2419 6.98419 17.3678L10.2654 19.0084C10.6707 19.2111 10.835 19.7037 10.6322 20.1092C10.4286 20.5144 9.93839 20.677 9.53143 20.476L7.4375 19.429V23.0234C7.4375 24.3804 6.3335 25.4844 4.97656 25.4844C3.61963 25.4844 2.51562 24.3804 2.51562 23.0234C2.51562 21.6665 3.61963 20.5625 4.97656 20.5625Z" fill="#B70002" />
                                            <path d="M5.79688 8.36658L8.41974 6.61786L5.79688 4.86914V8.36658Z" fill="#B70002" />
                                            <path d="M13.1797 0H0.820312C0.367004 0 0 0.367004 0 0.820312V13.1797H13.1797V0ZM10.3535 7.29971L5.43158 10.581C5.17715 10.7504 4.85266 10.763 4.58969 10.6218C4.32288 10.4793 4.15625 10.2011 4.15625 9.89844V3.33594C4.15625 3.03323 4.32288 2.7551 4.58969 2.61261C4.85651 2.47076 5.18015 2.48593 5.43158 2.65341L10.3535 5.93466C10.5818 6.08676 10.7188 6.34311 10.7188 6.61719C10.7188 6.89105 10.5818 7.1474 10.3535 7.29971Z" fill="#B70002" />
                                            <path d="M14.8203 21.8635L17.5763 19.1622C17.8967 18.8418 18.4158 18.8418 18.7362 19.1622L19.7969 20.2228L22.4981 17.5216C22.8186 17.2011 23.3377 17.2011 23.6581 17.5216L28 21.8635V14.8203H14.8203V21.8635Z" fill="#B70002" />
                                            <path d="M20.9568 21.383L22.0175 22.4436C22.3379 22.7641 22.3379 23.2832 22.0175 23.6036C21.6971 23.924 21.1779 23.924 20.8575 23.6036L18.1562 20.9023L14.8203 24.1836V28.0002H27.1797C27.633 28.0002 28 27.6332 28 27.1799V24.1836L23.0781 19.2617L20.9568 21.383Z" fill="#B70002" />
                                            <path d="M18.9766 5.79688H20.6172V7.4375H18.9766V5.79688Z" fill="#B70002" />
                                            <path d="M22.2578 7.75134L23.8984 8.57166V4.66406L22.2578 5.48438V7.75134Z" fill="#B70002" />
                                            <path d="M27.1797 0H14.8203V13.1797H28V0.820312C28 0.367004 27.633 0 27.1797 0ZM25.5391 9.89844C25.5391 10.1828 25.3917 10.4464 25.1498 10.5961C24.9129 10.7433 24.6113 10.761 24.3517 10.6322L21.2435 9.07812H18.1562C17.7029 9.07812 17.3359 8.71112 17.3359 8.25781V4.97656C17.3359 4.52325 17.7029 4.15625 18.1562 4.15625H21.2435L24.3517 2.60214C24.6057 2.47482 24.9087 2.48764 25.1498 2.63824C25.3917 2.78799 25.5391 3.05161 25.5391 3.33594V9.89844Z" fill="#B70002" />
                                        </svg>
                                    </span>
                                    Multimedia
                            </a>
                        </h1>
                        <ul class="box-category-menu">
                            <li class="box-category-menu-item">
                                <a href="/multimedia/longform.htm" title="Longform">Longform</a>
                            </li>
                            <li class="box-category-menu-item">
                                <a href="/multimedia/infographic.htm" title="Infographic">Infographic</a>
                            </li>
                            <li class="box-category-menu-item">
                                <a href="/multimedia/tin-anh.htm" title="Tin ảnh">Tin ảnh</a>
                            </li>
                        </ul>
                    </div>
                    @if(!empty($ListNewsMutimedia))
                    <div class="box-category-middle">
                        <div class="swiper multi-swiper">
                            <div class="swiper-wrapper">
                                @foreach($ListNewsMutimedia as $key=>$value)
                                    <div class="swiper-slide">
                                    <div class="box-category-item">
                                        <a class="box-category-link-with-avatar img-resize"
                                           href="{{!empty($value->Url)?$value->Url:''}}" title="{{!empty($value->Title)?$value->Title:''}}"
                                           data-id="{{!empty($value->NewsId)?$value->NewsId:''}}">
                                            <img data-type="avatar" src="{{!empty($value->ThumbImage)?$value->ThumbImage:''}}"
                                                 alt="{{!empty($value->Title)?$value->Title:''}}"  class="box-category-avatar">
                                        </a>
                                        <div class="box-category-content">
                                                <span class="icon">
                                                    <svg width="72" height="72" viewBox="0 0 72 72" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M36 69C54.2254 69 69 54.2254 69 36C69 17.7746 54.2254 3 36 3C17.7746 3 3 17.7746 3 36C3 54.2254 17.7746 69 36 69ZM36 72C55.8822 72 72 55.8822 72 36C72 16.1177 55.8822 0 36 0C16.1177 0 0 16.1177 0 36C0 55.8822 16.1177 72 36 72Z" fill="white" />
                                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M27.0881 41.0542H36.229C36.8606 41.0542 37.3717 41.5653 37.3717 42.1968C37.3717 42.8284 36.8606 43.3394 36.229 43.3394H27.0881C26.4565 43.3394 25.9455 42.8284 25.9455 42.1968C25.9455 41.5653 26.4565 41.0542 27.0881 41.0542ZM27.0881 45.6247H36.229C36.8606 45.6247 37.3717 46.1357 37.3717 46.7673C37.3717 47.3988 36.8606 47.9099 36.229 47.9099H27.0881C26.4565 47.9099 25.9455 47.3988 25.9455 46.7673C25.9455 46.1357 26.4565 45.6247 27.0881 45.6247ZM27.0881 36.4837H36.229C36.8606 36.4837 37.3717 36.9948 37.3717 37.6263C37.3717 38.2579 36.8606 38.769 36.229 38.769H27.0881C26.4565 38.769 25.9455 38.2579 25.9455 37.6263C25.9455 36.9948 26.4565 36.4837 27.0881 36.4837ZM22.5227 18.125L22.5193 18.1257H46.5126V18.1253L46.5126 18.1253H49.9405C50.572 18.1253 51.0831 18.6364 51.0831 19.2679V51.4136C51.0831 52.0451 50.572 52.5562 49.9405 52.5562H22.5176C21.8861 52.5562 21.375 52.0451 21.375 51.4136V19.2679C21.375 18.6364 21.8861 18.1253 22.5176 18.1253H22.5193L22.5227 18.125ZM40.7995 36.4837H45.37C46.0015 36.4837 46.5126 36.9948 46.5126 37.6263V46.7673C46.5126 47.3988 46.0015 47.9099 45.37 47.9099H40.7995C40.168 47.9099 39.6569 47.3988 39.6569 46.7673V37.6263C39.6569 36.9948 40.168 36.4837 40.7995 36.4837ZM27.0881 22.7723H45.37C46.0015 22.7723 46.5126 23.2834 46.5126 23.9149V33.0559C46.5126 33.6874 46.0015 34.1985 45.37 34.1985H27.0881C26.4565 34.1985 25.9455 33.6874 25.9455 33.0559V23.9149C25.9455 23.2834 26.4565 22.7723 27.0881 22.7723Z" fill="white" />
                                                    </svg>
                                                </span>
                                            <h2 class="box-title">
                                                <a data-type="title" data-linktype="newsdetail"
                                                   data-id="{{!empty($value->NewsId)?$value->NewsId:''}}" class="box-category-link-title"
                                                   data-newstype="{{!empty($value->NewsType)?$value->NewsType:''}}" href="{{!empty($value->Url)?$value->Url:''}}"
                                                   title="{{!empty($value->Title)?$value->Title:''}}">{{!empty($value->Title)?$value->Title:''}}</a>
                                            </h2>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="multi-pagination"></div>
                        <div class="multi-next">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M11.9995 0.544922L9.95197 2.53944L17.9415 10.5676H0.544922V13.4313H17.9415L9.95197 21.4108L11.9995 23.454L23.454 11.9995L11.9995 0.544922Z" fill="#686868" />
                            </svg>
                        </div>
                        <div class="multi-prev">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M12.0005 0.544922L14.048 2.53944L6.05849 10.5676H23.4551V13.4313H6.05849L14.048 21.4108L12.0005 23.454L0.545988 11.9995L12.0005 0.544922Z" fill="#686868" />
                            </svg>
                        </div>
                    </div>
                    @endif
                </div>
            </div>

            <div class="list__multi-sec">
                <x-template::box-template20 :listNews="$ListNewsLongform">
                    <x-slot name="ZoneName">longform</x-slot>
                    <x-slot name="keycd">newsbytype:type27</x-slot>
                    <x-slot name="ZoneUrl">/multimedia/longform.htm</x-slot>
                </x-template::box-template20>
            </div>

            <div class="list__multi-sec">
                <x-template::box-template20 :listNews="$ListNewsInfographic">
                    <x-slot name="ZoneName">Infographic</x-slot>
                    <x-slot name="keycd">newsbytype:type20</x-slot>
                    <x-slot name="ZoneUrl">/multimedia/infographic.htm</x-slot>
                </x-template::box-template20>
            </div>
            <div class="list__multi-sec">
                <x-template::box-template20 :listNews="$ListNewsPhotostory">
                    <x-slot name="ZoneName">Tin ảnh</x-slot>
                    <x-slot name="keycd">newsbytype:type29</x-slot>
                    <x-slot name="ZoneUrl">/multimedia/tin-anh.htm</x-slot>
                </x-template::box-template20>
            </div>
        </div>
    </div>
@endsection
