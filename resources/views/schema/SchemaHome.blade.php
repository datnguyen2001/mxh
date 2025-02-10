    <!-- GOOGLE SEARCH STRUCTURED DATA FOR ARTICLE -->
    <script type="application/ld+json">
      {
        "@context" : "http://schema.org",
        "@type": "WebSite",
        "name":"{{Config::get('metapage.Home.title')}}",
        "alternateName": "{{Config::get('metapage.Home.description')}}",
        "url":"{{Config::get('siteInfo.url')}}"
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
    <script type="text/javascript">var _ADM_Channel = '%2fhome%2f';</script>





