@extends('layout.master')
@section('title'){{sprintf(config('metapage.Media.title'),'Infographic')}}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{sprintf(config('metapage.Media.title'),'Infographic')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('css')
    @include('expert.Css-list')
    <script type="text/javascript">
        var _ADM_Channel = '%2finfographic%2f';
    </script>
    <style>
        .list__mustream.category-img .box-mustream .col-news .box-category .box-category-middle .box-category-link-with-avatar::after,
        .box-category[data-layout="17"] .box-category-middle .box-category-item .box-category-link-with-avatar::after{
            display: none;
        }
    </style>
@endsection
@section('js')
    @include('expert.Js-list')
@endsection
@section('content')
    <h1 class="box-category-title ">
        <a href="/infographic.htm" class="category-name_ac hidden" style="color: #111111">Infographic</a>
    </h1>
    <div class="list__category-images">
        <div class="container">
            <div class="col-news">
                <div class="box-category" data-layout="17" data-cd-key="newsbytype:type20">
                    <div class="box-category-middle">
                        @if(!empty($listNews))
                            @foreach ($listNews as $key=>$item)
                                @if($key==0)
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
                </div>
            </div>
        </div>
    </div>
    <div class="list__mustream category-img">
        <div class="container">
            <div class="box-mustream">
                <div class="col-news">
                    <div class="box-category" data-layout="16" data-cd-key="newsbytype:type20">
                        <div class="box-category-middle">
                            @if(!empty($listNews))
                                @foreach ($listNews as $key=>$item)
                                    @if($key>0)
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
                    </div>
                    @if(!empty($listNews) && count($listNews)>10)
                    <x-category.box-layout-loading3/>
                    <div class="list__viewmore list__center" style="display: block;">
                        <a href="javascript:;" rel="nofollow" class="load-more" title="Xem thêm">Xem thêm</a>
                    </div>
                    @endif
                </div>
                <div class="col-news-right">
                    @include('components.category.box-ads-right')
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
