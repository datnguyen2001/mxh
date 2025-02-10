@extends('layout.master')
@section('title'){{sprintf(config('metapage.Media.title'),'Magazine')}}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{sprintf(config('metapage.Media.title'),'Magazine')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('css')
    @include('expert.Css-list')
    <style>
        .box-category[data-layout="14"] .box-category-middle .box-category-item:first-child .box-category-link-with-avatar:before {
            padding-bottom: 62.5%;
        }
    </style>
    <script type="text/javascript">
        var _ADM_Channel = '%2femagazine%2f';
    </script>
@endsection
@section('js')
    @include('expert.Js-list')
@endsection
@section('content')
    <div class="list__emaga-category">
        <div class="container">
            <div class="box-category-ema">
                <div class="box-category" data-layout="14" data-cd-key="newsbytype:type27">
                    <div class="box-category-top">
                        <h1 class="box-category-title">
                            <a href="/emagazine.htm" class="category-name_ac" style="color: #111111">eMagazine</a>
                        </h1>
                    </div>
                    <div class="box-category-middle">
                        @if(!empty($listNews))
                            @foreach ($listNews as $key=>$item)
                                <x-layout::box-category-item :dataItem="$item">
                                    @if($key==0)
                                        <x-slot name="noLazy">true</x-slot>
                                        <x-slot name="fetchpriority">true</x-slot>
                                        <x-slot name="headingTitleTag">h2</x-slot>
                                    @endif
                                    <x-slot name="isTimeAgo">true</x-slot>
                                    <x-slot name="noSapo">true</x-slot>
                                    <x-slot name="trimLineTitle">3</x-slot>
                                </x-layout::box-category-item>
                            @endforeach
                        @endif
                        <div class="box-stream-item box-stream-item-load hidden"></div>
                    </div>
                    @if(!empty($listNews) && count($listNews)>8)
                    <x-category.box-layout-loading2/>
                    <div class="list__viewmore list__center" style="display: block;">
                        <a href="javascript:;" rel="nofollow" class="load-more" title="Xem thêm">Xem thêm</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
