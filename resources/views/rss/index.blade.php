@extends('layout.master')
@section('title'){{'Rss - '.config('metapage.Home.title')}}@endsection
@section('description'){{config('metapage.Home.description')}}@endsection
@section('keywords'){{config('metapage.Home.keywords')}}@endsection
@section('news_keywords'){{config('metapage.Home.news_keywords')}}@endsection
@section('og-title'){{config('metapage.Home.og:title')}}@endsection
@section('og-description'){{config('metapage.Home.og:description')}}@endsection
@section('OgImage'){{config('metapage.Home.og:image')}}@endsection
@section('css')
    @include('expert.Css-list')
    <style>
        body{font-size:14px;color:#333;line-height:28px}ul.cate-content{border:1px solid #ddd;margin-bottom:15px}ul.cate-content>li{padding:7px 10px;border-bottom:1px solid #ddd;position:relative;font-weight:500}ul.cate-content>li:last-child{border-bottom:none}ul.cate-content>li>ul{padding-left:20px;display:none}ul.cate-content>li>ul.show{display:block}ul.cate-content>li>ul a{margin-bottom:3px}ul.cate-content>li>a{margin-bottom:5px;color:#202124;font-weight:600}ul.cate-content>li .linkrss{color:-webkit-link}.linkrss{color:#007aff;font-weight:500}.linkrss:hover,.titlelienhe{color:#008837}.titlelienhe{font-size:18px;font-weight:700;margin-bottom:15px}.cate-content .viewmore{font-size:13px;color:#969696;position:absolute;right:10px;top:8px;font-weight:400}.cate-content .viewmore .icon-viewdown{margin-bottom:2px}.cate-content .viewmore.less .icon-viewdown{transform:rotate(180deg)}
    </style>
@endsection
@section('js')
    @include('expert.Js-list')
@endsection
@section('content')
    <div class="body category-page" style="margin-top: 24px">
        <div class="container contain__first w-1312">
            <div class="category-page__header flex items-center">
                <h1><span class="category-page__name active">{{config('siteInfo.site_name')}} và các kênh tin RSS Feeds </span></h1>
            </div>
        </div>
        <div class="detail-main container flex contain__first w-1312">
            <div class="detail-main__left">
                <div class="detail-container" data-layout="1">
                    <div class="main-contain detail-content afcbc-body" style="padding-top: 40px">
                        <div class="baivietlienhe">
                            <p>Sử dụng RSS của {{config('siteInfo.site_name')}} sẽ giúp bạn luôn có được những thông tin mới nhất, nóng nhất
                                trong
                                và ngoài nước! Thêm một kênh RSS của {{config('siteInfo.site_name')}} vào trang My Yahoo!</p>
                            <p>Nhấn vào nút "Add to My Yahoo!" cùng dòng với mục bạn muốn trong bảng danh mục RSS của
                                {{config('siteInfo.site_name')}}</p>
                            <p>Làm theo các chỉ dẫn để thêm mục RSS tương ứng của {{config('siteInfo.site_name')}} vào trang My Yahoo của bạn.
                                Sử
                                dụng chương trình đọc RSS (RSS Reader)</p>
                            <p>Chép (copy) đường dẫn (URL) tương ứng với kênh RSS mà bạn ưa thích</p>
                            <p>Dán (paste) URL vào chương trình đọc RSS</p>
                        </div>
                        <ul class="cate-content" style="margin-top: 20px">
                            <li><a class="title" href="/rss/home.rss" title="home">Trang chủ - <span class="linkrss">{{config('siteInfo.site_path')}}/rss/home.rss</span></a>
                            </li>
                            @if(!empty($listCategory))
                                @foreach($listCategory as $value)
                                <li class="item">
                                    <a class="title" href="{{$value->URL??''}}"
                                       title="Trang chủ">{{$value->Name??''}} - <span class="linkrss">{{$value->URL??''}}</span></a>
                                    <ul class="child-items">
                                        @foreach($value->subZone as $item)
                                        <li>
                                            <a class="title"
                                               href="{{$item->URL??''}}" title="Thời sự">{{$item->Name??''}} - <span
                                                    class="linkrss">{{$item->URL??''}}</span></a>
                                        </li>
                                        @endforeach
                                    </ul>
                                </li>
                            @endforeach
                            @endif
                        </ul>

                            <p style="font-size: 18px; font-weight: 600">RSS là gì?</p>
                            <p><span style="font-weight: bold">RSS</span> (Really Simple Syndication) là định dạng dữ
                                liệu dựa
                                theo chuẩn XML được sử dụng để chia sẻ và phát tán nội dung Web. Việc sử dụng các chương
                                trình
                                đọc tin (News Reader, RSS Reader hay RSS Feeds) sẽ giúp bạn luôn xem được nhanh chóng
                                tin tức
                                mới nhất từ {{config('siteInfo.site_name')}}. Mỗi tin dưới dạng RSS sẽ gồm : Tiêu đề, tóm tắt nội dung và
                                đường dẫn
                                nối đến trang Web chứa nội dung đầy đủ của tin.</p>
                            <p style="font-size: 18px; font-weight: 600">Chương trình đọc RSS là gì?</p>
                            <p>
                                <span style="font-weight: bold">RSS Reader</span> là phần mềm có chức năng tự động lấy
                                tin tức
                                đã được cấu trúc theo định dạng RSS. Một số phần mềm đọc RSS cho phép bạn lập lịch cập
                                nhật tin
                                tức. Với chương trình đọc RSS, bạn có thể nhấn chuột vào tiêu đề của 1 tin để đọc phần
                                tóm tắt
                                của hoặc mở ra nội dung của toàn bộ tin trong một cửa sổ trình duyệt mặc định.<br>
                                Có rất nhiều phần mềm phục vụ khai thác tin qua định dạng RSS, bạn có thể tham khảo bảng
                                các
                                chương trình đọc RSS bên cạnh và lựa chọn cái bạn thích nhất.
                                <br>
                                Nếu đang sử dụng FireFox, bạn có thể tải chương trình Wizz RSS từ địa chỉ
                                <a target="_blank" href="https://addons.mozilla.org/en-US/firefox/424/ ">https://addons.mozilla.org/firefox/424/</a>
                            </p>
                            <p style="font-size: 18px; font-weight: 600">Điều kiện sử dụng</p>
                            <p>{{config('siteInfo.site_name')}} không chịu trách nhiệm về các nội dung của các trang khác ngoài {{config('siteInfo.site_name')}} được dẫn
                                trong
                                trang này. Khi sử dụng lại các tin lấy từ {{config('siteInfo.site_name')}}, bạn phải ghi rõ nguồn tin là "Theo
                                {{config('siteInfo.site_name')}}" hoặc "{{config('siteInfo.site_name')}}".</p>
                    </div>

                </div>
            </div>
            <div class="detail-main__right " style="margin-top: 20px">
                <div class="qc bg-qc"></div>
            </div>
        </div>
    </div>
    <script>
        (runinit = window.runinit || []).push(function () {
            var rssViewmore = '<a class="viewmore" href="javascript:;" rel="nofollow">Xem thêm <i class="icondv icon-viewdown"></i></a>';
            $('.cate-content >li').each(function () {
                var $child = $(this).find('ul');
                if ($child.find('li').length) {
                    $(this).append(rssViewmore);
                }
            });
            $('.cate-content .viewmore').on('click', function () {
                $(this).siblings('ul.child-items').toggleClass('show');
                if (!$(this).hasClass('less')) {
                    $(this).html('Rút gọn <i class="icondv icon-viewdown"></i>');
                    $(this).addClass('less');
                }
                else {
                    $(this).html('Xem thêm <i class="icondv icon-viewdown"></i>');
                    $(this).removeClass('less');
                }
            });
        });
    </script>
@endsection
