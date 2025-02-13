<!DOCTYPE html>
<html lang="vi">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    














    <link rel="dns-prefetch" href="https://static.mediacdn.vn/">
    <link rel="dns-prefetch" href="<?php echo e(env('THUMB_DOMAIN')); ?>">
    <link rel="dns-prefetch" href="https://videothumbs.mediacdn.vn/">
    <link rel="dns-prefetch" href="https://videothumbs-ext.mediacdn.vn/">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/glightbox/dist/css/glightbox.min.css">
    <link rel="stylesheet" href="<?php echo e(asset('css/style.css')); ?>">

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
<script>
    function openGlightbox() {
        const hiddenImages = document.querySelectorAll('#hidden-images a');
        if (hiddenImages.length > 0) {
            hiddenImages[0].click();
        }
    }

    const lightbox = GLightbox({ selector: '.glightbox' });

    var swiper = new Swiper(".mySwiperPost", {
        loop: true,
        spaceBetween: 10,
        slidesPerView: 4.4,
        freeMode: true,
        watchSlidesProgress: true,
        breakpoints: {
            1024: {
                slidesPerView: 4.4,
            },
            768: {
                slidesPerView: 3.5,
            },
            0: {
                slidesPerView: 3.5,
            }
        }
    });
    var swiper2 = new Swiper(".mySwiperPost2", {
        loop: true,
        spaceBetween: 10,
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev",
        },
        thumbs: {
            swiper: swiper,
        },
    });
    var swipers = new Swiper(".mySwiper", {
        slidesPerView: 4,
        spaceBetween: 16,
        breakpoints: {
            1024: {
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 3.3,
            },
            0: {
                slidesPerView: 2.5,
                spaceBetween: 8,
            }
        }
    });
    var mySwiperMarket = new Swiper(".mySwiperMarket", {
        slidesPerView: 4,
        spaceBetween: 6,
        navigation: {
            nextEl: ".swiper-market-button-next",
            prevEl: ".swiper-market-button-prev",
        },
        breakpoints: {
            1024:{
                slidesPerView: 4,
            },
            768: {
                slidesPerView: 3,
            },
            0: {
                slidesPerView: 2.5,
            }
        }
    });
    function shareToFacebook(event,postUrl) {
        event.preventDefault();
        const url = encodeURIComponent(postUrl);
        window.open(`https://www.facebook.com/sharer/sharer.php?u=${url}`, '_blank');
    }
</script>
<script>
    function toggleRelatedPosts(postId) {
        let relatedPosts = document.getElementById(`related-posts-${postId}`);
        let toggleButton = document.querySelector(`.item-icon-function-post[onclick="toggleRelatedPosts(${postId})"] img`);

        if (relatedPosts.style.display === "block") {
            relatedPosts.style.display = "none";
            toggleButton.src = "<?php echo e(asset('image/icon-arrow-down.png')); ?>";
        } else {
            relatedPosts.style.display = "block";
            toggleButton.src = "<?php echo e(asset('image/icon-arrow-up.png')); ?>";
        }
    }
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