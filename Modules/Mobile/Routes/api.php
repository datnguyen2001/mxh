<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\VerifySecretKey;
use App\Http\Controllers\ApiController;
use App\Http\Controllers\ApiUserController;
use Modules\Mobile\Http\Controllers\NewsController;
use Modules\Mobile\Http\Controllers\CategoryController;
use Modules\Mobile\Http\Controllers\ThreadController;
use Modules\Mobile\Http\Controllers\ListImgController;
use Modules\Mobile\Http\Controllers\TagsController;
use Modules\Mobile\Http\Controllers\SearchController;
use Modules\Mobile\Http\Controllers\VideoController;
use Modules\Mobile\Http\Controllers\HomeController;
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
