@extends('mobile::layout.master')
@section('title'){{'Thay đổi mật khẩu | '.config('metapage.Home.title')}}@endsection
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
                <!-- Doi mk -->
                <div class="profile__contain profile__pass" style="display: block">
                    <div  class="profile__contain--form">
                        <p class="profile__contain--title">Đổi mật khẩu</p>
                        <div class="profile__contain--form__div">
                            <p class="profile__contain--form__label">Nhập mật khẩu hiện tại</p>
                            <a href="javascript:;" class="profile__contain--form__icon">
                                <img src="{{asset('/image/icon-pass.png')}}" alt="icon"></a>
                            <input type="password" class="profile__contain--form__input" id="old-password" name="old-password">
                        </div>
                        <div class="profile__contain--form__div">
                            <p class="profile__contain--form__label">Nhập mật khẩu mới</p>
                            <a href="javascript:;" class="profile__contain--form__icon">
                                <img src="{{asset('/image/icon-pass.png')}}" alt="icon"></a>
                            <input type="password" class="profile__contain--form__input" id="new-password" name="new-password">
                        </div>
                        <div class="profile__contain--form__div">
                            <p class="profile__contain--form__label">Xác nhận mật khẩu mới</p>
                            <a href="javascript:;" class="profile__contain--form__icon">
                                <img src="{{asset('/image/icon-pass.png')}}" alt="icon"></a>
                            <input type="password" class="profile__contain--form__input" id="confirm-password" name="confirm-password">
                        </div>
                        <div class="profile__contain--form__submit">
                            <button type="submit" class="profile__contain--form__submit--v2" id="btnChangePass">Lưu THAY ĐỔI</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
