<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box-page page__content">
        <?php echo $__env->make('components.template.page-left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box-page-center">

            
            <?php echo $__env->make('components.template.box-market', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

            <div class="box-content-page-home-center">
                
               <?php echo $__env->make('components.template.create-post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                
                <?php if(!empty($homePost)): ?>
                    <?php $__currentLoopData = $homePost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                        <?php
                            $tags = explode(';', $item->TagItem ?? '');
                            $firstTag = trim($tags[0]);
                        ?>
                        <?php echo $__env->make('components.template.item-post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                        <?php if($loop->iteration == 5): ?>
                            
                            <?php echo $__env->make('components.template.gold-foreign-currency', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                            
                            <div class="box-ads">
                                ADS
                            </div>
                        <?php endif; ?>

                        <?php if($loop->iteration == 10): ?>
                            
                            <?php echo $__env->make('components.template.commodity-prices', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                        <?php if($loop->iteration == 13): ?>
                            
                            <?php echo $__env->make('components.template.ask-questions', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
                        <?php endif; ?>

                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                <?php endif; ?>

                
                <div class="box-post-full">
                    <div class="box-item-post">
                        <div class="item-post-header">
                            <div class="item-post-header-left">
                                <img
                                    src="https://cafefcdn.com/zoom/223_140/203337114487263232/2025/2/10/avatar1739150004879-17391500062121899815776-0-0-599-959-crop-17391500382041042859264.png"
                                    alt="" loading="lazy" class="avatar-user-post">
                                <div class="box-infor-user-post">
                                    <div class="line-name-user-post">
                                        <span class="name-user-post">Ngọc châu</span>
                                        <img src="<?php echo e(asset('image/icon-tick.png')); ?>" loading="lazy" alt="" class="icon-tick-xanh">
                                    </div>
                                    <div class="line-bottom-header-post">
                                        <span class="title-date-header-post">21/08/2023</span><span
                                            class="title-date-header-post">.</span><span class="title-tap-post">KINH DOANH</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item-post-header-right">
                                <img src="<?php echo e(asset('image/icon-star.png')); ?>" loading="lazy" alt="" class="icon-star-post">
                                <img src="<?php echo e(asset('image/icon-more.png')); ?>" loading="lazy" alt="" class="icon-more-post">
                            </div>
                        </div>
                        <div class="item-post-content">
                            <p class="name-post">Tỷ phú Mukesh Ambani muốn xây dựng siêu ứng dụng tài chính tại Ấn
                                Độ</p>
                            <p class="describe-post">Trong nhiều năm, USD là đồng tiền chủ đạo trong thương mại quốc tế.
                                Tuy nhiên, gần đây, đã có các cuộc thảo luận về phát triển loại tiền tệ mới để thay thế
                                đồng USD và thách thức quyền bá chủ của đồng bạc xanh của Mỹ.</p>
                            <div class="box-img-post">
                                <div class="swiper mySwiperPost2">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide swiper-slide-big ">
                                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-3.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-4.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-5.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-6.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-7.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-8.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-9.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                        <div class="swiper-slide swiper-slide-big">
                                            <img src="https://swiperjs.com/demos/images/nature-10.jpg" loading="lazy"/>
                                            <div class="text-sapo-slide">
                                                Một người đàn ông trưng bày tờ 100 USD cùng với tiền Nigeria tại chợ thủ
                                                công và nghệ thuật ở Lagos, Nigeria. Ảnh AP
                                            </div>
                                        </div>
                                    </div>
                                    <div class="swiper-button-next swiper-button-next-post"></div>
                                    <div class="swiper-button-prev swiper-button-prev-post"></div>
                                </div>
                                <div class="swiper mySwiperPost">
                                    <div class="swiper-wrapper">
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-1.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-2.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-3.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-4.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-5.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-6.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-7.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-8.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-9.jpg" loading="lazy"/>
                                        </div>
                                        <div class="swiper-slide">
                                            <img src="https://swiperjs.com/demos/images/nature-10.jpg" loading="lazy"/>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="line-bottom-content-post">
                                <div class="line-bottom-content-post-left">
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-tim.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post">20</span>
                                    </div>
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-bl.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post">12</span>
                                    </div>
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-mat.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post">240</span>
                                    </div>
                                </div>
                                <div class="line-bottom-content-post-right">
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-cs.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post text-icon-function-post">Chia sẻ</span>
                                    </div>
                                    <div class="item-icon-function-post">
                                        <span class="title-icon-function-post">|</span>
                                    </div>
                                    <div class="item-icon-function-post" onclick="toggleRelatedPosts(1)">
                                        <span class="title-icon-function-post text-icon-function-post">Bài viết liên quan</span>
                                        <img src="<?php echo e(asset('image/icon-arrow-down.png')); ?>" loading="lazy" alt=""
                                             class="item-icon-bottom-post item-icon-bottom-post-mobile">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <div class="box-post-full">
                    <div class="box-item-post">
                        <div class="item-post-header">
                            <div class="item-post-header-left">
                                <img
                                    src="https://cafefcdn.com/zoom/223_140/203337114487263232/2025/2/10/avatar1739150004879-17391500062121899815776-0-0-599-959-crop-17391500382041042859264.png"
                                    alt="" loading="lazy" class="avatar-user-post">
                                <div class="box-infor-user-post">
                                    <div class="line-name-user-post">
                                        <span class="name-user-post">Ngọc châu</span>
                                        <img src="<?php echo e(asset('image/icon-tick.png')); ?>" loading="lazy" alt="" class="icon-tick-xanh">
                                    </div>
                                    <div class="line-bottom-header-post">
                                        <span class="title-date-header-post">21/08/2023</span><span
                                            class="title-date-header-post">.</span><span class="title-tap-post">KINH DOANH</span>
                                    </div>
                                </div>
                            </div>
                            <div class="item-post-header-right">
                                <img src="<?php echo e(asset('image/icon-star.png')); ?>" loading="lazy" alt="" class="icon-star-post">
                                <img src="<?php echo e(asset('image/icon-more.png')); ?>" loading="lazy" alt="" class="icon-more-post">
                            </div>
                        </div>
                        <div class="item-post-content">
                            <p class="name-post">Tỷ phú Mukesh Ambani muốn xây dựng siêu ứng dụng tài chính tại Ấn
                                Độ</p>
                            <p class="describe-post">Trong nhiều năm, USD là đồng tiền chủ đạo trong thương mại quốc tế.
                                Tuy nhiên, gần đây, đã có các cuộc thảo luận về phát triển loại tiền tệ mới để thay thế
                                đồng USD và thách thức quyền bá chủ của đồng bạc xanh của Mỹ.</p>
                            <div class="box-img-post">
                                <video autoplay muted loop playsinline
                                       poster="https://cafefcdn.com/zoom/223_140/203337114487263232/2025/2/10/avatar1739150004879-17391500062121899815776-0-0-599-959-crop-17391500382041042859264.png"
                                       src="https://samplelib.com/lib/preview/mp4/sample-5s.mp4"
                                       type="video/mp4"
                                       class="video-post">
                                </video>
                            </div>
                            <div class="line-bottom-content-post">
                                <div class="line-bottom-content-post-left">
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-tim.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post">20</span>
                                    </div>
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-bl.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post">12</span>
                                    </div>
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-mat.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post">240</span>
                                    </div>
                                </div>
                                <div class="line-bottom-content-post-right">
                                    <div class="item-icon-function-post">
                                        <img src="<?php echo e(asset('image/icon-cs.png')); ?>" loading="lazy" alt="" class="item-icon-bottom-post">
                                        <span class="title-icon-function-post text-icon-function-post">Chia sẻ</span>
                                    </div>
                                    <div class="item-icon-function-post">
                                        <span class="title-icon-function-post">|</span>
                                    </div>
                                    <div class="item-icon-function-post" onclick="toggleRelatedPosts(1)">
                                        <span class="title-icon-function-post text-icon-function-post">Bài viết liên quan</span>
                                        <img src="<?php echo e(asset('image/icon-arrow-down.png')); ?>" loading="lazy" alt=""
                                             class="item-icon-bottom-post item-icon-bottom-post-mobile">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                
                <?php echo $__env->make('components.template.economic-calendar', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                <div class="box-stream-item box-stream-item-load"></div>
                <div class="list__viewmore"></div>

            </div>

        </div>
        <?php echo $__env->make('components.template.page-right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>

    
    <div class="modal-background">
        <div class="modal-background1 close-popup">
        </div>
        <div class="home_popup" id="contactform">
            <p class="home_popup-title">THÔNG TIN CÂU HỎI</p>
            <input type="email" class="home_popup-email femail" id="email" type="email" maxlength="150" required placeholder="Email của bạn">
            <textarea name="" id="" cols="30" rows="10" class="home_popup-ques fcontent" placeholder="Nội dung câu hỏi"></textarea>
            <div class="row">
                <div class="two-col">
                    <div class="col">
                        <input class="btn fcaptcha" name="captcha" type="text" placeholder="Mã xác nhận">
                    </div>
                    <div class="col">
                        <div class="cappcha">
                            <div class="image"><img loading="lazy" src="<?php echo e(env('DOMAIN_API')); ?>/capcha-sendqa.htm?c=1&siteid=174" alt="captcha" class="captcha-img" style="width: 100%; height: 100%"></div>
                            <a class="change-capcha" href="javascript:;" title="Captcha">
                                <svg width="17" height="22" viewBox="0 0 17 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path opacity="0.6" d="M8.5 2.27273V0.413348C8.5 0.246134 8.307 0.15275 8.17588 0.256522L5.04261 2.73633C4.63791 3.05663 4.63791 3.67065 5.04261 3.99094L8.17588 6.47075C8.307 6.57452 8.5 6.48114 8.5 6.31392V4.45455C12.0169 4.45455 14.875 7.38909 14.875 11C14.875 12.1018 14.6094 13.1491 14.1312 14.0545L15.147 15.0975C15.4192 15.3769 15.8821 15.3263 16.0576 14.978C16.6755 13.7519 17.0004 12.388 17 11C17 6.17818 13.1962 2.27273 8.5 2.27273ZM8.5 17.5455C4.98313 17.5455 2.125 14.6109 2.125 11C2.125 9.89818 2.39062 8.85091 2.86875 7.94545L1.85296 6.9025C1.58083 6.6231 1.11795 6.6737 0.94242 7.022C0.324488 8.24814 -0.000375859 9.61197 3.2634e-07 11C3.2634e-07 15.8218 3.80375 19.7273 8.5 19.7273V21.5867C8.5 21.7539 8.693 21.8472 8.82412 21.7435L11.9574 19.2637C12.3621 18.9434 12.3621 18.3294 11.9574 18.0091L8.82412 15.5293C8.693 15.4255 8.5 15.5189 8.5 15.6861V17.5455Z" fill="#777777"></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="home_popup-group">
                <button  class="home_popup-button submit" rel="nofollow" href="javascript:;">gửi</button>
                <button class="home_popup-button close-popup">đóng</button>
            </div>
        </div>
    </div>

    <div class="configHidden">
        <?php echo $ZoneInfoClientScript ?? ''; ?>

    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>

<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/home/index3.blade.php ENDPATH**/ ?>