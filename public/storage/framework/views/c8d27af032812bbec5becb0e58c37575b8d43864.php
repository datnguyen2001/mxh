<div class="box-page-right">
    <div class="header-featured-topic">
        <div class="box-icon-topic">
            <img src="<?php echo e(asset('image/icon-trend.png')); ?>" loading="lazy" alt="">
        </div>
        <span class="title-topic">Xu hướng</span>
    </div>
    <div class="box-post-trend-right">
        <?php if(!empty($trendPost)): ?>
            <?php $__currentLoopData = $trendPost; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <a href="<?php echo e($item->Url); ?>"
                   class="item-post-trend-right <?php if($loop->last): ?> last-item-post-trend-right <?php endif; ?>">
                    <p class="title-post-trend-right"><?php echo e($item->Title); ?></p>
                    <img
                        src="https://cungcau.qltns.mediacdn.vn/<?php echo e($item->Avatar); ?>" loading="lazy"
                        alt="<?php echo e($item->Title); ?>" class="img-post-trend-right">
                    <div class="line-bottom-post-trend">
                        <div class="line-bottom-post-trend-info">
                            <img
                                src="https://cungcau.qltns.mediacdn.vn/<?php echo e($item->Avatar); ?>" loading="lazy"
                                alt="<?php echo e($item->Author); ?>" class="img-info-post-trend-right">
                            <span class="text-info-post-trend"><?php echo e($item->Author?:'Ngọc Châu'); ?></span>
                        </div>
                        <span
                            class="text-time-post-trend"> <?php echo e(\Carbon\Carbon::parse($item->LastModifiedDate)->format('d/m/Y')); ?></span>
                    </div>
                </a>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
        <?php endif; ?>
    </div>
</div>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/components/template/page-right.blade.php ENDPATH**/ ?>