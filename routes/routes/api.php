<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifySecretKey;
use App\Http\Controllers\ApiRedisCacheController;
use App\Http\Controllers\VoteController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/


Route::get('/cachemanager/DeleteArticle',[ApiRedisCacheController::class,'DeleteArticle'])->name('DeleteArticle');

//Route::group(['middleware' => ['ResponseCache','Cors']], function () {
//
//});

Route::middleware([VerifySecretKey::class])->group(function (){

    Route::get('/cachemanager/UpdateDetail',[ApiRedisCacheController::class,'UpdateDetail'])->name('cacheUpdateDetail');

    Route::get('/cachemanager/UpdateList',[ApiRedisCacheController::class,'UpdateList'])->name('cacheUpdateList');

    Route::get('/cachemanager/UpdateHome',[ApiRedisCacheController::class,'UpdateHome'])->name('cacheUpdateHome');

    Route::get('/cachemanager/ClearCache',[ApiRedisCacheController::class,'ClearCache'])->name('ClearCache');

    Route::get('/cachemanager/LiveEdit',[ApiRedisCacheController::class,'LiveEdit'])->name('LiveEdit');

    Route::get('/cachemanager/ChangeTitle',[ApiRedisCacheController::class,'ChangeTitle'])->name('ChangeTitle');

    Route::get('/cachemanager/UpdateVideoHome',[ApiRedisCacheController::class,'UpdateVideoHome'])->name('UpdateVideoHome');

    Route::get('/cachemanager/UpdateVideoDetail',[ApiRedisCacheController::class,'UpdateVideoDetail'])->name('UpdateVideoDetail');

    Route::get('/cachemanager/ClearCacheVideo',[ApiRedisCacheController::class,'ClearCacheVideo'])->name('ClearCacheVideo');

    Route::get('/cachemanager/UpdateVideoList',[ApiRedisCacheController::class,'UpdateVideoList'])->name('UpdateVideoList');

    Route::get('/cachemanager/UpdateQuestion',[ApiRedisCacheController::class,'UpdateQuestion'])->name('UpdateQuestion');

    Route::get('/cachemanager/UpdateDetailQuestion',[ApiRedisCacheController::class,'UpdateDetailQuestion'])->name('cacheUpdateDetail');

    Route::get('/cachemanager/UpdateBooks',[ApiRedisCacheController::class,'UpdateBooks'])->name('UpdateBooks');

    Route::get('/cachemanager/Delete',[ApiRedisCacheController::class,'Delete'])->name('Delete');

    Route::get('/cachemanager/UpdateListByType',[ApiRedisCacheController::class,'UpdateListByType'])->name('UpdateListByType');

});


Route::group(['middleware' => ['ResponseRedisCache']], function () {

    Route::get('/get-vote-info-{Id}.htm', [VoteController::class, 'getVoteInfo'])->where(['Id'=> '([0-9]+)'])->name('loadMoreJsonApi');

});
