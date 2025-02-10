<!-- GOOGLE SEARCH STRUCTURED DATA FOR ARTICLE -->
<script type="application/ld+json">
{
"@context": "https://schema.org",
  "@type": "VideoObject",
  "name": "{{!empty($videoFocus->Name)?$videoFocus->Name:''}}",
  "description": "{{!empty($videoFocus->Description)?$videoFocus->Description:''}}",
  "@id": "{{config('siteInfo.site_path').Request::getPathInfo()}}",
  "thumbnailUrl": "{{(!empty($videoFocus->Avatar))?UserInterfaceHelper::formatThumbZoomVideo($videoFocus->Avatar,700,438):''}}",

 "uploadDate": "{{!empty($videoFocus->CreatedDate)?$videoFocus->CreatedDate:''}}",
  "author": {
    "@type": "Person",
    "name": "{{!empty($videoFocus->Author)?$videoFocus->Author:''}}"
    },
  "duration": "PT1M54S",
  "contentUrl": "{{config('siteInfo.site_path').Request::getPathInfo()}}",
  "embedUrl": "{{config('siteInfo.site_path').Request::getPathInfo()}}"
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
        },{
            "@type": "ListItem",
            "position": 2,
            "item": {
                "@id": "{{config('siteInfo.site_path').(!empty($zoneDetail->ZoneUrl))?$zoneDetail->ZoneUrl:''}}",
                "name": "{{(!empty($zoneDetail->Name))?$zoneDetail->Name:''}}"
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
    @if(!empty($zoneInfo->ParentUrl))
    var _ADM_Channel = '%2fvideo%2f{{!empty($zoneInfo->ParentUrl)?$zoneInfo->ParentUrl:$zoneInfo->Url}}%2f{{!empty($zoneInfo->ParentUrl)?$zoneInfo->Url:''}}%2fdetail%2f';
    @else
    var _ADM_Channel = '%2fvideo%2f{{$zoneInfo->Url??''}}%2fdetail%2f';
    @endif
</script>

