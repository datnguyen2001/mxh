<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type": "WebSite",
    "name":"{{(!empty($threadInfo->Name))?$threadInfo->Name:''}}",
    "alternateName": "{{(!empty($threadInfo->MetaDescription))?$threadInfo->MetaDescription:$threadInfo->Description??''}}",
    "url":"{{config('siteInfo.site_path').Request::getPathInfo()}}"
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
            "@id": "{{config('siteInfo.site_path').Request::getPathInfo()}}",
            "name": "{{$threadInfo->Name??''}}"
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
    var _ADM_Channel = '%2fsu-kien%2f{{$threadInfo->Url??''}}%2f';
</script>





