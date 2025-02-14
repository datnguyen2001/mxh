<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NewsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\MediaController;
use App\Http\Controllers\CacheManagerRedisController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\SitemapController;
use App\Http\Controllers\RssController;
use App\Http\Controllers\ApiRedisCacheController;
use Illuminate\Http\Request;

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


Route::get('/404.htm', function () {
    return abort(404);
});

Route::get('/code-identityserver-sample-callback.html', [LoginController::class, 'login_callback']);
Route::get('/code-identityserver-sample-callback-signout.html', [LoginController::class, 'callback_signout']);
Route::get('/code-identityserver-sample-silent.html', [LoginController::class, 'sample_silent']);

//Cache link .net
Route::get('/cached/handler.ashx',[ApiRedisCacheController::class,'index']);

//Quản lí cache trên trang
Route::prefix('')->group(function () {
    Route::get('/manager/cache', [CacheManagerRedisController::class, 'index'])->name('view_cache_manager');
    Route::get('/manager/login', function (Request $request ){
        return view('manager/login',['secret_key' => $request->secret_key]);
    });
    Route::post('/manager/login', [CacheManagerRedisController::class, 'postLogin']);

    Route::get('/manager/cache/clearZone', [CacheManagerRedisController::class, 'manager'])->name('cache_manager');

    Route::post('/manager/cache', [CacheManagerRedisController::class, 'manager'])->name('cache_manager');

    //Get Redis
    Route::get('/testredis.aspx', [CacheManagerRedisController::class, 'viewRedis'])->name('cache_manager');

    Route::get('/testredis.aspx/QueryRedis', [CacheManagerRedisController::class, 'getKeyRedis'])->name('cache_manager');

});

