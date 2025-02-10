@extends('mobile::layout.master')
@section('title'){{$HeadName}}@endsection
@section('title'){{config('metapage.Media.title')}}@endsection
@section('description'){{config('metapage.Media.description')}}@endsection
@section('keywords'){{config('metapage.Media.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Media.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Media.og:title')}}@endsection
@section('og-description'){{config('metapage.Media.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Media.og:image')}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss/'.strtolower($HeadName).'.rss'}}@endsection
@section('css')
    @include('mobile::expert.Css-list')
    @include('mobile::listimg.SchemaCat')
@endsection
@section('script')
    @include('mobile::expert.Js-list')
@endsection
@section('vue')
    <script src="{{asset('/js/vue.js')}}"></script>
    <script src="{{asset('/vue/box-lazy-loading-mob/box-lazy-loading-mob.umd.v07102021.min.js')}}"></script>
    <script type="application/javascript">
        new Vue({
            el: '#app',
            components: {},
        })
    </script>
@endsection
@section('content')
    <div class="breadcrumb">
        <div class="container">
            <div class="box-breadcrumb" data-layout="1" data-cd-key="keycd">
                <div class="box-breadcrumb-name">
                    <a href="/multimedia.htm" title="Media" data-role="cate-name" class="category-page__name">
                        Media
                        <span class="icon">
                                <svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M1.22499 9.72539L0 8.50039L3.5 5.00039L0 1.50039L1.22499 0.275391L5.94999 5.00039L1.22499 9.72539Z" fill="#FC9E4F"></path>
                                </svg>
                            </span>
                    </a>
                </div>
                <div class="box-breadcrumb-sub">
                    @if($type==29)<h1 style="display: inline-block"><a href="/multimedia/anh.htm" title="Ảnh" class="{{($type==29)?'active':''}}">Ảnh</a></h1>@else
                        <a href="/multimedia/anh.htm" title="Ảnh" class="{{($type==29)?'active':''}}">Ảnh</a>
                    @endif
                    <a href="/multimedia/video.htm" title="Video" >Video</a>
                    @if($type==20)<h1 style="display: inline-block"><a href="/multimedia/infographic.htm" title="Infographic" class="{{($type==20)?'active':''}}">Infographic</a></h1>@else
                        <a href="/multimedia/infographic.htm" title="Infographic" class="{{($type==20)?'active':''}}">Infographic</a>
                    @endif
                    @if($type==27) <h1 style="display: inline-block"><a href="/multimedia/emagazine.htm" title="Emagazine" class="{{($type==27)?'active':''}}">Emagazine</a></h1>@else
                        <a href="/multimedia/emagazine.htm" title="Emagazine" class="{{($type==27)?'active':''}}">Emagazine</a>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="home__top-focus">
        <div class="container">
            @if(!empty($newsFocusList))
                <x-mobile::box-category-focus :listNews="$newsFocusList"></x-mobile::box-category-focus>
                <div class="mt-30">
                    <x-box-ads nameAds="MCenter1"></x-box-ads>
                </div>
                <x-mobile::box-item-row :listNews="$newsListItem1"></x-mobile::box-item-row>
                <div class="mt-30">
                    <x-box-ads nameAds="MCenter2"></x-box-ads>
                </div>
                <x-mobile::box-item-row :listNews="$newsListItem2"></x-mobile::box-item-row>
                @if(!empty($newsListItem2))
                <div class="box-category" data-layout="2" data-cd-key="keycd" id="app">
                    <div class="box-category-middle">
                        <div id="box-lazy-loading" style="margin-top: 16px">
                            <box-lazy-loading
                                :zone-id="{{$type}}"
                                base-api="/timeline-category-media"
                            />
                        </div>
                    </div>
                </div>
                @endif
            @else
                <span style="font-size: 13px; line-height: 24px; margin-bottom: 0;    padding: 0 14px;">Không có kết quả</span>
            @endif
        </div>
    </div>
@endsection
