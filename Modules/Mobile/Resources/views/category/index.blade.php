@extends('mobile::layout.master')
@section('title'){{(!empty($zoneInfo->MetaName))?$zoneInfo->MetaName:(!empty(config('metapage.Category.'.$zoneInfo->ShortURL.'.title'))?config('metapage.Category.'.$zoneInfo->ShortURL.'.title'):$zoneInfo->Name)}}@endsection
@section('description'){{(!empty($zoneInfo->MetaDescription))?$zoneInfo->MetaDescription:config('metapage.Category.'.$zoneInfo->ShortURL.'.description')}}@endsection
@section('keywords'){{(!empty($zoneInfo->MetaKeyword))?$zoneInfo->MetaKeyword:config('metapage.Category.'.$zoneInfo->ShortURL.'.keywords')}}@endsection
@section('og-title'){{(!empty($zoneInfo->MetaName))?$zoneInfo->MetaName:config('metapage.Category.'.$zoneInfo->ShortURL.'.title')}}@endsection
@section('og-description'){{(!empty($zoneInfo->MetaDescription))?$zoneInfo->MetaDescription:config('metapage.Category.'.$zoneInfo->ShortURL.'.description')}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{(!empty($zoneInfo->Avatar))?UserInterfaceHelper::formatThumbZoom($zoneInfo->Avatar,600,315):''}}@endsection
@section('Link-rss'){{config('siteInfo.site_path').'/rss'.str_replace('.htm','.rss',$zoneInfo->ZoneUrl??'')}}@endsection
@section('css')
    @if(!empty($listFocus))
        @foreach($listFocus as $item)<link rel="preload" href="{!! $item->ThumbImage !!}" as="image" fetchpriority="high">@endforeach
    @endif
    @include('mobile::expert.Css-list')
    <style>
        .container .box-category .box-category-middle .box-category-item .box-category-category{
            display: none;
        }
    </style>
    @if(!empty($zoneInfo))
        @include('schema.SchemaCat')
    @endif
@endsection
@section('js')
    @include('mobile::expert.Js-list')
@endsection
@section('content')
    @include('mobile::components.category.box-breadcrumb')
    <div class="home__focus-hm mb-32">
        <div class="container">
            <div class="box-focus">
                <div class="box-category" data-layout="1" >
                    <div class="box-category-middle">
                        <div data-cd-key="{{config('siteInfo.SITE_ID')}}newsposition:zoneid{{$zoneInfo->Id??''}}type3;{{config('siteInfo.SITE_ID') }}newsinzone:zoneid{{$zoneInfo->Id??''}}" data-cd-top="3">
                        @if (!empty($listFocus))
                            @foreach ($listFocus as $key => $item)
                                <x-layout::box-category-item :dataItem="$item">
                                    <x-slot name="noLazy">true</x-slot>
                                    <x-slot name="noTime">true</x-slot>
                                    <x-slot name="noSapo">true</x-slot>
                                    <x-slot name="fetchpriority"></x-slot>
                                    <x-slot name="headingTitleTag">h2</x-slot>
                                    <x-slot name="hasCategory">true</x-slot>
                                </x-layout::box-category-item>
                            @endforeach
                        @endif
                         @if(!empty($listNews))
                            @foreach ($listNews as $key => $item)
                                <x-layout::box-category-item :dataItem="$item">
                                    <x-slot name="trimLineTitle">4</x-slot>
                                    <x-slot name="noTime">true</x-slot>
                                    <x-slot name="noSapo">true</x-slot>
                                    <x-slot name="hasCategory">true</x-slot>
                                </x-layout::box-category-item>
                            @endforeach
                        @endif
                            <div class="box-stream-item box-stream-item-load hidden"></div>
                        </div>
                    </div>
                    @if(!empty($listNews) && count($listNews)>5)
                    <x-category.box-layout-loading/>
                    <div class="list__viewmore list__center" style="display: block;">
                        <a href="javascript:;" rel="nofollow" class="see-more" title="Xem thêm">Xem thêm</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div id="insert-cate-sidebar"></div>
    <div class="configHidden">
        {!!$ZoneInfoClientScript!!}
    </div>
@endsection
