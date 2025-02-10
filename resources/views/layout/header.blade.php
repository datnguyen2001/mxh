<div class="header">
    <div class="header__box-top">
        <div class="container">
            <div class="flex-header-top">
                <div class="box-tag">
                    <div  id="insert-tag-trending" data-cs-key="{{config('siteInfo.SITE_ID') }}objectembedbox:zoneid0typeid1">
                    </div>
                </div>
                @if (View::hasSection('logo_home'))
                    <h1>
                        <a href="/" class="logo-header" title="{{ config('metapage.Home.title') }}">
                            <img src="https://static.mediacdn.vn/thumb_w/300/thanhnienviet.vn/images/TNV.png" alt="logo" width="200" height="74">
                        </a>
                    </h1>
                @else
                    <a href="/" class="logo-header" title="{{ config('metapage.Home.title') }}">
                        <img src="https://static.mediacdn.vn/thumb_w/300/thanhnienviet.vn/images/TNV.png" alt="logo"  width="200" height="74">
                    </a>
                @endif
                <div class="box-search">
                    <a href="javascript:;" class="icon-search" title="Search" rel="nofollow">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 17C13.866 17 17 13.866 17 10C17 6.13401 13.866 3 10 3C6.13401 3 3 6.13401 3 10C3 13.866 6.13401 17 10 17Z" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M20.5 20.5L15 15" stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </a>
                    <div class="box-show">
                        <input class="input-search txt-search" placeholder="Nhập nội dung cần tìm">
                        <a href="javascript:;"  class="icon-search-show btn-search-a" rel="nofollow">
                            <svg width="20" height="21" viewBox="0 0 20 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path fill-rule="evenodd" clip-rule="evenodd" d="M9.17203 3C8.10802 3.00009 7.05946 3.25462 6.11383 3.74235C5.1682 4.23009 4.35292 4.93688 3.73601 5.80376C3.1191 6.67065 2.71846 7.67249 2.5675 8.7257C2.41654 9.7789 2.51965 10.8529 2.86821 11.8582C3.21678 12.8635 3.8007 13.7708 4.57127 14.5045C5.34183 15.2382 6.27668 15.777 7.29783 16.0759C8.31898 16.3749 9.39682 16.4253 10.4414 16.223C11.486 16.0206 12.4671 15.5715 13.3028 14.9129L16.1696 17.7796C16.3177 17.9226 16.516 18.0018 16.7218 18C16.9276 17.9982 17.1245 17.9156 17.2701 17.7701C17.4156 17.6245 17.4982 17.4277 17.5 17.2218C17.5018 17.016 17.4226 16.8177 17.2796 16.6697L14.4128 13.8029C15.1884 12.819 15.6713 11.6367 15.8062 10.3912C15.9412 9.14567 15.7228 7.88732 15.176 6.76014C14.6292 5.63296 13.776 4.6825 12.7142 4.01752C11.6525 3.35254 10.4249 2.99992 9.17203 3ZM4.06946 9.67235C4.06946 8.31911 4.60705 7.0213 5.56397 6.06442C6.52089 5.10754 7.81875 4.56996 9.17203 4.56996C10.5253 4.56996 11.8232 5.10754 12.7801 6.06442C13.737 7.0213 14.2746 8.31911 14.2746 9.67235C14.2746 11.0256 13.737 12.3234 12.7801 13.2803C11.8232 14.2372 10.5253 14.7747 9.17203 14.7747C7.81875 14.7747 6.52089 14.2372 5.56397 13.2803C4.60705 12.3234 4.06946 11.0256 4.06946 9.67235Z" fill="white"></path>
                            </svg>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header__menu">
        <div class="container">
            <div class="flex-menu">
                <div class="item-menu-expan">
                    <a href="/thoi-su.htm" class="item-menu" title="Thời sự">
                        Thời sự
                    </a>
                    <div class="child-menu-hover">
                        <a href="/thoi-su/chinh-tri.htm" class="menu-child" title="Chính trị">
                            Chính trị
                        </a>
                        <a href="/thoi-su/the-gioi.htm" class="menu-child" title="Thế giới">
                            Thế giới
                        </a>
                        <a href="/thoi-su/tieu-diem.htm" class="menu-child" title="Tiêu điểm">
                            Tiêu điểm
                        </a>
                        <a href="/thoi-su/xa-hoi.htm" class="menu-child" title="Xã hội">
                            Xã hội
                        </a>
                        <a href="/thoi-su/bao-hiem-xa-hoi.htm" class="menu-child" title="Bảo hiểm xã hội">
                            Bảo hiểm xã hội
                        </a>
                    </div>
                </div>

                <div class="item-menu-expan">
                    <a href="/gioi-tre.htm" class="item-menu" title="Giới trẻ">
                        Giới trẻ
                    </a>
                    <div class="child-menu-hover">
                        <a href="/gioi-tre/nhip-song-tre.htm" class="menu-child" title="Nhịp sống trẻ">
                            Nhịp sống trẻ
                        </a>
                        <a href="/gioi-tre/doan-hoi-doi.htm" class="menu-child" title="Đoàn, Hội, Đội">
                            Đoàn, Hội, Đội
                        </a>
                        <a href="/gioi-tre/lam-theo-loi-bac.htm" class="menu-child" title="Làm theo lời bác">
                            Làm theo lời bác
                        </a>
                        <a href="/gioi-tre/nhat-ky-tinh-nguyen.htm" class="menu-child" title="Nhật ký tình nguyện">
                            Nhật ký tình nguyện
                        </a>
                        <a href="/gioi-tre/thanh-nien-khoi-nghiep.htm" class="menu-child"
                            title="Thanh niên khởi nghiệp">
                            Thanh niên khởi nghiệp
                        </a>
                    </div>
                </div>

                    <a href="/ly-luan-tre.htm" class="item-menu" title=" Lý luận trẻ">
                        Lý luận trẻ
                    </a>

                <div class="item-menu-expan">
                    <a href="/giao-duc.htm" class="item-menu" title="Giáo dục">
                        Giáo dục
                    </a>
                    <div class="child-menu-hover">
                        <a href="/giao-duc/day-nghe.htm" class="menu-child" title="Dạy nghề">
                            Dạy nghề
                        </a>
                        <a href="/giao-duc/du-hoc.htm" class="menu-child" title="Du học">
                            Du học
                        </a>
                        <a href="/giao-duc/huong-nghiep.htm" class="menu-child" title="Hướng nghiệp">
                            Hướng nghiệp
                        </a>
                        <a href="/giao-duc/dao-tao-truc-tuyen.htm" class="menu-child" title="Đào tạo trực tuyến">
                            Đào tạo trực tuyến
                        </a>
                        <a href="/giao-duc/viec-lam.htm" class="menu-child" title="Việc làm">
                            Việc làm
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                <a href="/cong-nghe.htm" class="item-menu" title="Công nghệ">
                    Công nghệ
                </a>
                    <div class="child-menu-hover">
                        <a href="/cong-nghe/so-hoa.htm" class="menu-child" title="Sổ hóa">
                            Sổ hóa
                        </a>
                        <a href="/cong-nghe/o-to-xe-may.htm" class="menu-child" title="Ô tô - Xe máy">
                            Ô tô - Xe máy
                        </a>
                        <a href="/cong-nghe/so-huu-tri-tue.htm" class="menu-child" title="Sở hữu trí tuệ">
                            Sở hữu trí tuệ
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                    <a href="/doanh-nhan.htm" class="item-menu" title="Doanh nhân">
                        Doanh nhân
                    </a>
                    <div class="child-menu-hover">
                        <a href="/doanh-nhan/guong-doanh-nhan-tre.htm" class="menu-child" title="Gương doanh nhân trẻ">
                            Gương doanh nhân trẻ
                        </a>
                        <a href="/doanh-nhan/hoi-nhap.htm" class="menu-child" title="Hội nhập">
                            Hội nhập
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                    <a href="/the-thao.htm" class="item-menu" title="Thể thao">
                        Thể thao
                    </a>
                    <div class="child-menu-hover">
                        <a href="/the-thao/tennis.htm" class="menu-child" title="Tennis">
                            Tennis
                        </a>
                        <a href="/the-thao/the-thao-trong-nuoc.htm" class="menu-child" title="Thể thao trong nước">
                            Thể thao trong nước
                        </a>
                        <a href="/the-thao/the-thao-quoc-te.htm" class="menu-child" title="Thể thao quốc tế">
                            Thể thao quốc tế
                        </a>
                        <a href="/the-thao/van-hoa-the-thao.htm" class="menu-child" title="Văn hóa thể thao">
                            Văn hóa thể thao
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                    <a href="/giai-tri.htm" class="item-menu" title="Giải trí">
                        Giải trí
                    </a>
                    <div class="child-menu-hover">
                        <a href="/giai-tri/van-hoa.htm" class="menu-child" title="Văn hóa">
                            Văn hóa
                        </a>
                        <a href="/giai-tri/goc-hai-huoc.htm" class="menu-child" title="Góc hài hước">
                            Góc hài hước
                        </a>
                        <a href="/giai-tri/thu-gian.htm" class="menu-child" title="Thư giãn">
                            Thư giãn
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                    <a href="/suc-khoe.htm" class="item-menu" title="Sức khỏe">
                        Sức khỏe
                    </a>
                    <div class="child-menu-hover">
                        <a href="/suc-khoe/dinh-duong.htm" class="menu-child" title="Dinh dưỡng">
                            Dinh dưỡng
                        </a>
                        <a href="/suc-khoe/gioi-tinh.htm" class="menu-child" title="Giới tính">
                            Giới tính
                        </a>
                        <a href="/suc-khoe/truyen-thong-y-te.htm" class="menu-child" title="Truyền thông - y tế">
                            Truyền thông - y tế
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                <a href="/tai-chinh.htm" class="item-menu" title="Tài chính">
                    Tài chính
                </a>
                    <div class="child-menu-hover">
                        <a href="/tai-chinh/tai-chinh-ngan-hang.htm" class="menu-child" title="Tài chính - Ngân hàng">
                            Tài chính - Ngân hàng
                        </a>
                        <a href="/tai-chinh/chung-khoan.htm" class="menu-child" title="Chứng khoán">
                            Chứng khoán
                        </a>
                        <a href="/tai-chinh/tien-te.htm" class="menu-child" title="Tiền tệ">
                            Tiền tệ
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                    <a href="/can-biet.htm" class="item-menu" title="Cần biết">
                        Cần biết
                    </a>
                    <div class="child-menu-hover">
                        <a href="/can-biet/thi-truong.htm" class="menu-child" title="Thị trường">
                            Thị trường
                        </a>
                    </div>
                </div>
                <div class="item-menu-expan">
                    <a href="/ban-doc.htm" class="item-menu" title="Bạn đọc">
                        Bạn đọc
                    </a>
                    <div class="child-menu-hover">
                        <a href="/ban-doc/hop-thu-ban-doc.htm" class="menu-child" title="Hộp thư bạn đọc">
                            Hộp thư bạn đọc
                        </a>
                        <a href="/ban-doc/duong-day-nong.htm" class="menu-child" title="Đường dây nóng">
                            Đường dây nóng
                        </a>
                        <a href="/ban-doc/nhip-cau-nhan-ai.htm" class="menu-child" title="Nhịp cầu nhân ái">
                            Nhịp cầu nhân ái
                        </a>
                    </div>
                </div>
                <a href="/emagazine.htm" class="item-menu" title="Emagazine">
                    Emagazine
                </a>
                <a href="/video.htm" class="item-menu" title="Video">
                    Video
                </a>
                <a href="/anh.htm" class="item-menu" title="Ảnh">
                    Ảnh
                </a>
                <a href="/infographic.htm" class="item-menu" title="Infographic">
                    Inforgraphic
                </a>
            </div>
        </div>
    </div>
</div>
