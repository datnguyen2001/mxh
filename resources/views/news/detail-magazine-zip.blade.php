@extends('layout.master-magazine-zip')
@section('title'){{(!empty($newsContent->MetaTitle))?$newsContent->MetaTitle:$newsContent->Title ?? ''}}@endsection
@section('description'){{(!empty($newsContent->MetaDescription))?$newsContent->MetaDescription:strip_tags($newsContent->Sapo)??''}}@endsection
@section('keywords'){{(!empty($newsContent->MetaKeyword))?$newsContent->MetaKeyword:$newsContent->TagItem ?? ''}}@endsection
@section('og-title'){{(!empty($newsContent->Title))?$newsContent->Title:''}}@endsection
@section('og-description'){{(!empty($newsContent->Sapo))?strip_tags($newsContent->Sapo):''}}@endsection
@section('OgUrl'){{config('siteInfo.site_path').Request::getPathInfo()}}@endsection
@section('OgImage'){{(!empty($newsContent->OgImage))?UserInterfaceHelper::formatThumbZoom($newsContent->OgImage,600,315):config('siteInfo.default_share')}}@endsection
@section('published_time'){{!empty($newsContent->DistributionDate)?$newsContent->DistributionDate:''}}@endsection
@section('article_author'){{!empty($newsContent->Author)?$newsContent->Author:''}}@endsection
@if(!empty($newsContent->exclusivePostOtherSite))
@section('Canonical'){{$newsContent->exclusivePostOtherSite}}@endsection
@endif
@if(isset( $newsContent->noFollow ))
@section('Robots'){{'noindex, nofollow'}}@endsection
@endif
@section('css')
    @if(!empty($zoneDetail))
        @include('schema.SchemaDetail')
    @endif
    @if(!empty($styleHeader))
        {!! $styleHeader??'' !!}
    @endif
    {!! $linkCss??'' !!}
    {!! $jsHead??'' !!}
@endsection
@section('content')
    {!!  $newsContent->Body !!}
@endsection


