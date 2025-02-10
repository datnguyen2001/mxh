@extends('mobile::layout.master')
@section('title'){{'Tìm kiếm bài viết'}}@endsection
@section('description'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('keywords'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('news_keywords'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('og-title'){{'Tìm kiếm bài viết'}}@endsection
@section('og-description'){{'kết quả tìm kiếm ' . $keywords}}@endsection
@section('Robots'){{'noindex, nofollow'}}@endsection
@section('css')
    @include('mobile::expert.Css-list')
    <script type="text/javascript">
        var _ADM_Channel = '%2fsearch%2f';
    </script>
@endsection
@section('js')
@include('mobile::expert.Js-list')
@endsection
@section('content')
    <div class="list__menu page-default">
        <div class="container">
            <div class="box-list-menu">
                <h1 class="title-cate">
                    Kết quả tìm kiếm: {{$keywords ?? ''}}
                </h1>
                @if(!empty($total))
                    <span class="kq">Có {{$total}} kết quả</span>
                @else
                    <span class="kq">Không có gì hiển thị</span>
                @endif
            </div>
        </div>
    </div>
    <div class="home__focus-hm mb-32 page-default">
        <div class="container">
            <div class="box-focus">
                <div class="box-category" data-layout="10" >
                    <div class="box-category-middle">
                        @if(!empty($listNews))
                            @foreach ($listNews as $key => $item)
                                <x-layout::box-category-item :dataItem="$item">
                                    <x-slot name="trimLineTitle">4</x-slot>
                                    <x-slot name="noTime">true</x-slot>
                                    <x-slot name="noSapo">true</x-slot>
                                </x-layout::box-category-item>
                            @endforeach
                        @endif
                        <div class="box-stream-item box-stream-item-load hidden"></div>
                    </div>
                    @if(!empty($total) && $total > 15 )
                        <x-category.box-layout-loading/>
                        <div class="list__viewmore list__center" style="display: block;">
                            <a href="javascript:;" rel="nofollow" class="see-more" title="Xem thêm">Xem thêm</a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
