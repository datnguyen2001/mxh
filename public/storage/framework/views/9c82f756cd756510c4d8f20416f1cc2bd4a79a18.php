<?php if(!empty($dataPostMore)): ?>
    <?php $__currentLoopData = $dataPostMore; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
        <?php
            $tags = explode(';', $item->TagItem ?? '');
            $firstTag = trim($tags[0]);
        ?>
        <?php echo $__env->make('components.template.item-post', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?>

    <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
<?php endif; ?>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/home/index4.blade.php ENDPATH**/ ?>