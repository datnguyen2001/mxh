<?php

use Illuminate\Support\Facades\Route;
use Modules\Mobile\Http\Controllers\HomeController;
use Modules\Mobile\Http\Controllers\NewsController;
use Modules\Mobile\Http\Controllers\CategoryController;
use Modules\Mobile\Http\Controllers\TagsController;
use Modules\Mobile\Http\Controllers\SearchController;
use Modules\Mobile\Http\Controllers\MediaController;
use Modules\Mobile\Http\Controllers\ThreadController;
use App\Http\Controllers\CacheManagerController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


if (env('SITE_MOBILE')) {

    //loadmore
    Route::group(['middleware' => ['ResponseRedisCache']], function () {

        Route::get('/timelinehome/{pageIndex}.htm',[HomeController::class,'homeLoadingPage'])->where(['pageIndex' => '[a-zA-Z0-9-_]+'])->name('loadMoreMonitor');
        Route::get('/timelinelist/{zoneId}/{pageIndex}.htm', [CategoryController::class, 'loadMorePaging'])->where(['zoneId' => '([0-9]+)', 'pageIndex' => '([0-9]+)'])->name('loadMoreMonitor');
        Route::get('/load-cate-sidebar/{zoneId}.htm', [CategoryController::class, 'loadCateSidebar'])->where(['zoneId' => '([0-9]+)'])->name('loadMore');
        Route::get('/timelinenewbytype/{zoneId}/{pageIndex}.htm', [MediaController::class, 'loadMorePaging'])->where(['zoneId' => '([0-9]+)', 'pageIndex' => '([0-9]+)'])->name('loadMore');

        //ajax detail
        Route::get('/load-detail-related/{zoneId}.htm', [NewsController::class, 'loadRelated'])->where(['zoneId' => '([0-9]+)'])->name('loadMore');
        Route::get('/ajax-load-detail-bottom.htm', [NewsController::class, 'loadDetailBottom'])->name('loadMore');
        Route::get('/timelinedetail/{zoneId}/{pageIndex}.htm', [NewsController::class, 'loadMorePaging'])->where(['zoneId' => '([0-9]+)','pageIndex' => '([0-9]+)'])->name('loadMore');
        Route::get('/ajax-detail-magazine.htm', [NewsController::class, 'loadDetailMagazineBottom'])->where(['zoneId' => '([0-9]+)'])->name('loadMore');
        Route::get('/load-detail-video.htm', [NewsController::class, 'loadDetailVideoBottom'])->name('loadMore');

        //ajax sk|tag|search| báo giấy
        Route::get('/timelinesearch/{keywords}/{pageIndex}.htm', [SearchController::class, 'loadMorePaging'])->where([ 'pageIndex' => '([0-9]+)']);
        Route::get('/timelinetag/{keywords}/{pageIndex}.htm', [TagsController::class, 'loadMorePaging'])->where(['pageIndex' => '([0-9]+)','keywords' => '([a-zA-Z0-9-_]+)'])->name('loadMore');
        Route::get('/timelinethread/{threadId}/{pageIndex}.htm', [ThreadController::class, 'loadMorePaging'])->where(['pageIndex' => '([0-9]+)', 'threadId' => '([0-9]+)'])->name('loadMore');
        Route::get('/timelinePaper/{type}/{pageIndex}.htm', [SearchController::class, 'loadMorePagingPaper'])->where(['pageIndex' => '([0-9]+)', 'type' => '([0-9]+)'])->name('loadMore');

    });

    Route::group(['middleware' => ['Redirect', 'ResponseRedisCache']], function () {

        Route::get('/', [HomeController::class, 'index'])->name('page_home');

        //Media
        Route::get('/emagazine.htm', [MediaController::class, 'emagazine'])->name('page_category');

        Route::get('/video.htm', [MediaController::class, 'video'])->name('page_category');

        Route::get('/anh.htm', [MediaController::class, 'anh'])->name('page_category');

        Route::get('/infographic.htm', [MediaController::class, 'infographic'])->name('page_category');

        //tạp chí
        Route::get('/an-pham.' . env('CAT_FILENAME') . '', [SearchController::class, 'listPaper'])->name('page_search');
        Route::get('/tap-chi.' . env('CAT_FILENAME') . '', [SearchController::class, 'listPaper'])->name('page_search');
        Route::get('/bao-giay/{slug_news}-{newsid}.' . env('DETAIL_FILENAME') . '', [NewsController::class, 'detailBaoGiay'])->where(['slug_news' => '[0-9A-Za-z\-]+', 'newsid' => '([0-9]{2,}+)'])->name('page_detail');

        //Search
        Route::get('/tim-kiem.' . env('SEARCH_FILENAME') . '', [SearchController::class, 'index'])->name('page_search');

        // dòng sự kiện
        Route::get('/dong-su-kien/{slug_thread}-{threadId}.' . env('CAT_FILENAME') . '', [ThreadController::class, 'index'])->where(['slug_thread' => '[a-zA-Z0-9-_]+', 'threadId' => '([0-9]+)'])->name('page_thread');

        //Tags
        Route::get('/{tag}.' . env('TAG_FILENAME') . '', [TagsController::class, 'index'])->where('tag', '([a-zA-Z0-9-_]+)')->name('page_tag');

        Route::get('/print/{slug_news}-{newsid}.' . env('DETAIL_FILENAME') . '', function ($slug_news,$newsid) {
            return Redirect::to('/'.$slug_news.'-'. $newsid . '.htm', 301);
        })->where(['slug_news' => '[0-9A-Za-z\-]+', 'newsid' => '(\d*[0-9]{3,}+)']);

        //Detail
        Route::get('/short-link-tele-{newsid}.' . env('DETAIL_FILENAME') . '', [NewsController::class, 'detailBomb'])->where([ 'newsid' => '([0-9]{3,}+)'])->name('page_detail_bomb');
        Route::get('/{slug_news}-{newsid}.' . env('DETAIL_FILENAME') . '', [NewsController::class, 'detail'])->where(['slug_news' => '[0-9A-Za-z\-]+', 'newsid' => '([0-9]{3,}+)'])->name('page_detail');

        //Category
        Route::get('/{slug_cat}.' . env('CAT_FILENAME') . '', [CategoryController::class, 'index'])->where('slug_cat', '[a-zA-Z0-9-_]+')->name('page_category');
        //Chird Category
        Route::get('/{slug_cat}/{slug_child}.' . env('CAT_FILENAME') . '', [CategoryController::class, 'index'])->where(['slug_cat' => '[a-zA-Z0-9-_]+', 'slug_child' => '[a-zA-Z0-9-_]+'])->name('page_category');

        Route::get('/{year}/{month}/{day}/{slug_news}/', function(){
            return Redirect::to(config('siteInfo.site_path').'/',301);}
        )->where(['slug_news' => '[0-9A-Za-z\-]+', 'day' => '([0-9]+){1,2}', 'month' => '([0-9]+){1,2}', 'year' => '([0-9]+){4}']);

    });
}
