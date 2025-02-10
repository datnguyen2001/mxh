@extends('mobile::layout.master')
@section('title'){{'Thông tin tài khoản | ' .config('metapage.Home.title')}}@endsection
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
            <!-- qly tai khoan -->
            <div class="profile__contain profile__info active">
                <div class="profile__contain--left">
                    <p class="profile__contain--title">Tài khoản của Tôi</p>
                    <div class="profile__contain--left__avatar">
                        <img src="{{asset('/image/image-news.png')}}" alt="avatar" class="profile__contain--left__avatar--v2" id="prf_avatar">
                        <a href="javascript:;">
                            <img src="{{asset('/image/icon-camera-profile.png')}}" alt="icon"
                                class="profile__contain--left__avatar--icon"></a>
                        <div class="profile__contain--left__avatar--after icoupload">
                            <div class="profile__contain--left__avatar--after__v2"></div>
                        </div>
                        <input type="file" name="file" id="fileupload" style="display: none" placeholder="chọn file" class="ffile" accept="image/png, image/gif, image/jpeg">
                        <div class="profile__contain--left__text">Ảnh đại diện</div>
                    </div>
                </div>
                <div class="profile__contain--right">
                    <div class="profile__contain--right__form profile__contain--right__account">
                        <div class="profile__contain--right__form--label">
                            <img src="{{asset('/image/icon-profile-li.png')}}" alt="icon"
                                class="profile__contain--right__form--label__icon">
                            <p class="profile__contain--right__form--label__v2">Tên hiển thị</p>
                        </div>
                        <input type="file" name="" id="input_avatar" class="profile__input--avatar">
                        <p class="profile__contain--right__form--des">Dùng để hiển thị khi bình luận, đăng bài</p>
                        <input type="text" name="txt_uname" class="profile__contain--right__form--input" id="txt_uname">
                        <div class="profile__contain--right__form--label">
                            <img src="{{asset('/image/icon-profile-li.png')}}" alt="icon"
                                 class="profile__contain--right__form--label__icon">
                            <p class="profile__contain--right__form--label__v2">Giới tính</p>
                        </div>
                        <p class="profile__contain--right__form--des">Chúng tôi cam kết bảo mật thông tin này</p>
                        <div class="profile__contain--right__form--radio">
                            <input type="radio" id="male" name="sex" value="male">
                            <label for="male">Nam</label>
                            <input type="radio" id="female" name="sex" value="female">
                            <label for="female">Nữ</label>
                            <input type="radio" id="other" name="sex" value="diff">
                            <label for="other">Khác</label>
                        </div>
                        <div class="profile__contain--right__form--label profile__contain--right__form--label__date">
                            <img src="{{asset('/image/icon-profile-li.png')}}" alt="icon"
                                 class="profile__contain--right__form--label__icon">
                            <p class="profile__contain--right__form--label__v2 ">Ngày sinh</p>
                        </div>
                        <input type="date" name="" class="profile__contain--right__form--input" id="txt_date">

                        <div class="profile__contain--right__form--label">
                            <img src="{{asset('/image/icon-profile-li.png')}}" alt="icon"
                                 class="profile__contain--right__form--label__icon">
                            <p class="profile__contain--right__form--label__v2">Điện thoại</p>
                        </div>
                        <p class="profile__contain--right__form--des">Chúng tôi cam kết bảo mật thông tin này</p>
                        <input type="text" name="txt_phone" class="profile__contain--right__form--input" id="txt_phone">

                        <div class="profile__contain--right__form--label">
                            <img src="{{asset('/image/icon-profile-li.png')}}" alt="icon"
                                 class="profile__contain--right__form--label__icon">
                            <p class="profile__contain--right__form--label__v2">Vị trí</p>
                        </div>
                        <p class="profile__contain--right__form--des">Chúng tôi cam kết bảo mật thông tin này</p>
{{--                        <input type="text" name="" class="profile__contain--right__form--input">--}}
                        <input type="text" name="txt_address" class="profile__contain--right__form--input" id="txt_address">
                        <div class="profile__contain--form__submit">
                            <button type="submit" class="profile__contain--form__submit--v2" id="btnSaveProfile">LƯU THAY ĐỔI</button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- doi mk -->
            <div class="profile__contain profile__pass">
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

            <!-- tin da luu -->
            <div class="profile__contain profile__savenews">
                <div class="profile__contain--flex">
                    <p class="profile__contain--title">Tin đã lưu</p>
                    <select name="" id="" class="profile__contain--select">
                        <option value="">Tất cả</option>
                        <option value="">Bài viết</option>
                        <option value="">Video</option>
                        <option value="">ảnh</option>
                        <option value="">Infographic</option>
                        <option value="">Longfrom</option>
                    </select>
                </div>
                <div class="div" id="lstSave">
                </div>
                <div class="search__more">
                    <button class="search__more--button">Xem thêm</button>
                </div>
            </div>

            <!-- tin da xem -->
            <div class="profile__contain profile__viewnews">
                <div class="profile__contain--flex">
                    <p class="profile__contain--title">Tin đã xem</p>
                </div>
                <div class="div" id="lstView">
                </div>
                <div class="search__more">
                    <button class="search__more--button">Xem thêm</button>
                </div>
            </div>

            <!-- comment -->
            <div class="profile__contain profile__comment">
                <p class="profile__contain--title">Hoạt động bình luận</p>
                <div class="detail__comment">
                    <div class="detail__comment--left">
                        <a href="javascript:;" class="detail__comment--left__img">
                            <img src="{{asset('/image/image-news.png')}}" alt="avatar" title=""
                                class="detail__comment--left__img--v2">
                        </a>
                    </div>
                    <div class="detail__comment--right">
                        <a href="javascript:;" class="detail__comment--name">Nguyễn Ngọc</a>
                        <p class="detail__comment--info">Bài viết rất hữu ích, cảm ơn AUTOBLOG đã luôn cho tôi những
                            thông tin hay nhất</p>
                        <div class="detail__comment--right__v2">
                            <a href="javascript:;" class="detail__comment--reply">Trả lời</a>
                            <i class="sprite2 sprite-icon-save-news"></i>
                            <a href="javascript:;" class="detail__comment--like">Thích</a>
                            <p class="detail__comment--time">1 ngày trước</p>
                        </div>
                    </div>
                </div>
                <div class="search__more">
                    <button class="search__more--button">Xem thêm</button>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
