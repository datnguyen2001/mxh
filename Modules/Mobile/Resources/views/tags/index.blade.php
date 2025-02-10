@extends('mobile::layout.master')
@section('title'){{!empty($tagInfo->TagTitle)?$tagInfo->TagTitle:sprintf(config('metapage.Tags.title'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('description'){{!empty($tagInfo->TagInit)?$tagInfo->TagInit:sprintf(config('metapage.Tags.description'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('keywords'){{!empty($tagInfo->TagMetaKeyword)?$tagInfo->TagMetaKeyword:sprintf(config('metapage.Tags.keywords'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('news_keywords'){{!empty($tagInfo->TagMetaKeyword)?$tagInfo->TagMetaKeyword:sprintf(config('metapage.Tags.keywords'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('og-title'){{!empty($tagInfo->TagTitle)?$tagInfo->TagTitle:sprintf(config('metapage.Tags.title'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('og-description'){{!empty($tagInfo->TagInit)?$tagInfo->TagInit:sprintf(config('metapage.Tags.description'),$tagInfo->Name??$shortURL,$tagInfo->Name??$shortURL)}}@endsection
@section('OgImage'){{(!empty($tagInfo->Avatar))?UserInterfaceHelper::formatThumbZoom($tagInfo->Avatar,600,315):config('siteInfo.default_share')}}@endsection
@section('css')
    @include('mobile::expert.Css-list')
    @if(!empty($tagInfo))
        @include('schema.SchemaTags')
    @endif
@endsection
@section('js')
    @include('mobile::expert.Js-list')
@endsection
@section('content')
    <div class="list__menu page-default">
        <div class="container">
            <div class="box-list-menu">
                <h1 class="title-cate">
                    {{(!empty($tagInfo->Name)?$tagInfo->Name:$shortURL ?? '')}}
                </h1>
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
                                    <x-slot name="headingTitleTag">h2</x-slot>
                                </x-layout::box-category-item>
                            @endforeach
                        @endif
                        <div class="box-stream-item box-stream-item-load hidden"></div>
                    </div>
                    @if(!empty($listNews) && count($listNews) == 15)
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
        {!! $ZoneInfoClientScript !!}
    </div>
@endsection
