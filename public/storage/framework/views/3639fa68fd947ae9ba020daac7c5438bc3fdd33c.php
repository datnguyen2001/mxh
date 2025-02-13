    <meta name="description" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta name="keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">
    <meta name="news_keywords" content="<?php echo $__env->yieldContent('keywords'); ?>">
    <meta property="og:title" content="<?php echo $__env->yieldContent('title'); ?>">
    <meta property="og:description" content="<?php echo $__env->yieldContent('description'); ?>">
    <meta property="og:type" content="article" />
    <meta property="og:url" content="<?php echo $__env->yieldContent('OgUrl'); ?>" />
<?php if(View::hasSection('OgImage')): ?>
    <meta property="og:image" content="<?php echo $__env->yieldContent('OgImage'); ?>" />
    <meta property="og:image:type" content="image/jpg" />
    <meta property="og:image:width" content="600" />
    <meta property="og:image:height" content="315" />
<?php else: ?>
    <meta property="og:image" content="<?php echo $__env->yieldContent('OgImage'); ?>" />
<?php endif; ?>
    <meta property="twitter:image" content="<?php echo $__env->yieldContent('OgImage'); ?>" />
    <meta property="twitter:card" content="summary_large_image" />
<?php if(View::hasSection('Canonical')): ?>
    <link rel="canonical" href="<?php echo $__env->yieldContent('Canonical'); ?>" />
<?php else: ?>
    <link rel="canonical" href="<?php echo $__env->yieldContent('OgUrl'); ?>"/>
<?php if(View::hasSection('Link-rss')): ?>
    <link rel="alternate" type="application/rss+xml" href="<?php echo $__env->yieldContent('Link-rss'); ?>" title="<?php echo $__env->yieldContent('og-title'); ?>"/>
<?php endif; ?>
<?php endif; ?>
<?php if(!empty(config('siteInfo.alternateMob'))): ?>
    <link  rel="alternate" media="only screen and (max-width: 640px)"  href="<?php echo e(config('siteInfo.alternateMob').Request::getPathInfo()); ?>" />
    <link rel="alternate" media="handheld" href="<?php echo e(config('siteInfo.alternateMob').Request::getPathInfo()); ?>" />
<?php endif; ?>
<?php if(!empty(config('siteInfo.fb_appid'))): ?>
    <meta prefix="fb: http://ogp.me/ns/fb#" property="fb:app_id" content="<?php echo e(config('siteInfo.fb_appid')); ?>" />
<?php endif; ?>
<?php if(!empty(config('siteInfo.google_site_verification'))): ?>
    <meta name="google-site-verification" content="<?php echo e(config('siteInfo.google_site_verification')); ?>" />
<?php endif; ?>
    <?php if(View::hasSection('published_time')): ?>
        <meta property="article:published_time" content="<?php echo $__env->yieldContent('published_time'); ?>" />
    <?php endif; ?>
    <?php if(View::hasSection('article_author')): ?>
        <meta property="article:author" content="<?php echo $__env->yieldContent('article_author'); ?>" />
    <?php endif; ?>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/layout/shared/meta-seo.blade.php ENDPATH**/ ?>