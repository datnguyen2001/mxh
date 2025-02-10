<script type="application/ld+json">
{
    "@context" : "http://schema.org",
    "@type": "WebSite",
    "name":"{{config('metapage.Media.title')}}",
    "alternateName": "{{config('metapage.Media.description')}}",
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
            "name": "{{config('metapage.Media.title')}}"
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
        "{{Config::get('siteInfo.facebook')}}",
        "{{Config::get('siteInfo.youtube')}}",
        "{{Config::get('siteInfo.twitter')}}"],

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
