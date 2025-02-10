@extends('mobile::layout.master')
@section('title'){{sprintf(config('metapage.Media.title'),'Video')}}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{sprintf(config('metapage.Media.title'),'Video')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('css')
    @include('mobile::expert.Css-list')
    <script type="text/javascript">
        var _ADM_Channel = '%2fvideo%2f';
    </script>
@endsection
@section('js')
    @include('mobile::expert.Js-list')
@endsection
@section('content')
    <h1 class="box-category-title ">
        <a href="/video.htm" class="category-name_ac hidden" style="color: #111111">video</a>
    </h1>
    <div class="list__video-cate">
        <div class="container">
            <div class="box-list-cate">
                <div class="item-cate">
                    <div class="box-category" data-layout="12" data-cd-key="newsbytype:type13">
                        <div class="box-category-middle">
                            <div class="swiper  category-video-sw">
                                <div class="swiper-wrapper" >
                                    @if(!empty($listNews))
                                        @foreach ($listNews as $key=>$item)
                                            @if($key<5)
                                                <div class="swiper-slide" >
                                                    <x-layout::box-category-item :dataItem="$item">
                                                        <x-slot name="noLazy">true</x-slot>
                                                        <x-slot name="fetchpriority">true</x-slot>
                                                        <x-slot name="headingTitleTag">h2</x-slot>
                                                        <x-slot name="noSapo">true</x-slot>
                                                        <x-slot name="trimLineTitle">3</x-slot>
                                                    </x-layout::box-category-item>
                                                </div>
                                            @endif
                                        @endforeach
                                    @endif
                                </div>
                                <span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="item-cate">
                    <div class="box-category" data-layout="13" data-cd-key="newsbytype:type13">
                        <div class="box-category-middle">
                            @if(!empty($listNews))
                                @foreach ($listNews as $key=>$item)
                                    @if($key>4)
                                        <x-layout::box-category-item :dataItem="$item">
                                            <x-slot name="noSapo">true</x-slot>
                                            <x-slot name="noTime">true</x-slot>
                                            <x-slot name="trimLineTitle">3</x-slot>
                                        </x-layout::box-category-item>
                                    @endif
                                @endforeach
                            @endif
                            <div class="box-stream-item box-stream-item-load hidden"></div>
                        </div>
                        @if(!empty($listNews) && count($listNews)>5)
                            <x-category.box-layout-loading3/>
                            <div class="list__viewmore list__center" style="display: block;">
                                <a href="javascript:;" rel="nofollow" class="see-more" title="Xem thêm">Xem thêm</a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