//Name Route chỉ đặt có tác dụng để set cache không dùng trong views với route name
if (!env('SITE_MOBILE')) {

    //LoadMore Trả dạng html để loadMore, dạng json để loadMoreJson
    //Load more với những trang có monitor để  loadMoreMonitor
    Route::group(['middleware' => ['ResponseRedisCache']], function () {
        Route::get('/timelinehome/{pageIndex}.htm', [HomeController::class, 'homeLoadingPage'])->where(['pageIndex' => '([0-9]+)'])->name('loadMoreMonitor');
        Route::get('/timelinelist/{zoneId}/{pageIndex}.htm', [CategoryController::class, 'loadMorePaging'])->where(['pageIndex' => '([0-9]+)','zoneId' => '([0-9]+)'])->name('loadMoreMonitor');
        Route::get('/timelinetag/{keywords}/{pageIndex}.htm', [TagsController::class, 'loadMorePaging'])->where(['pageIndex' => '([0-9]+)','keywords' => '([a-zA-Z0-9-_]+)'])->name('loadMore');

        Route::get('/timelinenewbytype/{zoneId}/{pageIndex}.htm', [MediaController::class, 'loadMorePaging'])->where(['pageIndex' => '([0-9]+)','zoneId' => '([0-9]+)'])->name('loadMore');

        // ajax category
        Route::get('/load-tag-trending/{zoneId}.htm', [CategoryController::class, 'loadTagTrending'])->where(['zoneId' => '([0-9]+)'])->name('loadMore');
        Route::get('/load-cate-sidebar/{zoneId}.htm', [CategoryController::class, 'loadCateSidebar'])->where(['zoneId' => '([0-9]+)'])->name('loadMore');

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

    //Chú ý khi đặt thứ tự route, Chỉ sử dụng middleware Redirect khi site cũ có đá 301 qua mapping
    //Xóa Route thừa với những site không dùng hết
    //Đặt tên route name tương tự name trong config cache đã có sẵn , nếu viết thêm tự động add vào config cache
    Route::group(['middleware' => ['Redirect','ResponseRedisCache']], function () {

        //Home
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

        Route::get('/print/{slug_news}-{newsid}.' . env('DETAIL_FILENAME') . '', [NewsController::class, 'detailPrint'])->where(['slug_news' => '[0-9A-Za-z\-]+', 'newsid' => '([0-9]{3,}+)'])->name('page_detail');


        Route::get('/short-link-tele-{newsid}.' . env('DETAIL_FILENAME') . '', [NewsController::class, 'detailBomb'])->where([ 'newsid' => '([0-9]{3,}+)'])->name('page_detail_bomb');

        Route::get('/{slug_news}-{newsid}.' . env('DETAIL_FILENAME') . '', [NewsController::class, 'detail'])->where(['slug_news' => '[0-9A-Za-z\-]+', 'newsid' => '([0-9]{3,}+)'])->name('page_detail');

        // Category
        Route::get('/{slug_cat}/trang-{pageIndex}.' . env('CAT_FILENAME') . '', [CategoryController::class, 'index2'])->where(['slug_cat' => '[a-zA-Z0-9-_]+','pageIndex' => '([0-9]+)'])->name('page_category');
        Route::get('/{slug_cat}/{slug_child}/trang-{pageIndex}.' . env('CAT_FILENAME') . '', [CategoryController::class, 'index2'])->where(['slug_cat' => '[a-zA-Z0-9-_]+', 'slug_child' => '[a-zA-Z0-9-_]+','pageIndex' => '([0-9]+)'])->name('page_category');

        Route::get('/{slug_cat}.' . env('CAT_FILENAME') . '', [CategoryController::class, 'index1'])->where('slug_cat', '[a-zA-Z0-9-_]+')->name('page_category');
        Route::get('/{slug_cat}/{slug_child}.' . env('CAT_FILENAME') . '', [CategoryController::class, 'index1'])->where(['slug_cat' => '[a-zA-Z0-9-_]+', 'slug_child' => '[a-zA-Z0-9-_]+'])->name('page_category');




        Route::get('/{year}/{month}/{day}/{slug_news}/', function(){
            return Redirect::to(config('siteInfo.site_path').'/',301);}
        )->where(['slug_news' => '[0-9A-Za-z\-]+', 'day' => '([0-9]+){1,2}', 'month' => '([0-9]+){1,2}', 'year' => '([0-9]+){4}']);
    });
}

//Site map trên trang
Route::prefix('')->group(function () {

    Route::get('/sitemap-render-xml', [SitemapController::class, 'index']);

    Route::get('/sitemap.xml', [SitemapController::class, 'index']);

    Route::get('/sitemap/{form}-{to}/{date}', [SitemapController::class, 'rendertoDate'])->where(['date' => '([0-9]+){4}']);

    Route::get('/sitemaps/sitemaps-{year}-{month}-{dayForm}-{dayTo}.xml', [SitemapController::class, 'sitemapDetail'])->where(['month' => '([0-9]+){1,2}', 'year' => '([0-9]+){4}','dayTo' => '([0-9]+){1,2}','dayForm' => '([0-9]+){1,2}'])->name('sitemap');

    Route::get('/sitemaps/category.rss', [SitemapController::class, 'sitemapCategory'])->name('sitemap');

    Route::get('/google-news-sitemap.xml', [SitemapController::class, 'sitemapGoogleNews'])->name('sitemap');

    Route::get('/latest-news-sitemap.xml', [SitemapController::class, 'latestnewsNews'])->name('sitemap');

    Route::get('/rss/home.rss', [RssController::class, 'home'])->name('rss');

    Route::get('/coccoc-feed.rss', [RssController::class, 'cococ'])->name('cococ-rss');

    Route::get('/rss/{slug_cat}.rss', [RssController::class, 'category'])->where(['slug_cat' => '([a-zA-Z0-9-_]+)', 'catId' => '([0-9]+)'])->name('rss');

    Route::get('/rss/{slug_cat}/{slug_child}.rss', [RssController::class, 'category'])->where(['slug_cat' => '([a-zA-Z0-9-_]+)','slug_child' => '([a-zA-Z0-9-_]+)', 'catId' => '([0-9]+)'])->name('rss');

    //Link proxy add các site
    Route::get('/link4proxy', [RssController::class, 'link4proxy'])->name('loadMoreJson');

    //Rss
    Route::get('/index.rss', [RssController::class, 'index'])->name('rss');

});

//Redirect link tĩnh
require __DIR__.'/route-redirect.php';
//End
