<div class="box-create-post">
    <div class="line-header-create-post">
        <div class="line-header-create-post-info">
            <img
                src="<?php echo e(asset('image/avatar-user-df.png')); ?>"
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
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/components/template/create-post.blade.php ENDPATH**/ ?>