<div class="box-page-left">
    <div class="box-featured-topic">
        <div class="header-featured-topic">
            <div class="box-icon-topic">
                <img src="<?php echo e(asset('image/icon-topic.png')); ?>" alt="" loading="lazy">
            </div>
            <span class="title-topic">Chủ đề nổi bật</span>
        </div>
        <div class="box-item-featured-topic">
            <?php if(!empty($featuredTopics)): ?>
                <?php $__currentLoopData = $featuredTopics; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                    <a href="<?php echo e($item->Url); ?>" class="item--featured-topic-post">
                        <img
                            src="<?php echo e($item->Avatar ? $item->Avatar : asset('image/img-ex.png')); ?>"
                            alt="<?php echo e($item->Title??''); ?>" loading="lazy" class="img-post-featured-topic">
                        <div class="title-featured-topic-post">
                            <?php echo e($item->Title); ?>

                        </div>
                    </a>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="box-introduce-left">
        <a href="#" class="item-introduce-left">
            <img src="<?php echo e(asset('image/icon-introduce.png')); ?>" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Về chúng tôi</span>
        </a>
        <a href="#" class="item-introduce-left">
            <img src="<?php echo e(asset('image/icon-dk.png')); ?>" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Điều khoản bảo mật</span>
        </a>
        <a href="#" class="item-introduce-left">
            <img src="<?php echo e(asset('image/icon-tt.png')); ?>" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Thỏa thuận sử dụng</span>
        </a>
        <a href="#" class="item-introduce-left" style="border: none">
            <img src="<?php echo e(asset('image/icon-qc.png')); ?>" loading="lazy" alt="" class="icon-introduct-left">
            <span class="title-introduct-left">Liên hệ quảng cáo</span>
        </a>
    </div>
</div>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/components/template/page-left.blade.php ENDPATH**/ ?>