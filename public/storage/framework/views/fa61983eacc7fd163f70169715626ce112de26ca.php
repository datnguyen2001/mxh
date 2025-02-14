<!DOCTYPE html>
<html lang="vi">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    














    <meta name="asset-url" content="<?php echo e(asset('')); ?>">
    <link rel="dns-prefetch" href="https://static.mediacdn.vn/">
    <link rel="dns-prefetch" href="<?php echo e(env('THUMB_DOMAIN')); ?>">
    <link rel="dns-prefetch" href="https://videothumbs.mediacdn.vn/">
    <link rel="dns-prefetch" href="https://videothumbs-ext.mediacdn.vn/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

    <?php echo $__env->make('layout.shared.page-config', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <?php echo $__env->yieldContent('css'); ?>
    <style>
        .box-ad-tnv{
            margin-bottom: 20px;
        }
        .mb-20{
            margin-bottom: 20px;
        }
        .mt-20{
            margin-top: 20px;
        }
        .mt-10{
            margin-top: 10px;
        }
        .tn-banner img{
            height: auto;
            margin: auto;
        }
        .mw-300{
            max-width: 300px;
        }
        .ft-nguon{
            float: right;
            position: relative;
            top: -20px;
            text-align: center;
        }
        video.lozad-video {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            bottom: 0;
            margin: auto;
            background-size: cover;
            background-position: center;
            object-fit: cover;
        }
        .kbwscwl-relatedbox.type-8.autopro,a[href="https://www.facebook.com/autoprovn"]
        {
            display: none !important;
        }
        .header__menu .flex-menu .item-menu-expan .child-menu-hover {
            min-width: 150px;
            width: max-content;
        }
    </style>
</head>
<body>
<div id="admWrapsite">



    <?php echo $__env->make('layout.header2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    <div class="main">
        <?php echo $__env->yieldContent('content'); ?>
    </div>
    <?php echo $__env->make('layout.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
















    <div id="backToTop" class="back-to-top">
        <img src="<?php echo e(asset('image/arrow-top-page.png')); ?>" alt="">
    </div>
</div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"></script>
<script src="https://cdn.jsdelivr.net/npm/glightbox/dist/js/glightbox.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js"></script>

<?php echo $__env->yieldContent('js'); ?>
<?php echo $__env->make('expert.Js-login', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
<script>
    $(document).ready(function () {
        const backToTop = $('#backToTop');

        $(window).scroll(function () {
            if ($(this).scrollTop() > 300) {
                backToTop.addClass('show');
            } else {
                backToTop.removeClass('show');
            }
        });

        backToTop.click(function () {
            $('html, body').animate({ scrollTop: 0 }, 500);
        });
    });
</script>

</body>
</html>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/layout/master.blade.php ENDPATH**/ ?>