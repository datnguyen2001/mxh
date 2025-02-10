<div class="profile__menu">
    <div class="profile__menu--v2">
        <div class="profile__menu--avatar">
            <img src="{{asset('/image/image-news.png')}}" alt="avatar" class="profile__menu--avatar__v2" id="prf_avatar1">
        </div>
        <p class="profile__menu--name">Xin chào, <span id="prfUsername"></span></p>
        <div class="profile__menu--option prf_menu">
            <div class="profile__menu--option__v2">
                <a href="/thong-tin-tai-khoan.htm" class="profile__menu--option__link {{(Request::getPathInfo()=='/thong-tin-tai-khoan.htm'?'link-active':'')}}" id="link_profile" data-tab="profile">Tài khoản của
                    tôi</a>
                <a href="/thong-tin-tai-khoan/doi-mat-khau.htm" class="profile__menu--option__link {{(Request::getPathInfo()=='/thong-tin-tai-khoan/doi-mat-khau.htm'?'link-active':'')}}"
                   id="link_pass" data-tab="changepass">Đổi mật khẩu</a>
            </div>
            <div class="profile__menu--option__v2">
                <a href="/thong-tin-tai-khoan/binh-luan.htm" class="profile__menu--option__link {{(Request::getPathInfo()=='/thong-tin-tai-khoan/binh-luan.htm'?'link-active':'')}}"
                   id="link_comment" data-tab="activity">Hoạt động bình luận</a>
                <a href="/thong-tin-tai-khoan/tin-da-luu.htm" class="profile__menu--option__link {{(Request::getPathInfo()=='/thong-tin-tai-khoan/tin-da-luu.htm'?'link-active':'')}}"
                   id="link_news_saved" data-tab="news_saved">Tin đã lưu</a>
                <a href="/thong-tin-tai-khoan/tin-da-xem.htm" class="profile__menu--option__link {{(Request::getPathInfo()=='/thong-tin-tai-khoan/tin-da-xem.htm'?'link-active':'')}}" id="link_news_viewed" data-tab="news_viewed">Tin đã xem</a>
            </div>
            <a href="javascript:;" class="profile__menu--option__link" id="btn_logout">Đăng xuất</a>
        </div>
    </div>
</div>
