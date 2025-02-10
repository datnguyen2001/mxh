<div class="header">
    <div class="header__middle">
        <div class="container">
            <div class="header__sflex-top">
                <div class="box-action-bar">
                      <span class="icon-bar">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M2.125 12H23.125" stroke="#292929" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"/>
                          <path d="M2.125 5H23.125" stroke="#292929" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"/>
                          <path d="M2.125 19H23.125" stroke="#292929" stroke-width="1.5" stroke-linecap="round"
                                stroke-linejoin="round"/>
                        </svg>
                      </span>
                    <span class="icon-close">
                        <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path d="M5.20044 19.4246L20.0497 4.57538" stroke="#292929" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"/>
                          <path d="M20.0522 19.4258L5.203 4.57654" stroke="#292929" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                      </span>
                </div>
                @if (View::hasSection('logo_home'))
                    <h1>
                        <a href="/" class="logo" title="{{ config('metapage.Home.title') }}" style="justify-content: center;">
                            <img src="https://static.mediacdn.vn/thumb_w/300/thanhnienviet.vn/images/TNV.png" alt="logo" width="148" height="54">
                        </a>
                    </h1>
                @else
                    <a href="/" class="logo" title="{{ config('metapage.Home.title') }}" style="justify-content: center;">
                        <img src="https://static.mediacdn.vn/thumb_w/300/thanhnienviet.vn/images/TNV.png" alt="logo" width="148" height="54">
                    </a>
                @endif
                <div class="box-search">
                  <span class="icon-search show">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path
                          d="M10.125 17C13.991 17 17.125 13.866 17.125 10C17.125 6.13401 13.991 3 10.125 3C6.25901 3 3.125 6.13401 3.125 10C3.125 13.866 6.25901 17 10.125 17Z"
                          stroke="#666666" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                      <path d="M20.625 20.5L15.125 15" stroke="#666666" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round"/>
                    </svg>
                  </span>

                    <span class="icon-search-hidden">
                    <svg width="25" height="24" viewBox="0 0 25 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                      <path d="M5.20044 19.4246L20.0497 4.57538" stroke="#292929" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                      <path d="M20.0522 19.4258L5.203 4.57654" stroke="#292929" stroke-width="1.5"
                            stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                  </span>
                </div>
            </div>
        </div>

        <div class="header__menu-mb">
            <div class="header__scroll">
                <div class="container">
                    <div class="header__m-cate">
                        <ul class="list">
                            <li class="item">
                                <div class="top">
                                    <a href="/thoi-su.htm" class="item-link" title="Thời sự">
                                        Thời sự
                                    </a>
                                    <span class="icon">
                                    <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                         xmlns="http://www.w3.org/2000/svg">
                                      <path
                                          d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                                          fill="#8B8B8B"/>
                                    </svg>
                                  </span>
                                </div>
                                <div class="bottom">
                                    <div class="list">
                                        <a href="/thoi-su/chinh-tri.htm" class="item" title="Chính trị">
                                            Chính trị
                                        </a>
                                        <a href="/thoi-su/the-gioi.htm" class="item" title="Thế giới">
                                            Thế giới
                                        </a>
                                        <a href="/thoi-su/tieu-diem.htm" class="item" title="Tiêu điểm">
                                            Tiêu điểm
                                        </a>
                                        <a href="/thoi-su/xa-hoi.htm" class="item" title="Xã hội">
                                            Xã hội
                                        </a>
                                        <a href="/thoi-su/bao-hiem-xa-hoi.htm" class="item" title="Bảo hiểm xã hội">
                                            Bảo hiểm xã hội
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a class="item-link" href="/gioi-tre.htm" title="Giới trẻ">
                                        Giới trẻ
                                    </a>

                                    <span class="icon">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                          <path
                                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                                              fill="#8B8B8B"/>
                                        </svg>
                                      </span>
                                </div>
                                <div class="bottom">
                                    <div class="list">
                                        <a href="/gioi-tre/nhip-song-tre.htm" class="item" title="Nhịp sống trẻ">
                                            Nhịp sống trẻ
                                        </a>
                                        <a href="/gioi-tre/doan-hoi-doi.htm" class="item" title="Đoàn, Hội, Đội">
                                            Đoàn, Hội, Đội
                                        </a>
                                        <a href="/gioi-tre/lam-theo-loi-bac.htm" class="item" title="Làm theo lời bác">
                                            Làm theo lời bác
                                        </a>
                                        <a href="/gioi-tre/nhat-ky-tinh-nguyen.htm" class="item"
                                           title="Nhật ký tình nguyện">
                                            Nhật ký tình nguyện
                                        </a>
                                        <a href="/gioi-tre/thanh-nien-khoi-nghiep.htm" class="item"
                                            title="Thanh niên khởi nghiệp">
                                            Thanh niên khởi nghiệp
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/ly-luan-tre.htm" class="item-link" title=" Lý luận trẻ">
                                        Lý luận trẻ
                                    </a>
                                </div>


                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/giao-duc.htm" class="item-link" title="Giáo dục">
                                        Giáo dục
                                    </a>

                                    <span class="icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                              fill="#8B8B8B"/>
                        </svg>
                      </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/giao-duc/day-nghe.htm" class="item" title="Dạy nghề">
                                            Dạy nghề
                                        </a>
                                        <a href="/giao-duc/du-hoc.htm" class="item" title="Du học">
                                            Du học
                                        </a>
                                        <a href="/giao-duc/huong-nghiep.htm" class="item" title="Hướng nghiệp">
                                            Hướng nghiệp
                                        </a>
                                        <a href="/giao-duc/dao-tao-truc-tuyen.htm" class="item"
                                           title="Đào tạo trực tuyến">
                                            Đào tạo trực tuyến
                                        </a>
                                        <a href="/giao-duc/viec-lam.htm" class="item" title="Việc làm">
                                            Việc làm
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/cong-nghe.htm" class="item-link" title="Công nghệ">
                                        Công nghệ
                                    </a>
                                    <span class="icon">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                          <path
                                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                                              fill="#8B8B8B"/>
                                        </svg>
                                    </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/cong-nghe/so-hoa.htm" class="item" title="Sổ hóa">
                                            Sổ hóa
                                        </a>
                                        <a href="/cong-nghe/o-to-xe-may.htm" class="item" title="Ô tô - Xe máy">
                                            Ô tô - Xe máy
                                        </a>
                                        <a href="/cong-nghe/so-huu-tri-tue.htm" class="item" title="Sở hữu trí tuệ">
                                            Sở hữu trí tuệ
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/doanh-nhan.htm" class="item-link" title="Doanh nhân">
                                        Doanh nhân
                                    </a>
                                    <span class="icon">
                                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none"
                                             xmlns="http://www.w3.org/2000/svg">
                                          <path
                                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                                              fill="#8B8B8B"/>
                                        </svg>
                                      </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/doanh-nhan/guong-doanh-nhan-tre.htm" class="item"
                                           title="Gương doanh nhân trẻ">
                                            Gương doanh nhân trẻ
                                        </a>
                                        <a href="/doanh-nhan/hoi-nhap.htm" class="item" title="Hội nhập">
                                            Hội nhập
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/the-thao.htm" class="item-link" title="Thể thao">
                                        Thể thao
                                    </a>

                                    <span class="icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                              fill="#8B8B8B"/>
                        </svg>
                      </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/the-thao/tennis.htm" class="item" title="Tennis">
                                            Tennis
                                        </a>
                                        <a href="/the-thao/the-thao-trong-nuoc.htm" class="item"
                                           title="Thể thao trong nước">
                                            Thể thao trong nước
                                        </a>
                                        <a href="/the-thao/the-thao-quoc-te.htm" class="item" title="Thể thao quốc tế">
                                            Thể thao quốc tế
                                        </a>
                                        <a href="/the-thao/van-hoa-the-thao.htm" class="item" title="Văn hóa thể thao">
                                            Văn hóa thể thao
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/giai-tri.htm" class="item-link" title="Giải trí">
                                        Giải trí
                                    </a>

                                    <span class="icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                              fill="#8B8B8B"/>
                        </svg>
                      </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/giai-tri/van-hoa.htm" class="item" title="Văn hóa">
                                            Văn hóa
                                        </a>
                                        <a href="/giai-tri/goc-hai-huoc.htm" class="item" title="Góc hài hước">
                                            Góc hài hước
                                        </a>
                                        <a href="/giai-tri/thu-gian.htm" class="item" title="Thư giãn">
                                            Thư giãn
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/suc-khoe.htm" class="item-link" title="Sức khỏe">
                                        Sức khỏe
                                    </a>

                                    <span class="icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                              fill="#8B8B8B"/>
                        </svg>
                      </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/suc-khoe/dinh-duong.htm" class="item" title="Dinh dưỡng">
                                            Dinh dưỡng
                                        </a>
                                        <a href="/suc-khoe/gioi-tinh.htm" class="item" title="Giới tính">
                                            Giới tính
                                        </a>
                                        <a href="/suc-khoe/truyen-thong-y-te.htm" class="item"
                                           title="Truyền thông - y tế">
                                            Truyền thông - y tế
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/tai-chinh.htm" class="item-link" title="Tài chính">
                                        Tài chính
                                    </a>
                                    <span class="icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                              fill="#8B8B8B"/>
                        </svg>
                      </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/tai-chinh/tai-chinh-ngan-hang.htm" class="item"
                                           title="Tài chính - Ngân hàng">
                                            Tài chính - Ngân hàng
                                        </a>
                                        <a href="/tai-chinh/chung-khoan.htm" class="item" title="Chứng khoán">
                                            Chứng khoán
                                        </a>
                                        <a href="/tai-chinh/tien-te.htm" class="item" title="Tiền tệ">
                                            Tiền tệ
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/can-biet.htm" class="item-link" title="Cần biết">
                                        Cần biết
                                    </a>

                                    <span class="icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                              fill="#8B8B8B"/>
                        </svg>
                      </span>
                                </div>

                                <div class="bottom">
                                    <div class="list">
                                        <a href="/can-biet/thi-truong.htm" class="item" title="Thị trường">
                                            Thị trường
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/ban-doc.htm" class="item-link" title="Bạn đọc">
                                        Bạn đọc
                                    </a>

                                    <span class="icon">
                        <svg width="24" height="25" viewBox="0 0 24 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                          <path
                              d="M15.8805 9.87062L12.0005 13.7506L8.12047 9.87062C7.73047 9.48063 7.10047 9.48063 6.71047 9.87062C6.32047 10.2606 6.32047 10.8906 6.71047 11.2806L11.3005 15.8706C11.6905 16.2606 12.3205 16.2606 12.7105 15.8706L17.3005 11.2806C17.6905 10.8906 17.6905 10.2606 17.3005 9.87062C16.9105 9.49062 16.2705 9.48063 15.8805 9.87062Z"
                              fill="#8B8B8B"/>
                        </svg>
                      </span>
                                </div>
                                <div class="bottom">
                                    <div class="list">
                                        <a href="/ban-doc/hop-thu-ban-doc.htm" class="item" title="Hộp thư bạn đọc">
                                            Hộp thư bạn đọc
                                        </a>
                                        <a href="/ban-doc/duong-day-nong.htm" class="item" title="Đường dây nóng">
                                            Đường dây nóng
                                        </a>
                                        <a href="/ban-doc/nhip-cau-nhan-ai.htm" class="item" title="Nhịp cầu nhân ái">
                                            Nhịp cầu nhân ái
                                        </a>
                                    </div>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/emagazine.htm" class="item-link" title="Emagazine">
                                        Emagazine
                                    </a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/video.htm" class="item-link" title="Video">
                                        Video
                                    </a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/anh.htm" class="item-link" title="Ảnh">
                                        Ảnh
                                    </a>
                                </div>
                            </li>
                            <li class="item">
                                <div class="top">
                                    <a href="/infographic.htm" class="item-link" title="Infographic">
                                        Inforgraphic
                                    </a>
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="header__popup-search" id="popup-search-js">
            <div class="search-item box-search">
                <div class="input-wrap">
                    <input class="input-search txt-search" placeholder="Nhập nội dung cần tìm">
                    <a href="javascript:;" class="icon-search-show btn-search-a" rel="nofollow" title="Tìm kiếm">
                        <svg width="24" height="24" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <g clip-path="url(#clip0_4690_121205)">
                                <path
                                    d="M16.1986 14.608H15.3645L15.0688 14.3231C16.3359 12.8458 16.9905 10.8304 16.6315 8.68827C16.1352 5.75477 13.6857 3.41219 10.7294 3.05342C6.26319 2.50471 2.50442 6.26128 3.05345 10.7248C3.41244 13.6794 5.75639 16.1275 8.69161 16.6235C10.835 16.9823 12.8516 16.328 14.3298 15.0618L14.6148 15.3572V16.1909L19.1021 20.6755C19.535 21.1082 20.2424 21.1082 20.6753 20.6755C21.1082 20.2429 21.1082 19.5359 20.6753 19.1032L16.1986 14.608ZM9.86358 14.608C7.23456 14.608 5.11233 12.487 5.11233 9.85956C5.11233 7.23207 7.23456 5.11109 9.86358 5.11109C12.4926 5.11109 14.6148 7.23207 14.6148 9.85956C14.6148 12.487 12.4926 14.608 9.86358 14.608Z"
                                    fill="#A0A0A0"></path>
                            </g>
                            <defs>
                                <clipPath id="clip0_4690_121205">
                                    <rect width="24" height="24" fill="white"></rect>
                                </clipPath>
                            </defs>
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
