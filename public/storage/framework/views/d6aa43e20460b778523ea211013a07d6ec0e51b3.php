<?php $__env->startSection('css'); ?>

<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="box-page page__content">
        <?php echo $__env->make('components.template.page-left', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
        <div class="box-page-center">

            
            <div class="box-market">
                <div class="swiper mySwiperMarket">
                    <div class="swiper-wrapper swiper-wrapper-market">

                    </div>
                </div>
                <div class="box-next-prev-market">
                    <div class="swiper-market-button-prev">
                        <img src="<?php echo e(asset('image/icon-left-market.png')); ?>" loading="lazy" alt="">
                    </div>
                    <div class="swiper-market-button-next">
                        <img src="<?php echo e(asset('image/icon-right-market.png')); ?>" loading="lazy" alt="">
                    </div>
                </div>
            </div>

            <div class="box-content-page-home-center">
                
                <div class="box-create-post">
                    <div class="line-header-create-post">
                        <div class="line-header-create-post-info">
                            <img
                                src="https://cafefcdn.com/zoom/223_140/203337114487263232/2025/2/10/avatar1739150004879-17391500062121899815776-0-0-599-959-crop-17391500382041042859264.png"
                                alt="" loading="lazy" class="avatar-user-create-post">
                            <span class="name-info-user-create-post">Ngọc Châu</span>
                        </div>
                        <input type="text" placeholder="Bạn muốn chia sẻ điều gì?" onclick="expandPostBox()"
                               class="input-create-post">
                    </div>
                    <!-- Khi click vào, phần này sẽ hiển thị -->
                    <div class="expanded-post" id="expandedPost">
                        <textarea placeholder="Bạn muốn chia sẻ điều gì?" class="textarea-post"></textarea>
                        <div class="actions">
                            <div class="line-actions">
                                <img src="<?php echo e(asset('image/video-post.png')); ?>" loading="lazy" alt="" class="icon-actions">
                                <img src="<?php echo e(asset('image/img-post.png')); ?>" loading="lazy" alt="" class="icon-actions">
                            </div>
                            <button class="btn-create-post" onclick="submitPost()"><img
                                    src="<?php echo e(asset('image/icon-send.png')); ?>" loading="lazy" alt="">Đăng
                            </button>
                        </div>
                    </div>
                </div>

                
               <?php echo $__env->make('components.template.item-post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

                
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

                
                <div class="box-ads">
                    ADS
                </div>

                
                <div class="box-table-commodity-prices">
                    <div class="table-commodity-prices-header">
                        <img src="<?php echo e(asset('image/bg-stack.png')); ?>" loading="lazy" alt="" class="img-bg-stack">
                        <div class="line-header-stack">
                            <img src="<?php echo e(asset('image/icon-box-stack.png')); ?>" loading="lazy" alt="" class="icon-stack">
                            GIÁ CẢ HÀNG HÓA
                        </div>
                    </div>
                    <div class="table-commodity-prices-content">
                        <table>
                            <thead>
                            <tr>
                                <th class="col-content-1 text-right">LAST</th>
                                <th class="col-content-2">CHANGE</th>
                                <th class="col-content-3">%CHG</th>
                            </tr>
                            </thead>
                            <tbody class="body-table" id="body-table-commodity-price">

                            </tbody>
                        </table>
                    </div>
                </div>

                
                <div class="box-gold-foreign-currency">

                    <div class="box-table-gold-foreign-currency-item">
                        <div class="table-gold-header">
                            <img src="<?php echo e(asset('image/bg-coins.png')); ?>" loading="lazy" alt="" class="img-bg-stack">
                            <div class="line-header-gold">
                                <img src="<?php echo e(asset('image/icon-coins.png')); ?>" loading="lazy" alt="" class="icon-stack">
                                GIÁ VÀNG
                            </div>
                        </div>
                        <div class="table-gold-content">
                            <table>
                                <thead>
                                <tr>
                                    <th class="col-content-gold-1"></th>
                                    <th class="col-content-gold-2">MUA VÀO</th>
                                    <th class="col-content-gold-3">BÁN RA</th>
                                </tr>
                                </thead>
                                <tbody class="body-table" id="gold-price-table">

                                </tbody>
                            </table>
                        </div>
                    </div>

                    <div class="box-table-gold-foreign-currency-item">
                        <div class="table-gold-header">
                            <img src="<?php echo e(asset('image/bg-dollar.png')); ?>" loading="lazy" alt="" class="img-bg-stack">
                            <div class="line-header-gold">
                                <img src="<?php echo e(asset('image/icon-dollar.png')); ?>" loading="lazy" alt="" class="icon-stack">
                                NGOẠI TỆ
                            </div>
                        </div>
                        <div class="table-gold-content">
                            <table>
                                <thead>
                                <tr>
                                    <th class="col-content-gold-1"></th>
                                    <th class="col-content-gold-2">MUA VÀO</th>
                                    <th class="col-content-gold-3">BÁN RA</th>
                                </tr>
                                </thead>
                                <tbody class="body-table" id="body-table-foreign-currency">

                                </tbody>
                            </table>
                        </div>
                    </div>

                </div>

                
                <div class="box-table-commodity-prices box-table-economic-calendar">
                    <div class="table-commodity-prices-header">
                        <img src="<?php echo e(asset('image/bg-clock.png')); ?>" loading="lazy" alt="" class="img-bg-stack">
                        <div class="line-header-clock">
                            <div class="line-header-stack-content">
                                <img src="<?php echo e(asset('image/icon-bag.png')); ?>" loading="lazy" alt="" class="icon-stack">
                                LỊCH KINH TẾ
                            </div>
                            <div class="line-header-stack-content">
                                <img src="<?php echo e(asset('image/icon-clock.png')); ?>" loading="lazy" alt="" class="icon-clock-table">
                                <span class="title-clock-table">Thời gian hiện tại:</span>
                                <span class="name-clock-table">10:46</span>
                            </div>
                        </div>
                    </div>
                    <div class="table-commodity-prices-content table-kt-content">
                        <table>
                            <thead>
                            <tr>
                                <th class="col-content-kt-1">THỜI GIAN</th>
                                <th class="col-content-kt-2">TIỀN TỆ</th>
                                <th class="col-content-kt-3">SỰ KIỆN</th>
                                <th class="col-content-kt-4">THỰC TẾ</th>
                                <th class="col-content-kt-5">DỰ BÁO</th>
                                <th class="col-content-kt-6">TRƯỚC ĐÓ</th>
                            </tr>
                            </thead>
                            <tbody class="body-table">
                            <tr class="line-tap-table">
                                <td colspan="6">Các sự kiện kinh tế trọng điểm sắp tới</td>
                            </tr>
                            <tr>
                                <td class="col-content-kt-1">1 giờ 44 phút</td>
                                <td class="col-content-kt-2"><img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt=""
                                                                  class="icon-co"> <span class="name-price">USD</span>
                                </td>
                                <td class="col-content-kt-3">Giá Xuất Khẩu (Tháng trên tháng)</td>
                                <td class="positive col-content-kt-4">0.6%</td>
                                <td class="col-content-kt-5 col-content-kt-bold">0.5%</td>
                                <td class="col-content-kt-6 col-content-kt-bold">1,3%</td>
                            </tr>
                            <tr>
                                <td class="col-content-kt-1">1 giờ 44 phút</td>
                                <td class="col-content-kt-2"><img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt=""
                                                                  class="icon-co"> <span class="name-price">USD</span>
                                </td>
                                <td class="col-content-kt-3">Giá Xuất Khẩu (Tháng trên tháng)</td>
                                <td class="negative col-content-kt-4">2,310.0B</td>
                                <td class="col-content-kt-5 col-content-kt-bold">0.5%</td>
                                <td class="col-content-kt-6 col-content-kt-bold">1,3%</td>
                            </tr>

                            <tr class="line-tap-table">
                                <td colspan="6">Những Sự Kiện Kinh Tế Trọng Điểm Được Đăng Gần Đây</td>
                            </tr>
                            <tr>
                                <td class="col-content-kt-1">1 giờ 44 phút</td>
                                <td class="col-content-kt-2"><img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt=""
                                                                  class="icon-co"> <span class="name-price">USD</span>
                                </td>
                                <td class="col-content-kt-3">Giá Xuất Khẩu (Tháng trên tháng)</td>
                                <td class="positive col-content-kt-4">0.6%</td>
                                <td class="col-content-kt-5 col-content-kt-bold">0.5%</td>
                                <td class="col-content-kt-6 col-content-kt-bold">1,3%</td>
                            </tr>
                            <tr>
                                <td class="col-content-kt-1">1 giờ 44 phút</td>
                                <td class="col-content-kt-2"><img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt=""
                                                                  class="icon-co"> <span class="name-price">USD</span>
                                </td>
                                <td class="col-content-kt-3">Giá Xuất Khẩu (Tháng trên tháng)</td>
                                <td class="negative col-content-kt-4">2,310.0B</td>
                                <td class="col-content-kt-5 col-content-kt-bold">0.5%</td>
                                <td class="col-content-kt-6 col-content-kt-bold">1,3%</td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                
                <div class="box-table-commodity-prices box-table-commodity-prices-mobile">
                    <div class="table-commodity-prices-header">
                        <img src="<?php echo e(asset('image/bg-clock.png')); ?>" loading="lazy" alt="" class="img-bg-stack">
                        <div class="line-header-clock">
                            <div class="line-header-stack-content">
                                <img src="<?php echo e(asset('image/icon-bag.png')); ?>" loading="lazy" alt="" class="icon-stack">
                                LỊCH KINH TẾ
                            </div>
                            <div class="line-header-stack-content">
                                <img src="<?php echo e(asset('image/icon-clock.png')); ?>" loading="lazy" alt="" class="icon-clock-table">
                                <span class="name-clock-table">10:46</span>
                            </div>
                        </div>
                    </div>
                    <div class="table-commodity-prices-content table-kt-content">
                        <table>
                            <tbody class="body-table">
                            <tr class="line-tap-table">
                                <td colspan="6">Các sự kiện kinh tế trọng điểm sắp tới</td>
                            </tr>
                            <tr class="line-content-table-mobile">
                                <td class="col-content-kt-mobile-1" colspan="2">
                                    <span class="name-content-kt-mobile-1">1 giờ 44 phút</span>
                                    <div class="col-content-kt-2">
                                        <img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt="" class="icon-co">
                                        <span class="name-price">USD</span>
                                    </div>
                                </td>
                                <td class="col-content-kt-mobile-2" colspan="4">
                                    <div class="name-content-kt-mobile-2">Giá Xuất Khẩu (Tháng trên tháng)</div>
                                    <div class="line-content-table-mobile-item">
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Thức tế</span><span
                                                class="name-item-table-mobile-child negative">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Dự báo</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Trước đó</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="line-content-table-mobile">
                                <td class="col-content-kt-mobile-1" colspan="2">
                                    <span class="name-content-kt-mobile-1">1 giờ 44 phút</span>
                                    <div class="col-content-kt-2">
                                        <img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt="" class="icon-co">
                                        <span class="name-price">USD</span>
                                    </div>
                                </td>
                                <td class="col-content-kt-mobile-2" colspan="4">
                                    <div class="name-content-kt-mobile-2">Giá Xuất Khẩu (Tháng trên tháng)</div>
                                    <div class="line-content-table-mobile-item">
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Thức tế</span><span
                                                class="name-item-table-mobile-child positive">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Dự báo</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Trước đó</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="line-tap-table">
                                <td colspan="6">Những Sự Kiện Kinh Tế Trọng Điểm Được Đăng Gần Đây</td>
                            </tr>
                            <tr class="line-content-table-mobile">
                                <td class="col-content-kt-mobile-1" colspan="2">
                                    <span class="name-content-kt-mobile-1">1 giờ 44 phút</span>
                                    <div class="col-content-kt-2">
                                        <img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt="" class="icon-co">
                                        <span class="name-price">USD</span>
                                    </div>
                                </td>
                                <td class="col-content-kt-mobile-2" colspan="4">
                                    <div class="name-content-kt-mobile-2">Giá Xuất Khẩu (Tháng trên tháng)</div>
                                    <div class="line-content-table-mobile-item">
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Thức tế</span><span
                                                class="name-item-table-mobile-child negative">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Dự báo</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Trước đó</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                    </div>
                                </td>
                            </tr>
                            <tr class="line-content-table-mobile">
                                <td class="col-content-kt-mobile-1" colspan="2">
                                    <span class="name-content-kt-mobile-1">1 giờ 44 phút</span>
                                    <div class="col-content-kt-2">
                                        <img src="<?php echo e(asset('image/icon-my.png')); ?>" loading="lazy" alt="" class="icon-co">
                                        <span class="name-price">USD</span>
                                    </div>
                                </td>
                                <td class="col-content-kt-mobile-2" colspan="4">
                                    <div class="name-content-kt-mobile-2">Giá Xuất Khẩu (Tháng trên tháng)</div>
                                    <div class="line-content-table-mobile-item">
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Thức tế</span><span
                                                class="name-item-table-mobile-child positive">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Dự báo</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                        <div class="item-content-table-mobile-child"><span
                                                class="title-item-table-mobile-child">Trước đó</span><span
                                                class="name-item-table-mobile-child">0.6%</span></div>
                                    </div>
                                </td>
                            </tr>

                            </tbody>
                        </table>
                    </div>
                </div>

                
                <div class="box-ask-questions">
                    <div class="item-ask-questions">
                        <div class="header-item-ask-questions">
                            <img src="<?php echo e(asset('image/icon-hoi.png')); ?>" loading="lazy" alt="" class="icon-ask">
                            <span class="name-header-item-ask">Đặt câu hỏi cho chuyên gia</span>
                        </div>
                        <textarea name="" class="box-text-content" placeholder="Đặt câu hỏi"></textarea>
                        <div class="btn-send-ask">
                            <span>Gửi</span>
                            <img src="<?php echo e(asset('image/icon-right.png')); ?>" loading="lazy" alt="" class="icon-right-button">
                        </div>
                    </div>
                    <div class="item-ask-questions">
                        <div class="header-item-ask-questions">
                            <img src="<?php echo e(asset('image/icon-i.png')); ?>" loading="lazy" alt="" class="icon-ask">
                            <span class="name-header-item-ask">Thông tin doanh nghiệp</span>
                        </div>
                        <textarea name="" class="box-text-content" placeholder="Mã CK hoặc tên công ty"></textarea>
                        <div class="btn-send-ask">
                            <span>Tìm kiếm</span>
                            <img src="<?php echo e(asset('image/icon-right.png')); ?>" loading="lazy" alt="" class="icon-right-button">
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <?php echo $__env->make('components.template.page-right', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>
    </div>
<?php $__env->stopSection(); ?>
<?php $__env->startSection('js'); ?>
    <script>
        document.addEventListener("click", function (event) {
            let postBox = document.querySelector(".box-create-post");
            let inputCreatePost = document.querySelector(".input-create-post");
            let expandedPost = document.getElementById("expandedPost");

            // Kiểm tra xem click có nằm trong phần box-create-post không
            if (!postBox.contains(event.target)) {
                // Nếu click bên ngoài, ẩn expandedPost và hiển thị input lại
                expandedPost.style.display = "none";
                inputCreatePost.style.display = "block";
                document.querySelector('.name-info-user-create-post').style.display = "none";
            }
        });

        function expandPostBox() {
            document.querySelector('.input-create-post').style.display = 'none';
            document.getElementById('expandedPost').style.display = 'flex';
            document.querySelector('.name-info-user-create-post').style.display = 'inline-block';
        }

        function submitPost() {
            let content = document.querySelector('.expanded-post textarea').value;
            if (content.trim() !== '') {
                alert("Bài viết đã được đăng: " + content);
                document.querySelector('.expanded-post textarea').value = '';
            }
            // Ẩn lại phần mở rộng sau khi đăng bài
            document.getElementById('expandedPost').style.display = 'none';
            document.querySelector('.input-create-post').style.display = 'block';
            document.querySelector('.name-info-user-create-post').style.display = "none";
        }
    </script>
    <script>
        // chứng khoán
        $(document).ready(function () {
            const apiUrl = 'https://nc97.cnnd.vn/api-stockdata.htm?m=index';
            const marketContainer = $('.swiper-wrapper-market');

            function fetchMarketData() {
                $.ajax({
                    url: apiUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.Success && response.Data) {
                            try {
                                const parsedData = JSON.parse(response.Data);
                                renderMarketData(parsedData.data.index);
                            } catch (error) {
                                console.error("Error parsing nested JSON:", error);
                            }
                        }
                    },
                    error: function (error) {
                        console.error("Error fetching market data:", error);
                    }
                });
            }

            function renderMarketData(data) {
                marketContainer.empty(); // Xóa dữ liệu cũ trước khi render mới

                data.forEach(market => {
                    const { name, indexValue, percent } = market;
                    const isUp = parseFloat(percent.replace(',', '.')) >= 0;
                    const icon = isUp ? 'icon-up-market.png' : 'icon-down-market.png';
                    const itemClass = isUp ? 'item-market-up' : 'item-market-down';
                    const changeClass = isUp ? 'title-market-2' : 'title-market-down-2';
                    const indexClass = isUp ? 'title-market-1' : 'title-market-down-1';

                    const marketItem = `
                <div class="swiper-slide ${itemClass}">
                    <div class="line-top-market">
                        <img src="/image/${icon}" loading="lazy" alt="" class="icon-market">
                        <span class="name-market custom-line-1">${name}</span>
                        <span class="${changeClass} title-market-mobile">${percent}%</span>
                    </div>
                    <div class="line-bottom-market">
                        <span class="${indexClass}">${indexValue}</span>
                        <span class="${changeClass}">${percent}%</span>
                    </div>
                </div>
            `;
                    marketContainer.append(marketItem);
                });
            }

            fetchMarketData();
        });

        // giá cả hàng hóa
        $(document).ready(function () {
            const apiUrl = 'https://nc97.cnnd.vn/api-stockdata.htm?m=hanghoa';
            const tableBody = $('#body-table-commodity-price');

            function fetchCommodityPrices() {
                $.ajax({
                    url: apiUrl,
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.Success && response.Data) {
                            try {
                                const parsedData = JSON.parse(response.Data);
                                renderCommodityPrices(parsedData.data.value);
                            } catch (error) {
                                console.error("Error parsing nested JSON:", error);
                            }
                        }
                    },
                    error: function (error) {
                        console.error("Error fetching commodity data:", error);
                    }
                });
            }

            function renderCommodityPrices(data) {
                tableBody.empty();
                let row =' <tr class="line-hidden-table"></tr>';
                data.forEach(item => {
                    row += `
                            <tr>
                                <td class="col-content-1 col-content-tbody-one">
                                        <span>${item.material}</span>
                                        <div class="col-content-tbody-one-item">
                                            <strong>${item.last.toLocaleString()}</strong> <span>(USD)</span>
                                        </div>
                                    </td>
                                    <td class="${item.change >= 0 ? 'positive' : 'negative'} col-content-2">${item.change.toFixed(2)}</td>
                                    <td class="${item.changePercent >= 0 ? 'positive' : 'negative'} col-content-3">${item.changePercent.toFixed(2)}%</td>
                            </tr>
                        `;
                });
                tableBody.append(row);
            }

            fetchCommodityPrices();
        });

        // giá vàng
        $(document).ready(function () {
            function fetchGoldPrices() {
                $.ajax({
                    url: 'https://nc97.cnnd.vn/api-gold.htm?m=get_price&query=company%3DSJC%26type%3Dnu-trang-99%26from_date%3D2024-01-24T10%3A56%3A00%26to_date%3D2024-04-25T10%3A56%3A00%26zone%3Dto%C3%A0n%20qu%E1%BB%91c',
                    type: 'GET',
                    dataType: 'json',
                    success: function (response) {
                        if (response.code === 200 && response.data.length > 0) {
                            let rawData = response.data;

                            // Sắp xếp dữ liệu theo thời gian mới nhất (giảm dần)
                            rawData.sort((a, b) => new Date(b.date) - new Date(a.date));

                            let filteredData = [];
                            let seenNames = new Set();

                            // Lọc ra 5 mặt hàng khác nhau
                            for (let item of rawData) {
                                if (!seenNames.has(item.name)) {
                                    filteredData.push(item);
                                    seenNames.add(item.name);
                                }
                                if (filteredData.length === 5) break;
                            }

                            let tableBody = $('#gold-price-table');
                            tableBody.empty(); // Xóa dữ liệu cũ trước khi cập nhật mới
                            let row ='<tr class="line-hidden-table"></tr>';

                            filteredData.forEach(item => {
                                row += `
                                            <tr>
                                                <td class="col-content-gold-1">
                                                    ${item.company_name}
                                                </td>
                                                <td class="col-content-gold-2"><strong>${item.buy.toLocaleString()}</strong></td>
                                                <td class="col-content-gold-3"><strong>${item.sell.toLocaleString()}</strong></td>
                                            </tr>
                                        `;
                            });
                            tableBody.append(row);
                        } else {
                            console.log('Dữ liệu không hợp lệ hoặc không có dữ liệu.');
                        }
                    },
                    error: function () {
                        console.log('Lỗi khi tải dữ liệu từ API');
                    }
                });
            }

            fetchGoldPrices();
        });

        // ngoại tệ
        $(document).ready(function () {
            function fetchForeignCurrency() {
            $.ajax({
                url: "https://nc97.cnnd.vn/api-goldandusd.htm?c=GetRateCurrency&bank=%5B%22VPBANK%22%2C%22BIDV%22%5D&date=13%2F02%2F2025",
                type: "GET",
                dataType: "json",
                success: function (response) {
                    if (response.success && response.data.length > 0) {
                        let tbody = $("#body-table-foreign-currency");
                        tbody.empty(); // Xóa dữ liệu cũ nếu có
                        let row = '<tr class="line-hidden-table"></tr>';

                        response.data.slice(0, 5).forEach(function (currency) {
                            row += `
                                    <tr>
                                        <td class="col-content-gold-1">${currency.currency_name}</td>
                                        <td class="col-content-gold-2"><strong>${currency.buy_cash}</strong></td>
                                        <td class="col-content-gold-3"><strong>${currency.price}</strong></td>
                                    </tr>
                                `;
                        });
                        tbody.append(row);
                    }
                },
                error: function (xhr, status, error) {
                    console.error("Lỗi khi lấy dữ liệu: ", error);
                }
            });
            }

            fetchForeignCurrency();
        });
    </script>
    <script>
        $(document).ready(function () {
            // Lấy trạng thái yêu thích & số lượng từ localStorage
            let likedPosts = JSON.parse(localStorage.getItem("likedPosts")) || {};
            let likeCounts = JSON.parse(localStorage.getItem("likeCounts")) || {};
            let lastUpdate = localStorage.getItem("lastLikeCountsUpdate");

            // Hàm kiểm tra nếu đã hơn 1 giờ kể từ lần cuối cập nhật
            function shouldUpdateLikeCounts() {
                if (!lastUpdate) return true; // Nếu chưa có dữ liệu, cho phép cập nhật

                let lastUpdateTime = new Date(lastUpdate);
                let currentTime = new Date();
                let timeDiff = (currentTime - lastUpdateTime) / (1000 * 60 * 60); // Chuyển sang giờ

                return timeDiff >= 1; // Chỉ cập nhật nếu đã hơn 1 giờ
            }

            if (shouldUpdateLikeCounts()) {
                // lấy danh sách yêu thích theo từng bài
                $(".box-post-full").each(function () {
                    let postContainer = $(this);
                    let newsId = postContainer.find("input[name='newsId']").val();
                    let type = postContainer.find("input[name='type']").val();
                    let siteId = postContainer.find("input[name='siteId']").val();
                    let zoneId = postContainer.find("input[name='zoneId']").val();
                    let url = postContainer.find("input[name='url']").val();

                    let settings = {
                        url: `https://nc97.cnnd.vn/get-votereaction.api?newsids=${newsId}&type=${type}&siteid=${siteId}&zoneid=${zoneId}&url=${url}`,
                        method: "GET",
                        timeout: 0,
                    };

                    $.ajax(settings).done(function (response) {
                        if (response.Success && response.Data) {
                            let postData = response.Data.find(item => item.NewsId === newsId);
                            if (postData) {
                                let totalLikes = postData.TotalStar || 0;
                                likeCounts[newsId] = totalLikes;
                                localStorage.setItem("likeCounts", JSON.stringify(likeCounts));
                                localStorage.setItem("lastLikeCountsUpdate", new Date().toISOString());
                                postContainer.find(".item-icon-function-post .count-favourite").first().text(totalLikes);
                                if (likedPosts[newsId]) {
                                    postContainer.find(".add-icon-favourite").attr("src", "<?php echo e(asset('image/icon-tim-active.png')); ?>");
                                }
                            }
                        }
                    });
                });
            }

            // Áp dụng trạng thái yêu thích khi trang load
            $(".box-post-full").each(function () {
                let postContainer = $(this);
                let newsId = postContainer.find("input[name='newsId']").val();
                let totalLikes = likeCounts[newsId]|| 0

                if (likedPosts[newsId]) {
                    postContainer.find(".add-icon-favourite").attr("src", "<?php echo e(asset('image/icon-tim-active.png')); ?>");
                }
                postContainer.find(".item-icon-function-post .count-favourite").first().text(totalLikes);
            });

            // yêu thích bài viết và bỏ yêu thích bài viết
            $(".add-icon-favourite").on("click", function () {
                let postContainer = $(this).closest(".box-post-full");
                let newsId = postContainer.find("input[name='newsId']").val();
                let type = postContainer.find("input[name='type']").val();
                let siteId = postContainer.find("input[name='siteId']").val();
                let zoneId = postContainer.find("input[name='zoneId']").val();
                let userId = "12321888";

                if (JSON.parse(localStorage.getItem("likedPosts"))?.[newsId]) {
                    removeLike(postContainer, newsId, type, siteId, zoneId, userId);
                }else {
                    addLike(postContainer, newsId, siteId, zoneId, userId);
                }
            });

            // Yêu thích bài viết
            function addLike(postContainer, newsId, siteId, zoneId, userId){
                let settings = {
                    url: "https://nc97.cnnd.vn/add-votereaction.api",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "newsid": newsId,
                        "type": "3",  // Loại tương tác (3 = yêu thích)
                        "siteid": siteId,
                        "zoneid": zoneId,
                        "objecttype": "1",
                        "userid": userId
                    }
                };

                $.ajax(settings).done(function (response) {
                    // if (response.Success) {
                    likedPosts[newsId] = true;
                    localStorage.setItem("likedPosts", JSON.stringify(likedPosts));
                    postContainer.find(".add-icon-favourite").attr("src", "<?php echo e(asset('image/icon-tim-active.png')); ?>");
                    likeCounts[newsId] = (likeCounts[newsId] || 0) + 1;
                    localStorage.setItem("likeCounts", JSON.stringify(likeCounts));
                    postContainer.find(".item-icon-function-post .count-favourite").first().text(likeCounts[newsId]);
                    // } else {
                    //     console.log("Lỗi khi yêu thích bài viết!");
                    // }
                }).fail(function () {
                    console.log("Không thể kết nối đến server!");
                });
            }

            // Hàm bỏ yêu thích
            function removeLike(postContainer, newsId, type, siteId, zoneId, userId) {
                let settings = {
                    url: "https://nc97.cnnd.vn/remove-votereaction.api",
                    method: "POST",
                    timeout: 0,
                    headers: {
                        "Content-Type": "application/x-www-form-urlencoded"
                    },
                    data: {
                        "newsid": newsId,
                        "type": type,
                        "siteid": siteId,
                        "zoneid": zoneId,
                        "userid": userId
                    }
                };

                $.ajax(settings).done(function (response) {
                    // if (response.Success) {

                        // Xóa khỏi danh sách bài đã thích
                        delete likedPosts[newsId];

                        // Giảm số lượt thích đi 1 (nếu có)
                        if (likeCounts[newsId] && likeCounts[newsId] > 0) {
                            likeCounts[newsId] -= 1;
                        }

                        localStorage.setItem("likedPosts", JSON.stringify(likedPosts));
                        localStorage.setItem("likeCounts", JSON.stringify(likeCounts));
                        postContainer.find(".add-icon-favourite").attr("src", "<?php echo e(asset('image/icon-tim.png')); ?>");
                        postContainer.find(".count-favourite").first().text(likeCounts[newsId] || 0);
                    // }
                });
            }

        });
    </script>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('layout.master', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/home/index3.blade.php ENDPATH**/ ?>