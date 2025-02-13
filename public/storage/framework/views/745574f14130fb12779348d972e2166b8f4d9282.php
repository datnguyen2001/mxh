<!doctype html>
<html>
<head>
    <meta charset="utf-8" />
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <meta http-equiv="content-language" content="vi" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Trang thông báo lỗi 404</title>
    <meta name="description" content="" />
    <meta name="robots" content="noindex,nofollow" />
    <meta name="keywords" content="404" />
    <meta name="news_keywords" content="404" />
    <meta name="revisit-after" content="1 days" />
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet" />
    <link rel="shortcut icon" href="<?php echo e(config('siteInfo.favicon')); ?>" type="image/png">
    <style>
        body{height:100vh;overflow:hidden;font-family:Roboto,sans-serif;width:100%;margin:0}*,:after,:before{box-sizing:border-box}.container{max-width:640px;margin:0 auto;height:100%;display:flex;flex-direction:column;align-items:center;justify-content:center;padding:15px;width:100%}.btn-404{text-decoration:none;color:#fff;display:inline-block;padding:8px 20px;background-color:#000;border-radius:8px;text-transform:uppercase;font-size:12px;font-weight:700;line-height:18px}.image-404{max-height:350px;margin-bottom:20px;width:100%}.holder-text{margin-bottom:20px;font-size:18px;line-height:24px}
    </style>
</head>
<body>
<div class="container">
    <div class="holder-text">Nội dung này đã bị gỡ hoặc không tồn tại</div>
    <div id="holder-img">
    </div>
    <a href="/" title="Trang chủ" class="btn-404">Quay về trang chủ</a>
</div>
<script>
    var _ADM_Channel = '%2f404%2f';
    var pic = new Array(
        '<img src="https://static.mediacdn.vn/images/404.png" alt="" class="image-404">',
        '<img src="https://static.mediacdn.vn/images/4041.gif" alt="" class="image-404">',
        '<img src="https://static.mediacdn.vn/images/4042.png" alt="" class="image-404">',
        '<img src="https://static.mediacdn.vn/images/4043.png" alt="" class="image-404">',
    );
    var n = Math.floor(Math.random() * 4);

    var classImg = document.getElementById("holder-img");
    if (classImg != null) {
        classImg.innerHTML = pic[n];
    }
    setTimeout(function () {
        window.location.href = "/";
    }, 5 * 1000);
</script>
</body>
</html>
<?php /**PATH D:\laragon\www\mxh-v2-main\resources\views/errors/404.blade.php ENDPATH**/ ?>