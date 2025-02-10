<?php
//Route tĩnh sẽ viết tại đây
Route::get('/category/thoi-su', function () {
    return Redirect::to(config('siteInfo.site_path') . '/thoi-su.htm', 301);
});
Route::get('/category/chinh-tri', function () {
    return Redirect::to(config('siteInfo.site_path') . '/thoi-su/chinh-tri.htm', 301);
});
Route::get('/category/the-gioi', function () {
    return Redirect::to(config('siteInfo.site_path') . '/thoi-su/the-gioi.htm', 301);
});
Route::get('/category/tieu-diem', function () {
    return Redirect::to(config('siteInfo.site_path') . '/thoi-su/tieu-diem.htm', 301);
});
Route::get('/category/xa-hoi', function () {
    return Redirect::to(config('siteInfo.site_path') . '/thoi-su/xa-hoi.htm', 301);
});
Route::get('/category/bao-hiem-xa-hoi', function () {
    return Redirect::to(config('siteInfo.site_path') . '/thoi-su/bao-hiem-xa-hoi.htm', 301);
});
Route::get('/category/gioi-tre', function () {
    return Redirect::to(config('siteInfo.site_path') . '/gioi-tre.htm', 301);
});
Route::get('/category/nhip-song-tre', function () {
    return Redirect::to(config('siteInfo.site_path') . '/gioi-tre/nhip-song-tre.htm', 301);
});
Route::get('/category/doan-hoi-doi', function () {
    return Redirect::to(config('siteInfo.site_path') . '/gioi-tre/doan-hoi-doi.htm', 301);
});
Route::get('/category/lam-theo-loi-bac', function () {
    return Redirect::to(config('siteInfo.site_path') . '/gioi-tre/lam-theo-loi-bac.htm', 301);
});
Route::get('/category/nhat-ky-tinh-nguyen', function () {
    return Redirect::to(config('siteInfo.site_path') . '/gioi-tre/nhat-ky-tinh-nguyen.htm', 301);
});
Route::get('/category/ly-luan-tre', function () {
    return Redirect::to(config('siteInfo.site_path') . '/ly-luan-tre.htm', 301);
});
Route::get('/category/giao-duc', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giao-duc.htm', 301);
});
Route::get('/category/day-nghe', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giao-duc/day-nghe.htm', 301);
});
Route::get('/category/du-hoc', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giao-duc/du-hoc.htm', 301);
});
Route::get('/category/huong-nghiep', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giao-duc/huong-nghiep.htm', 301);
});
Route::get('/category/dao-tao-truc-tuyen', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giao-duc/dao-tao-truc-tuyen.htm', 301);
});
Route::get('/category/viec-lam', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giao-duc/viec-lam.htm', 301);
});
Route::get('/category/cong-nghe', function () {
    return Redirect::to(config('siteInfo.site_path') . '/cong-nghe.htm', 301);
});
Route::get('/category/so-hoa', function () {
    return Redirect::to(config('siteInfo.site_path') . '/cong-nghe/so-hoa.htm', 301);
});
Route::get('/category/o-to-xe-may', function () {
    return Redirect::to(config('siteInfo.site_path') . '/cong-nghe/o-to-xe-may.htm', 301);
});
Route::get('/category/so-huu-tri-tue', function () {
    return Redirect::to(config('siteInfo.site_path') . '/cong-nghe/so-huu-tri-tue.htm', 301);
});
Route::get('/category/doanh-nhan', function () {
    return Redirect::to(config('siteInfo.site_path') . '/doanh-nhan.htm', 301);
});
Route::get('/category/guong-doanh-nhan-tre', function () {
    return Redirect::to(config('siteInfo.site_path') . '/doanh-nhan/guong-doanh-nhan-tre.htm', 301);
});
Route::get('/category/hoi-nhap', function () {
    return Redirect::to(config('siteInfo.site_path') . '/doanh-nhan/hoi-nhap.htm', 301);
});
Route::get('/category/the-thao', function () {
    return Redirect::to(config('siteInfo.site_path') . '/the-thao.htm', 301);
});
Route::get('/category/tennis', function () {
    return Redirect::to(config('siteInfo.site_path') . '/the-thao/tennis.htm', 301);
});
Route::get('/category/the-thao-trong-nuoc', function () {
    return Redirect::to(config('siteInfo.site_path') . '/the-thao/the-thao-trong-nuoc.htm', 301);
});
Route::get('/category/the-thao-quoc-te', function () {
    return Redirect::to(config('siteInfo.site_path') . '/the-thao/the-thao-quoc-te.htm', 301);
});
Route::get('/category/van-hoa-the-thao', function () {
    return Redirect::to(config('siteInfo.site_path') . '/the-thao/van-hoa-the-thao.htm', 301);
});
Route::get('/category/giai-tri', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giai-tri.htm', 301);
});
Route::get('/category/van-hoa', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giai-tri/van-hoa.htm', 301);
});
Route::get('/category/goc-hai-huoc', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giai-tri/goc-hai-huoc.htm', 301);
});
Route::get('/category/thu-gian', function () {
    return Redirect::to(config('siteInfo.site_path') . '/giai-tri/thu-gian.htm', 301);
});
Route::get('/category/suc-khoe', function () {
    return Redirect::to(config('siteInfo.site_path') . '/suc-khoe.htm', 301);
});
Route::get('/category/dinh-duong', function () {
    return Redirect::to(config('siteInfo.site_path') . '/suc-khoe/dinh-duong.htm', 301);
});
Route::get('/category/gioi-tinh', function () {
    return Redirect::to(config('siteInfo.site_path') . '/suc-khoe/gioi-tinh.htm', 301);
});
Route::get('/category/truyen-thong-y-te', function () {
    return Redirect::to(config('siteInfo.site_path') . '/suc-khoe/truyen-thong-y-te.htm', 301);
});
Route::get('/category/tai-chinh', function () {
    return Redirect::to(config('siteInfo.site_path') . '/tai-chinh.htm', 301);
});
Route::get('/category/tai-chinh-ngan-hang', function () {
    return Redirect::to(config('siteInfo.site_path') . '/tai-chinh/tai-chinh-ngan-hang.htm', 301);
});
Route::get('/category/chung-khoan', function () {
    return Redirect::to(config('siteInfo.site_path') . '/tai-chinh/chung-khoan.htm', 301);
});
Route::get('/category/tien-te', function () {
    return Redirect::to(config('siteInfo.site_path') . '/tai-chinh/tien-te.htm', 301);
});
Route::get('/category/can-biet', function () {
    return Redirect::to(config('siteInfo.site_path') . '/can-biet.htm', 301);
});
Route::get('/category/thi-truong', function () {
    return Redirect::to(config('siteInfo.site_path') . '/can-biet/thi-truong.htm', 301);
});
Route::get('/category/ban-doc', function () {
    return Redirect::to(config('siteInfo.site_path') . '/ban-doc.htm', 301);
});
Route::get('/category/hop-thu-ban-doc', function () {
    return Redirect::to(config('siteInfo.site_path') . '/ban-doc/hop-thu-ban-doc.htm', 301);
});
Route::get('/category/duong-day-nong', function () {
    return Redirect::to(config('siteInfo.site_path') . '/ban-doc/duong-day-nong.htm', 301);
});
Route::get('/category/nhip-cau-nhan-ai', function () {
    return Redirect::to(config('siteInfo.site_path') . '/ban-doc/nhip-cau-nhan-ai.htm', 301);
});
Route::get('/category/du-lich', function () {
    return Redirect::to(config('siteInfo.site_path') . '/du-lich.htm', 301);
});
Route::get('/category/sao-tre', function () {
    return Redirect::to(config('siteInfo.site_path') . '/sao-tre.htm', 301);
});


Route::get('/news-tag{tags_id}/{slug_tag}', function($tags_id,$slug_tag){
    return Redirect::to(config('siteInfo.site_path')."/$slug_tag.html",301);
})->where(['slug_tag' => '[0-9A-Za-z\-]+', 'tags_id' => '([0-9]{2,}+)']);


Route::get('/tim-kiem', function () {
    $key = filter_var($_GET['q']??'',FILTER_SANITIZE_STRING);
    return Redirect::to(config('siteInfo.site_path').'/tim-kiem.htm?keywords='.$key,301);
});
?>
