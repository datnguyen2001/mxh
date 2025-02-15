<div class="header__new">
    <div class="header__content page__content">
        <img src="<?php echo e(asset('image/logo.png')); ?>" alt="" class="img-logo">
        <div class="box-content-link">
            <div class="header__content-center">
                <div class="header__content-center-left">
                    <a href="#" class="link-menu-header link-menu-header-active">
                        <img src="<?php echo e(asset('image/icon-home.png')); ?>" alt="">
                    </a>
                    <a href="#" class="link-menu-header">
                        <img src="<?php echo e(asset('image/icon-video.png')); ?>" alt="">
                    </a>
                    <a href="#" class="link-menu-header">
                        <img src="<?php echo e(asset('image/icon-layout.png')); ?>" alt="">
                    </a>
                    <a href="#" class="link-menu-header">
                        <img src="<?php echo e(asset('image/icon-cart.png')); ?>" alt="">
                    </a>
                    <a href="#" class="link-menu-header">
                        <img src="<?php echo e(asset('image/icon-setting-people.png')); ?>" alt="">
                    </a>
                </div>
                <div class="header__content-center-right">
                    <a href="#" class="link-login-header">
                        <img src="<?php echo e(asset('image/icon-fb.png')); ?>" alt="">
                    </a>
                    <a href="#" class="link-login-header">
                        <img src="<?php echo e(asset('image/icon-x.png')); ?>" alt="">
                    </a>
                </div>
            </div>
            <div class="header__content-right">
                <div class="header__search-box">
                    <img src="<?php echo e(asset('image/icon-search.png')); ?>" alt="" class="icon-box-search">
                    <input type="text" class="input-header-search" placeholder="Tìm kiếm">
                </div>
                <div class="header__search-box-tablet">
                    <img src="<?php echo e(asset('image/icon-search.png')); ?>" alt="" class="icon-box-search">
                </div>
                <div class="box-noti-header">
                    <img src="<?php echo e(asset('image/icon-noti.png')); ?>" alt="" class="header-icon-bell">
                </div>
                <div id="head_islogin">
                    <a href="javascript:;" class="box-account-header" id="head_login">
                        <img src="<?php echo e(asset('image/avatar-user-df.png')); ?>" alt="" class="header-icon-user">
                    </a>
                    <div class="header__profile" style="min-width: 225px;">
                        <div class="header__profile--v2">
                            <p class="header__profile--title">Xin chào, <span class="header__profile--title h_name">User name</span>
                            </p>
                            <a href="#" class="header__profile--option" title="Tài khoản của tôi">Tài khoản của tôi</a>
                            <a href="javascript:;" class="header__profile--option" id="head_logout" rel="nofollow">Đăng xuất</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>

<div class="header__new-mobile">
    <div class="header__new-mobile-top">
        <img src="<?php echo e(asset('image/search-header-mobile.png')); ?>" alt="" class="icon-search-header-mobile">
        <img src="<?php echo e(asset('image/logo-mobile.png')); ?>" alt="" class="icon-logo-header-mobile">
        <img src="<?php echo e(asset('image/tab-header-mobile.png')); ?>" alt="" class="icon-tab-header-mobile">
    </div>
    <div class="header__new-mobile-bottom">
        <a href="#" class="link-menu-header-mobile">
            <img src="<?php echo e(asset('image/icon-home.png')); ?>" alt="">
        </a>
        <a href="#" class="link-menu-header-mobile">
            <img src="<?php echo e(asset('image/icon-video.png')); ?>" alt="">
        </a>
        <a href="#" class="link-menu-header-mobile">
            <img src="<?php echo e(asset('image/icon-layout.png')); ?>" alt="">
        </a>
        <a href="#" class="link-menu-header-mobile">
            <img src="<?php echo e(asset('image/icon-cart.png')); ?>" alt="">
        </a>
        <a href="#" class="link-menu-header-mobile">
            <img src="<?php echo e(asset('image/icon-setting-people.png')); ?>" alt="">
        </a>
        <a href="#" class="link-menu-header-mobile">
            <img src="<?php echo e(asset('image/bell-mobile.png')); ?>" alt="">
        </a>
        <a href="#" class="link-menu-header-mobile link-menu-header-mobile-end">
            <div class="link-menu-header-mobile-item">
                <img src="<?php echo e(asset('image/icon-user-mobile.png')); ?>" alt="">
            </div>
        </a>
    </div>
</div>

<div class="mobile-menu">
    <div class="mobile-menu-content">
        <div class="header__search-box">
            <img src="<?php echo e(asset('image/icon-search.png')); ?>" alt="" class="icon-box-search">
            <input type="text" class="input-header-search" placeholder="Tìm kiếm">
        </div>
    </div>
    <?php echo $__env->make('layout.footer2', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
</div>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/layout/header2.blade.php ENDPATH**/ ?>