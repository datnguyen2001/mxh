@extends('layout.master')
@section('title'){{ config('metapage.Home.title') }}@endsection
@section('description'){{ config('metapage.Home.description') }}@endsection
@section('keywords'){{ config('metapage.Home.keywords') }}@endsection
@section('news_keywords'){{ config('metapage.Home.news_keywords') }}@endsection
@section('og-title'){{ config('metapage.Home.og:title') }}@endsection
@section('og-description'){{ config('metapage.Home.og:description') }}@endsection
@section('OgUrl'){{ config('siteInfo.site_path').Request::getPathInfo() }}@endsection
@section('OgImage'){{ config('metapage.Home.og:image') }}@endsection
@section('Link-rss'){{ config('siteInfo.site_path') . '/rss/home.rss' }}@endsection
@section('logo_home')
@endsection
@section('css')
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
@endsection

@section('content')
    <div class="box-page page__content">
        <div class="box-page-left">
            <div class="box-featured-topic">
                <div class="header-featured-topic">
                    <div class="box-icon-topic">
                        <img src="{{asset('image/icon-topic.png')}}" alt="">
                    </div>
                    <span class="title-topic">Chủ đề nổi bật</span>
                </div>
                <div>

                </div>
            </div>
        </div>
        <div>

        </div>
        <div>

        </div>
    </div>
@endsection
@section('js')

@endsection
