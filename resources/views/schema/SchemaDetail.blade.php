<!-- GOOGLE SEARCH STRUCTURED DATA FOR ARTICLE -->
@if(!empty($zoneDetail->ShortURL) && $zoneDetail->ShortURL == 'tin-tong-hop')
    @section('Robots'){{'noindex, nofollow'}}@endsection
@endif
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "NewsArticle",
    "mainEntityOfPage":{
        "@type":"WebPage",
        "@id":"{{config('siteInfo.site_path').Request::getPathInfo()}}"
    },
    "headline": "{{htmlspecialchars(str_replace(['\\'],'',(!empty($newsContent->MetaTitle))?$newsContent->MetaTitle:$newsContent->Title), ENT_QUOTES, 'UTF-8')}}",
    "description": "{{ htmlspecialchars(str_replace(['\\'],'',(!empty($newsContent->MetaDescription))?$newsContent->MetaDescription:$newsContent->Sapo), ENT_QUOTES, 'UTF-8')}}",
    "image": {
        "@type": "ImageObject",
        "url": "{{(!empty($newsContent->Avatar))?UserInterfaceHelper::formatThumbZoom($newsContent->Avatar,700,438):''}}",
        "width" : 700,
        "height" : 438
    },
    "datePublished": "{{!empty($newsContent->DistributionDate)?date('Y-m-d\TH:i:s\+07:00',strtotime($newsContent->DistributionDate??'')):''}}",
    "dateModified": "{{!empty($newsContent->LastModifiedDate)?date('Y-m-d\TH:i:s\+07:00',strtotime($newsContent->LastModifiedDate??'')):''}}",
    "author": {
        "@type": "Person",
        "name": "{{!empty($newsContent->Author)?$newsContent->Author:''}}"
    },
    "publisher": {
        "@type": "Organization",
        "name": "{{config('siteInfo.site_path')}}",
        "logo": {
            "@type": "ImageObject",
           "url": "{{config('siteInfo.faviconDetail')}}",
            "width": 70,
            "height": 70
        }
    }
}
</script>
<!-- GOOGLE BREADCRUMB STRUCTURED DATA -->
<script type="application/ld+json">
{
    "@context": "http://schema.org",
    "@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@type": "ListItem",
            "position": 1,
            "item": {
                "@id": "{{config('siteInfo.site_path')}}",
                "name": "Trang chủ"
            }
        }
      @if(!empty($zoneParentInfo->ZoneUrl) && !empty($zoneDetail->ZoneUrl) && $zoneParentInfo->ZoneUrl != $zoneDetail->ZoneUrl )
    ,{
       "@type": "ListItem",
       "position": 2,
       "item": {
           "@id": "{{config('siteInfo.site_path').($zoneParentInfo->ZoneUrl??'')}}",
                "name": "{{$zoneParentInfo->Name??''}}"
            }
        }
        @endif
        ,{
        "@type": "ListItem",
        "position":{{!empty($zoneDetail->ParentShortUrl)?3:2}},
            "item": {
                "@id": "{{config('siteInfo.site_path').($zoneDetail->ZoneUrl??'')}}",
                "name": "{{$zoneDetail->Name??''}}"
            }
        }
    ]
}
</script>
<script type="application/ld+json">
        {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name":"{{Config::get('siteInfo.site_name')}}",
        "url": "{{Config::get('siteInfo.url')}}",
         "logo": "{{Config::get('siteInfo.logo')}}",
        "email": "mailto: {{Config::get('siteInfo.email')}}",
        "sameAs":[
        @if(!empty(Config::get('siteInfo.facebook')))
        "{{Config::get('siteInfo.facebook')}}"
        @endif
    @if(!empty(Config::get('siteInfo.youtube')))
        ,"{{Config::get('siteInfo.youtube')}}"
        @endif
    @if(!empty(Config::get('siteInfo.twitter')))
        ,"{{Config::get('siteInfo.twitter')}}"
         @endif
    ],
    "contactPoint": [{
        "@type": "ContactPoint",
        "telephone": "{{Config::get('siteInfo.phone')}}",
        "contactType": "customer service"
        }],
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "{{Config::get('siteInfo.district')}}",
            "addressRegion": "{{Config::get('siteInfo.city')}}",
            "addressCountry": "{{Config::get('siteInfo.country')}}",
            "postalCode":"{{Config::get('siteInfo.postal_code')}}",
            "streetAddress": "{{Config::get('siteInfo.street_address')}}"
            }
        }
</script>
<script type="text/javascript">
    @if(!empty($zoneDetail->ParentShortUrl))
    var _ADM_Channel = '%2f{{!empty($zoneDetail->ParentShortUrl)?$zoneDetail->ParentShortUrl:$zoneDetail->ShortURL}}%2f{{!empty($zoneDetail->ParentShortUrl)?$zoneDetail->ShortURL:''}}%2fdetail%2f';
    @else
    var _ADM_Channel = '%2f{{$zoneDetail->ShortURL??''}}%2fdetail%2f';
    @endif
</script>

