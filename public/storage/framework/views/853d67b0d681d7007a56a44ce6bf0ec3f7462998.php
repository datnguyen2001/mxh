    <!-- GOOGLE SEARCH STRUCTURED DATA FOR ARTICLE -->
    <script type="application/ld+json">
      {
        "@context" : "http://schema.org",
        "@type": "WebSite",
        "name":"<?php echo e(Config::get('metapage.Home.title')); ?>",
        "alternateName": "<?php echo e(Config::get('metapage.Home.description')); ?>",
        "url":"<?php echo e(Config::get('siteInfo.url')); ?>"
      }
    </script>
    <script type="application/ld+json">
        {
        "@context": "http://schema.org",
        "@type": "Organization",
        "name":"<?php echo e(Config::get('siteInfo.site_name')); ?>",
        "url": "<?php echo e(Config::get('siteInfo.url')); ?>",
         "logo": "<?php echo e(Config::get('siteInfo.logo')); ?>",
        "email": "mailto: <?php echo e(Config::get('siteInfo.email')); ?>",
        "sameAs":[
        <?php if(!empty(Config::get('siteInfo.facebook'))): ?>
                "<?php echo e(Config::get('siteInfo.facebook')); ?>"
        <?php endif; ?>
            <?php if(!empty(Config::get('siteInfo.youtube'))): ?>
            ,"<?php echo e(Config::get('siteInfo.youtube')); ?>"
        <?php endif; ?>
            <?php if(!empty(Config::get('siteInfo.twitter'))): ?>
            ,"<?php echo e(Config::get('siteInfo.twitter')); ?>"
         <?php endif; ?>
            ],
            "contactPoint": [{
                "@type": "ContactPoint",
                "telephone": "<?php echo e(Config::get('siteInfo.phone')); ?>",
        "contactType": "customer service"
        }],
        "address": {
            "@type": "PostalAddress",
            "addressLocality": "<?php echo e(Config::get('siteInfo.district')); ?>",
            "addressRegion": "<?php echo e(Config::get('siteInfo.city')); ?>",
            "addressCountry": "<?php echo e(Config::get('siteInfo.country')); ?>",
            "postalCode":"<?php echo e(Config::get('siteInfo.postal_code')); ?>",
            "streetAddress": "<?php echo e(Config::get('siteInfo.street_address')); ?>"
            }
        }
    </script>
    <script type="text/javascript">var _ADM_Channel = '%2fhome%2f';</script>





<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/schema/SchemaHome.blade.php ENDPATH**/ ?>