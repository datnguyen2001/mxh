@extends('mobile::layout.master')
@section('title'){{'Tin đã lưu | '.config('metapage.Home.title')}}@endsection
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
                <!-- tin da luu -->
                <div class="profile__contain profile__savenews" style="display: block">
                    <div class="profile__contain--flex">
                        <p class="profile__contain--title">Tin đã lưu</p>
                        <select name="select_type" id="select_type" class="profile__contain--select">
                            <option value="100" selected>Tất cả</option>
                            <option value="0">Bài viết</option>
                            <option value="13">Video</option>
                            <option value="29">Ảnh</option>
                            <option value="20">Infographic</option>
                            <option value="27">Longfrom</option>
                        </select>
                    </div>
                    <div class="div" id="lstSave">
                    </div>
                    <div id="atv_save" class="search__more">
                        <div class="page">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
