@extends('mobile::layout.media-master')
@section('title'){{ config('metapage.Media.title') }}@endsection
@section('description'){{ config('metapage.Media.description') }}@endsection
@section('keywords')
{{ config('metapage.Media.keywords') }}
@endsection
@section('news_keywords')
{{ config('metapage.Media.news_keywords') }}
@endsection
@section('og-title')
{{ config('metapage.Media.og:title') }}
@endsection
@section('og-description')
{{ config('metapage.Media.og:description') }}
@endsection
@section('OgUrl')
{{ config('siteInfo.site_path').Request::getPathInfo() }}
@endsection
@section('OgImage')
{{ config('metapage.Media.og:image') }}
@endsection
@section('css')
    @include('mobile::expert.Css-list')
    @include('mobile::media.SchemaCat')
@endsection
@section('js')
    @include('mobile::expert.Js-list')
@endsection
@section('content')
    <div class="main">
        <div class="list__media-tab">
            <a href="/multimedia/longform.htm" class="item" title="Longform">Longform</a>
            <a href="/multimedia/infographic.htm" class="item" title="Infographic">Infographic</a>
            <a href="/multimedia/tin-anh.htm" class="item" title="Tin ảnh">Tin ảnh</a>
        </div>

        <div class="list__media-listing">
            <div class="container">
                <x-mobile::news.box-media-cat-news :infoCat="$infoLongform" :listNews="$listNewsLongform">
                    <x-slot name="keycd">{{ env('SITE_ID') }}newsbytypefull:type27</x-slot>
                    <x-slot name="cdtop">6</x-slot>
                </x-mobile::news.box-media-cat-news>
                <x-mobile::news.box-media-cat-news :infoCat="$infoInfographic" :listNews="$ListNewsInfographic">
                    <x-slot name="keycd">
                        {{ env('SITE_ID') }}newsbytypefull:type20
                    </x-slot>
                    <x-slot name="cdtop">6</x-slot>
                </x-mobile::news.box-media-cat-news>
                <x-mobile::news.box-media-cat-news :infoCat="$infoPhotostory" :listNews="$ListNewsPhotostory">
                    <x-slot name="keycd">
                        {{ env('SITE_ID') }}newsbytypefull:type29
                    </x-slot>
                    <x-slot name="cdtop">6</x-slot>
                </x-mobile::news.box-media-cat-news>
            </div>
        </div>
    </div>

    <div class="configHidden">
        {!! $ZoneInfoClientScript !!}
    </div>
@endsection
