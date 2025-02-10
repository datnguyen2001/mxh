@extends('mobile::layout.master')
@section('title'){{'Tin đã xem | '.config('metapage.Home.title')}}@endsection
@section('description'){{config('metapage.Home.description')}}@endsection
@section('keywords'){{config('metapage.Home.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Home.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Home.og:title')}}@endsection
@section('og-description'){{config('metapage.Home.og:description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{config('metapage.Home.og:image')}}@endsection
@section('css')
    @include('mobile::expert.Css-detail')
    <style type="text/css">
        img{
            width: unset;
        }
    </style>
@endsection
@section('js')
    @include('mobile::expert.Js-detail')
@endsection
@section('content')
    <div class="profile">
        <div class="profile__v2">
            @include('user.menu-profile')
            <div class='profile__right'>
                <!-- tin da xem -->
                <div class="profile__contain profile__viewnews" style="display: block">
                    <div class="profile__contain--flex">
                        <p class="profile__contain--title">Tin đã xem</p>
                    </div>
                    <div class="div" id="lstView">
                    </div>
                    <div id="atv_view" class="search__more">
                        <div class="page">

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
