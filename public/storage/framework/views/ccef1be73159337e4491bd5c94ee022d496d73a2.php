<?php if(!empty($homePost)): ?>
    <?php $__currentLoopData = $homePost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $tags = explode(';', $item->TagItem ?? '');
            $firstTag = trim($tags[0]);
        ?>
        <div class="box-post-full">
            <div class="box-item-post">
                <div class="item-post-header">
                    <div class="item-post-header-left">
                        <img
                            src="https://cungcau.qltns.mediacdn.vn/<?php echo e($item->Avatar); ?>"
                            alt="" loading="lazy" class="avatar-user-post">
                        <div class="box-infor-user-post">
                            <div class="line-name-user-post">
                                <span class="name-user-post"><?php echo e($item->Author); ?></span>
                                <img src="<?php echo e(asset('image/icon-tick.png')); ?>" alt="" loading="lazy"
                                     class="icon-tick-xanh">
                            </div>
                            <div class="line-bottom-header-post">
                                <span class="title-date-header-post"><?php echo e($item->DateTime); ?></span><span
                                    class="title-date-header-post">.</span><span
                                    class="title-tap-post custom-line-1"><?php echo e($firstTag); ?></span>
                            </div>
                        </div>
                    </div>
                    <div class="item-post-header-right">
                        <img src="<?php echo e(asset('image/icon-star.png')); ?>" loading="lazy" alt="" class="icon-star-post">
                        <img src="<?php echo e(asset('image/icon-more.png')); ?>" loading="lazy" alt="" class="icon-more-post">
                    </div>
                </div>
                <div class="item-post-content">
                    <p class="name-post"><?php echo e($item->Title); ?></p>
                    <p class="describe-post"><?php echo e($item->Sapo); ?></p>
                    <div class="line-more-describe-post">
                        <span>Xem tất cả</span>
                        <img src="<?php echo e(asset('image/more-right.png')); ?>" alt="" loading="lazy">
                    </div>
                    <div class="box-img-post">
                    <?php
                        // Danh sách Avatar cần kiểm tra (loại bỏ ảnh rỗng)
                       $avatars = array_values(array_filter([
                           $item->Avatar ?? '',
                           $item->Avatar2 ?? '',
                           $item->Avatar3 ?? '',
                           $item->Avatar4 ?? '',
                           $item->Avatar5 ?? ''
                       ], fn($img) => !empty($img)));

                       // Đếm số ảnh hợp lệ
                       $countImages = count($avatars);
                    ?>
                    <?php if($countImages == 1): ?>
                        <!-- Hiển thị 1 ảnh -->
                            <img
                                src="https://cungcau.qltns.mediacdn.vn/<?php echo e($item->Avatar); ?>"
                                alt="" loading="lazy" class="img-post img-single w-100">
                    <?php elseif($countImages == 2): ?>
                        <!-- Hiển thị 2 ảnh -->
                            <div class="img-grid img-two">
                                <?php $__currentLoopData = array_slice($avatars, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($img); ?>" alt="" loading="lazy"
                                         class="img-post w-50">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                    <?php elseif($countImages == 3): ?>
                        <!-- Hiển thị 3 ảnh -->
                            <div class="img-grid img-three">
                                <div class="img-left">
                                    <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($avatars[0]); ?>" loading="lazy"
                                         alt="" class="w-100 img-big">
                                </div>
                                <div class="img-right">
                                    <?php $__currentLoopData = array_slice($avatars, 1, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($img); ?>" alt="" loading="lazy"
                                             class="w-50">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                    <?php elseif($countImages == 4): ?>
                        <!-- Hiển thị 4 ảnh -->
                            <div class="img-grid img-four">
                                <?php $__currentLoopData = array_slice($avatars, 0, 4); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                    <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($img); ?>" alt="" loading="lazy"
                                         class="w-50">
                                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                            </div>
                    <?php elseif($countImages >= 5): ?>
                        <!-- Hiển thị 5 ảnh -->
                            <div class="img-grid img-five">
                                <div class="line-two-img-post">
                                    <?php $__currentLoopData = array_slice($avatars, 0, 2); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($img); ?>" alt="" loading="lazy"
                                             class="img-line-two">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                                <div class="img-row w-100" style="position: relative">
                                    <?php $__currentLoopData = array_slice($avatars, 2, 3); $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($img); ?>" alt="" loading="lazy"
                                             class="w-33">
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                    <?php if($countImages > 5): ?>
                                        <div class="more-images" onclick="openGlightbox()">
                                            +<?php echo e($countImages - 5); ?></div>
                                    <?php endif; ?>
                                </div>
                                <div id="hidden-images" style="display: none;">
                                    <?php $__currentLoopData = $avatars; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $img): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                        <a href="https://cungcau.qltns.mediacdn.vn/<?php echo e($img); ?>"
                                           class="glightbox">
                                            <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($img); ?>" loading="lazy">
                                        </a>
                                    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                                </div>
                            </div>
                        <?php else: ?>
                            <p class="no-images">Không có ảnh nào.</p>
                        <?php endif; ?>
                    </div>
                    <div class="line-bottom-content-post">
                        <div class="line-bottom-content-post-left">
                            <div class="item-icon-function-post">
                                <img src="<?php echo e(asset('image/icon-tim.png')); ?>" loading="lazy" alt=""
                                     class="item-icon-bottom-post">
                                <span class="title-icon-function-post">20</span>
                            </div>
                            <div class="item-icon-function-post">
                                <img src="<?php echo e(asset('image/icon-bl.png')); ?>" loading="lazy" alt=""
                                     class="item-icon-bottom-post">
                                <span class="title-icon-function-post">12</span>
                            </div>
                            <div class="item-icon-function-post">
                                <img src="<?php echo e(asset('image/icon-mat.png')); ?>" loading="lazy" alt=""
                                     class="item-icon-bottom-post">
                                <span class="title-icon-function-post">240</span>
                            </div>
                        </div>
                        <div class="line-bottom-content-post-right">
                            <div class="item-icon-function-post" onclick="shareToFacebook(event,'http://127.0.0.1:8000/')">
                                <img src="<?php echo e(asset('image/icon-cs.png')); ?>" loading="lazy" alt=""
                                     class="item-icon-bottom-post">
                                <span
                                    class="title-icon-function-post text-icon-function-post">Chia sẻ</span>
                            </div>
                            <?php if(!empty($item->NewsRelation)): ?>
                                <div class="item-icon-function-post">
                                    <span class="title-icon-function-post">|</span>
                                </div>
                                <div class="item-icon-function-post" onclick="toggleRelatedPosts(1)">
                                    <span class="title-icon-function-post text-icon-function-post">Bài viết liên quan</span>
                                    <img src="<?php echo e(asset('image/icon-arrow-down.png')); ?>" loading="lazy" alt=""
                                         class="item-icon-bottom-post item-icon-bottom-post-mobile">
                                </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
            <?php if(!empty($item->NewsRelation)): ?>
                <?php
                    $newsRelation = json_decode($item->NewsRelation, true);
                ?>
                <div id="related-posts-1" class="related-posts swiper mySwiper">
                    <div class="related-posts-container swiper-wrapper">
                        <?php $__currentLoopData = $newsRelation; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $value): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                            <a href="<?php echo e($value['Url']); ?>" class="related-post swiper-slide">
                                <img src="https://cungcau.qltns.mediacdn.vn/<?php echo e($value['Avatar']); ?>"
                                     alt="<?php echo e($value['Title']); ?>">
                                <div class="custom-line-3 text-sapo-post-more"><?php echo e($value['Title']); ?>

                                </div>
                            </a>
                        <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                    </div>
                </div>
            <?php endif; ?>
        </div>
    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/components/template/item-post.blade.php ENDPATH**/ ?>