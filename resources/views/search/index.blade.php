@extends('layout.master')
@section('title'){{'Tìm kiếm bài viết'}}@endsection
@section('description'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('keywords'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('news_keywords'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('og-title'){{'Tìm kiếm bài viết'}}@endsection
@section('og-description'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('Robots'){{'noindex, nofollow'}}@endsection
@section('css')
    @include('expert.Css-list')
    <script type="text/javascript">
        var _ADM_Channel = '%2fsearch%2f';
    </script>
@endsection
@section('js')
    @include('expert.Js-list')
@endsection
@section('content')
    <div class="detail__section page-default">
        <div class="container">
            <div class="box-category-top">
                <h1 class="box-category-title">
                    Kết quả tìm kiếm: {{$keywords ?? ''}}
                </h1>
                @if(!empty($total))
                    <span class="kq">Có {{$total}} kết quả</span>
                @else
                    <span class="kq">Không có gì hiển thị</span>
                @endif
            </div>
            <div class="detail__sflex-main">

                <div class="detail__sright">
                    <div class="box-careabout">
                        <div class="careabout-flex">
                            <div class="box-category" data-layout="3">
                                <div class="box-category-middle">
                                    <x-template::item-cate :listNews="$listNews"></x-template::item-cate>
                                    <div class="box-stream-item box-stream-item-load hidden"></div>
                                </div>
                                @if(!empty($total) && $total > 15 )
                                    <x-category.box-layout-loading/>
                                    <div class="box-center list__viewmore list__center">
                                        <a href="javascript:;" rel="nofollow" class="views" title="Xem thêm">Xem thêm</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="detail__sleft">
                    @include('components.category.box-ads-right')
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!! $ZoneInfoClientScript !!}
    </div>
@endsection
