<?php

namespace App\Http\Controllers;

use App\Helpers\LoggerHelpers;
use App\Helpers\MemcachedHelpers;
use App\Repositories\ZoneRepository;
use App\Repositories\NewsRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Validator;
use Exception;

class ApiController extends Controller
{
    protected $news;
    protected $zone;

    public function __construct(NewsRepository $news, ZoneRepository $zone)
    {
        $this->news = $news;
        $this->zone = $zone;
    }

    public function index(Request $request)
    {
        $seckey = $request->seckey;
        $action = $request->c;
        $url = $request->url;
        $catId = $request->catId;
        $parentId = $request->parentId;
        $newsId = $request->newsId;
        $page = $request->page;
        $timeCD = $request->timeCD;
        $type = $request->type;
        if ($action == "home") {
            if (!empty($catId)) {
                $request = Request::create('api/cachemanager/LiveEdit', 'GET', ['catId' => $catId, 'timeCD' => $timeCD, 'page' => $page]);
            } else {
                $request = Request::create('api/cachemanager/UpdateHome', 'GET', ['catId' => 0, 'timeCD' => $timeCD, 'page' => $page]);
            }
        } elseif ($action == "detail") {

            $request = Request::create('api/cachemanager/UpdateDetail', 'GET', ['url' => $url, 'timeCD' => $timeCD, 'page' => $page]);
        } elseif ($action == "adstore") {

            $request = Request::create('api/cachemanager/UpdateDetail', 'GET', ['url' => $url, 'timeCD' => $timeCD, 'page' => $page]);
        } elseif ($action == "clearcache") {

            $request = Request::create('api/cachemanager/ClearCache', 'GET', ['catId' => $catId, 'parentId' => $parentId, 'url' => $url, 'timeCD' => $timeCD, 'page' => $page]);
        } elseif ($action == "list") {

            $request = Request::create('api/cachemanager/UpdateList', 'GET', ['catId' => $catId, 'parentId' => $parentId, 'timeCD' => $timeCD, 'page' => $page]);
        } elseif ($action == "listbytype") {

            $request = Request::create('api/cachemanager/UpdateListByType', 'GET', ['type' => $type, 'timeCD' => $timeCD, 'page' => $page]);

        } elseif ($action == "changetitle" ) {

            $request = Request::create('api/cachemanager/ChangeTitle', 'GET', ['url' => $url, $newsId => !empty($newsId) ? $newsId : '', 'timeCD' => $timeCD, 'page' => $page]);

        }elseif ($action == "deletenews" ) {

            $request = Request::create('api/cachemanager/Delete', 'GET', ['url' => $url, $newsId => !empty($newsId) ? $newsId : '', 'timeCD' => $timeCD, 'page' => $page]);

        } elseif ($action == "videohome") {

            $request = Request::create('api/cachemanager/UpdateVideoHome', 'GET', ['timeCD' => $timeCD, 'page' => $page]);

        } elseif ($action == "videolist") {

            $request = Request::create('api/cachemanager/UpdateVideoList', 'GET', ['catId' => $catId, 'timeCD' => $timeCD, 'page' => $page]);

        } elseif ($action == "videodetail") {

            $request = Request::create('api/cachemanager/UpdateVideoDetail', 'GET', ['url' => $url, 'timeCD' => $timeCD, 'page' => $page]);

        } elseif ($action == "") {

            $request = Request::create('api/cachemanager/ClearCache', 'GET', ['url' => $url]);
        }
        $request->headers->set('seckey', $seckey);
        $response = app()->handle($request)->getContent();
        return response()->json(json_decode($response));
    }

    public function UpdateHome(Request $request)
    {
        $url = '/';
        $timeCD = $request->timeCD ?? '';
        $page = $request->page ?? 0;
        $arrUrl = [];
        try {
            $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
            $res=app()->handle($new_request);
            $infoRequest=(Object)["path"=>$url,'expireSeconds'=>86400, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
            array_push( $arrUrl,$infoRequest);

            LoggerHelpers::CallApiSetLog('UpdateHome', 'CallCacheApi');

            if (config('cachepage.ConfigUrlCache.TimeLineHome.Status')){
                $expire = 86400;
                //Check call to page Ajax
                if ($page == 0) {
                    for ($i = 2; $i <= 4; $i++) {
                        $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineHome.Url')??'',  $i);
                        $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD, 'expire' => $expire]);
                        $res= app()->handle($new_request1);
                        $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                        array_push( $arrUrl,$infoRequest);
                    }


                } else {
                    $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineHome.Url')??'',  $page);
                    $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                    $res= app()->handle($new_request1);
                    $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                    array_push( $arrUrl,$infoRequest);
                }
            }

            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }

    }

    public function UpdateList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'catId' => 'required',
        ]);
        if ($validator->fails()) {
            abort(response()->json([
                'status' => 0,
                'message' => $validator->errors()->all()
            ], 200));
        }
        $catId = $request->catId;
        $timeCD = $request->timeCD ?? '';
        $page = $request->page ?? 0;
        $zoneInfo = $this->zone->getZoneByKey($catId);
        $arrUrl = [];

        if (!empty($zoneInfo)) {
            $url = $zoneInfo->ZoneUrl ?? '';
        }
        try {
            if (!empty($url)){
                $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                $res= app()->handle($new_request);
                LoggerHelpers::CallApiSetLog('UpdateList catId=' . $catId, 'CallCacheApi');
                $infoRequest=(Object)["path"=>$url,'expireSeconds'=>86400, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                array_push( $arrUrl,$infoRequest);
                if (config('cachepage.ConfigUrlCache.TimeLineCat.Status')) {
                    $expire = 86400;
                    //Check call to page Ajax
                    if ($page == 0) {
                        for ($i = 2; $i <= 5; $i++) {
                            $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineCat.Url')??'',  $catId,$i);
                            $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD, 'expire' => $expire]);
                            $res= app()->handle($new_request1);
                            $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                            array_push( $arrUrl,$infoRequest);
                        }
                    } else {
                        $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineCat.Url')??'',  $catId,$page);
                        $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                        $res= app()->handle($new_request1);
                        $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                        array_push( $arrUrl,$infoRequest);
                    }
                }

                return response()->json([
                    'status' => 1,
                    'message' => 'Update List Cache Success',
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ]);

            }else{
                return response()->json([
                    'status' => 0,
                    'message' => 'Zone Id not found!',
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ], 200);
            }
        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }

    }

    public function UpdateListByType(Request $request)
    {
        $type = $request->type;
        $timeCD = $request->timeCD ?? '';
        $page = $request->page ?? 0;
        $arrUrl = [];

        if ($type == 13) {
            $url =config('cachepage.ConfigUrlCache.UrlNewsByType.13');
        }elseif ($type == 20) {
            $url = config('cachepage.ConfigUrlCache.UrlNewsByType.20');
        } elseif ($type == 27) {
            $url = config('cachepage.ConfigUrlCache.UrlNewsByType.27');
        } elseif ($type == 29) {
            $url = config('cachepage.ConfigUrlCache.UrlNewsByType.29');
        }elseif ($type == 0) {
            $url = config('cachepage.ConfigUrlCache.UrlNewsByType.0');
        }


        try {

            $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
            $res= app()->handle($new_request);
            $infoRequest=(Object)["path"=>$url,'expireSeconds'=>86400, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
            array_push( $arrUrl,$infoRequest);

            if (config('cachepage.ConfigUrlCache.TimeLineCatByType.Status')) {
                //Check call to page Ajax
                if ($page == 0) {
                    $expire = 86400;
                    for ($i = 2; $i <= 5; $i++) {
                        $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineCatByType.Url') ?? '', $type, $i);
                        $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD, 'expire' => $expire]);
                        $res= app()->handle($new_request1);
                        $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                        array_push( $arrUrl,$infoRequest);
                    }
                } else {
                    $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineCatByType.Url') ?? '', $type, $page);
                    $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                    $res= app()->handle($new_request1);
                    $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>0, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                    array_push( $arrUrl,$infoRequest);
                }
                LoggerHelpers::CallApiSetLog('UpdateListByType type=' . $type, 'CallCacheApi');
            }

            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }

    }

    public function UpdateDetail(Request $request)
    {
        $url = $request->url;
        $timeCD = $request->timeCD ?? '';
        $page = $request->page ?? 0;
        $validator = Validator::make($request->all(), [
            'url' => 'required'
        ]);
        $arrUrl = [];
        if ($validator->fails()) {
            abort(response()->json([
                'status' => 0,
                'message' => $validator->errors()->all()
            ], 200));
        }

        try {

            $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
            app()->handle($new_request);
            LoggerHelpers::CallApiSetLog('UpdateDetail url=' . $url, 'CallCacheApi');
            array_push( $arrUrl,$url);
            if (config('cachepage.ConfigUrlCache.TimeLineDetail.Status')) {
                //Check call to page Ajax
                if ($page == 0) {
                    $expire = 86400;
                    for ($i = 2; $i <= 5; $i++) {
                        $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineDetail.Url') ?? '',  $i);
                        $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD, 'expire' => $expire]);
                        $res= app()->handle($new_request1);
                        $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                        array_push( $arrUrl,$infoRequest);
                    }
                } else {
                    $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineDetail.Url') ?? '',  $page);
                    $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                    $res= app()->handle($new_request1);
                    $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>0, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                    array_push( $arrUrl,$infoRequest);
                }
            }

            return response()->json([
                'status' => 1,
                'message' => 'Update Detail Cache Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ]);
        } catch (\Throwable $th) {

            LoggerHelpers::CallApiSetLog('Err UpdateDetail url=' . $url, 'CallCacheApiErr');

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }

    }

    public function ClearCache(Request $request)
    {
        $prefix_Web = env('PREFIX_CACHE_WEB');
        $prefix_Mob = env('PREFIX_CACHE_MB');
        $url = $request->url??'';
        $catId = $request->catId??'';
        $parentId = $request->parentId??'';
        $newsId = $request->newsId??'';
        $timeCD = $request->timeCD ?? '';
        $arrUrl = [];

        if (!empty($url)) {

            $new_request = Request::create($url, 'GET');
            array_push( $arrUrl,$url);
            try {
                Route::dispatch($new_request);
                self::callProxy($url);
                $RouteName = Route::currentRouteName();
                $MemcacheServer = MemcachedHelpers::getMemcacheServer($RouteName);
                $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);
                $key_web = $prefix_Web . $request->url;
                $key_mb = $prefix_Mob . $request->url;
                $memcached->delete($key_web);
                $memcached->delete($key_mb);
                LoggerHelpers::CallApiSetLog('Clear Cache API Key: "' . $url . '"', 'clearCache');

            } catch (\Throwable $th) {

                return response()->json([
                    'status' => 0,
                    'message' => $th->getMessage(),
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ], 200);
            }
        }

        if (!empty($newsId)) {
            try {

                $news = $this->news->getKeyNewsPublish($newsId);
                $urlnews = $news->Url;
                array_push($urlnews, $arrUrl);
                self::callProxy($urlnews);
                $MemcacheServer = MemcachedHelpers::getMemcacheServer('page_detail');
                $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);
                $key_web = $prefix_Web . $urlnews;
                $key_mb = $prefix_Mob . $urlnews;
                $memcached->delete($key_web);
                $memcached->delete($key_mb);
                LoggerHelpers::CallApiSetLog('Clear Cache API Key: "' . $url . '"', 'clearCache');

            } catch (\Throwable $th) {

                return response()->json([
                    'status' => 0,
                    'message' => $th->getMessage(),
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ], 200);
            }
        }

        if (!empty($catId)) {
            try {

                $cat = $this->zone->getZoneByKey($catId);
                $urlcat = $cat->ZoneUrl;
                array_push($urlcat, $arrUrl);
                self::callProxy($urlcat);
                $MemcacheServer = MemcachedHelpers::getMemcacheServer("page_category");
                $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);
                $key_web = $prefix_Web . $urlcat;
                $key_mb = $prefix_Mob . $urlcat;
                $memcached->delete($key_web);
                $memcached->delete($key_mb);
                LoggerHelpers::CallApiSetLog('Clear Cache API CatId: "' . $catId . '"', 'clearCache');

            } catch (\Throwable $th) {

                return response()->json([
                    'status' => 0,
                    'message' => $th->getMessage(),
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ], 200);
            }
        }

        if (!empty($parentId)) {
            $listUrl = $this->zone->getUrlCategoryByParentId($parentId);
            try {

                $MemcacheServer = MemcachedHelpers::getMemcacheServer("page_category");
                $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);
                if (!empty($listUrl)) {
                    foreach ($listUrl as $value) {
                        $key_web = $prefix_Web . $value;
                        $key_mb = $prefix_Mob . $value;
                        $memcached->delete($key_web);
                        $memcached->delete($key_mb);
                    }
                }
                LoggerHelpers::CallApiSetLog('Clear Cache API parentId: "' . $parentId . '"', 'clearCache');

            } catch (\Throwable $th) {

                return response()->json([
                    'status' => 0,
                    'message' => $th->getMessage(),
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ], 200);
            }
        }

        return response()->json([
            'status' => 1,
            'message' => 'Success',
            'timecd' => $timeCD,
            'data' => $arrUrl,
        ]);
    }

    public function ChangeTitle(Request $request)
    {
        $prefix_Web = env('PREFIX_CACHE_WEB');
        $prefix_Mob = env('PREFIX_CACHE_MB');
        $arrUrl = [];
        $validator = Validator::make($request->all(), [
            'url' => 'required',
        ]);
        if ($validator->fails()) {
            abort(response()->json([
                'status' => 0,
                'message' => $validator->errors()->all()
            ], 200));

        }
        $url = $request->url;
        $timeCD = $request->timeCD ?? '';
        $MemcacheServer = MemcachedHelpers::getMemcacheServer('page_detail');
        $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);

        $key_web = $prefix_Web . $url;
        $key_mb = $prefix_Mob . $url;
        $memcached->delete($key_web);
        $memcached->delete($key_mb);

        try {

            $new_request = Request::create($url, 'GET', [ 'timeCD' => $timeCD]);
            app()->handle($new_request);
            self::callProxy($url);
            array_push( $arrUrl,$url);
            LoggerHelpers::CallApiSetLog('ChangeTitle url=' . $url, 'CallCacheApi');
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }
    }//Change Title

    public function LiveEdit(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'catId' => 'required',
        ]);
        if ($validator->fails()) {
            abort(response()->json([
                'status' => 0,
                'message' => $validator->errors()->all()
            ], 200));
        }

        $catId = $request->catId;
        $timeCD = $request->timeCD ?? '';
        $zoneInfo = $this->zone->getZoneByKey($catId);
        $arrUrl = [];
        if (!empty($zoneInfo)) {
            $url = $zoneInfo->ZoneUrl;
        }
        try {

            $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
            app()->handle($new_request);
            LoggerHelpers::CallApiSetLog('LiveEdit catId=' . $catId, 'CallCacheApi');
            array_push( $arrUrl,$url);
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }
    }//Live Edit

    public function UpdateVideoHome(Request $request)
    {
        $url = config('cachepage.ConfigUrlCache.UrlVideoHome');
        $timeCD = $request->timeCD ?? '';
        $page = $request->page ?? 0;
        $catId = 0;
        $arrUrl = [];
        try {

            $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
            $res= app()->handle($new_request);
            $infoRequest=(Object)["path"=>$url,'expireSeconds'=>86400, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
            array_push( $arrUrl,$infoRequest);

            if (config('cachepage.ConfigUrlCache.TimeLineVideoHome.Status')) {
                //Check call to page Ajax
                if ($page == 0) {
                    $expire = 86400;
                    for ($i = 2; $i <= 5; $i++) {
                        $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineVideoHome.Url') ?? '', $catId, $i);
                        $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD, 'expire' => $expire]);
                        $res= app()->handle($new_request1);
                        $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                        array_push( $arrUrl,$infoRequest);
                    }
                } else {
                    $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineVideoHome.Url') ?? '', $catId, $page);
                    $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                    $res= app()->handle($new_request1);
                    $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>0, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                    array_push( $arrUrl,$infoRequest);
                }
            }
            LoggerHelpers::CallApiSetLog('UpdateVideoHome ', 'CallCacheApi');
            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }
    }

    public function UpdateVideoDetail(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'url' => 'required'
        ]);
        if ($validator->fails()) {
            abort(response()->json([
                'status' => 500,
                'message' => $validator->errors()->all()
            ], 200));
        }
        $url = $request->url;
        $timeCD = $request->timeCD ?? '';
        $page = $request->page ?? 0;
        $catId = $request->catId ?? 0;
        $arrUrl = [];

        try {

            $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
            app()->handle($new_request);
            LoggerHelpers::CallApiSetLog('UpdateVideoDetail url=' . $url, 'CallCacheApi');
            array_push( $arrUrl,$url);

            if (config('cachepage.ConfigUrlCache.TimeLineVideoDetail.Status')) {
                if ($page == 0) {
                    $expire = 86400;
                    for ($i = 2; $i <= 5; $i++) {
                        $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineVideoDetail.Url') ?? '', $catId, $i);
                        $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD, 'expire' => $expire]);
                        $res= app()->handle($new_request1);
                        $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                        array_push( $arrUrl,$infoRequest);
                    }
                } else {
                    $urlAjaxPage =sprintf(config('cachepage.ConfigUrlCache.TimeLineVideoDetail.Url') ?? '', $catId, $page);
                    $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                    $res= app()->handle($new_request1);
                    $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>0, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                    array_push( $arrUrl,$infoRequest);
                }
            }

            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 200);
        }
    }

    public function UpdateVideoList(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'catId' => 'required',
        ]);
        $arrUrl = [];
        if ($validator->fails()) {
            abort(response()->json([
                'status' => 0,
                'message' => $validator->errors()->all()
            ], 200));
        }

        $catId = $request->catId;
        $timeCD = $request->timeCD ?? '';
        $page = $request->page ?? 0;
        $zoneVideo = $this->zone->getZoneVideo($catId);
        $arrUrl = [];
        if (empty($zoneVideo)) {
            return response()->json([
                'status' => 0,
                'message' => 'Zone Id not found!',
            ], 200);
        }
        $url = $zoneVideo->ZoneUrl;
        try {
            $new_request = Request::create($url, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
            app()->handle($new_request);
            LoggerHelpers::CallApiSetLog('UpdateVideoList catId=' . $catId, 'CallCacheApi');
            array_push( $arrUrl,$url);

            if (config('cachepage.ConfigUrlCache.TimeLineVideoCat.Status')) {
                //Check call to page Ajax
                if ($page == 0) {
                    $expire = 86400;
                    for ($i = 2; $i <= 5; $i++) {
                        $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineVideoCat.Url') ?? '', $catId, $i);
                        $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD, 'expire' => $expire]);
                        $res= app()->handle($new_request1);
                        $infoRequest=(Object)["path"=>$urlAjaxPage,'expireSeconds'=>$expire, "statusCode"=>!empty($res->getStatusCode())?$res->getStatusCode():0];
                        array_push( $arrUrl,$infoRequest);
                    }
                } else {
                    $urlAjaxPage = sprintf(config('cachepage.ConfigUrlCache.TimeLineVideoCat.Url') ?? '', $catId, $page);
                    $new_request1 = Request::create($urlAjaxPage, 'GET', ['isCache' => true, 'timeCD' => $timeCD]);
                    app()->handle($new_request1);
                    array_push($arrUrl, $urlAjaxPage);
                }
            }

            return response()->json([
                'status' => 1,
                'message' => 'Success',
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ]);

        } catch (\Throwable $th) {

            return response()->json([
                'status' => 0,
                'message' => $th->getMessage(),
                'timecd' => $timeCD,
                'data' => $arrUrl,
            ], 500);
        }
    }

    public function ClearCacheVideo(Request $request)
    {
        $prefix_Web = env('PREFIX_CACHE_WEB');
        $prefix_Mob = env('PREFIX_CACHE_MB');
        $url = $request->url;
        $timeCD = $request->timeCD ?? '';
        $arrUrl = [];
        if (!empty($url)) {

            $new_request = Request::create($url, 'GET');
            array_push( $arrUrl,$url);

            try {

                Route::dispatch($new_request);
                self::callProxy($url);
                $RouteName = Route::currentRouteName();
                $MemcacheServer = MemcachedHelpers::getMemcacheServer($RouteName);
                $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);
                $key_web = $prefix_Web . $request->url;
                $key_mb = $prefix_Mob . $request->url;
                $memcached->delete($key_web);
                $memcached->delete($key_mb);
                LoggerHelpers::CallApiSetLog('Clear Cache API Key: ' . $url, 'CallCacheApi');

            } catch (\Throwable $th) {

                return response()->json([
                    'status' => 0,
                    'message' => $th->getMessage(),
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ], 200);
            }
        }
        return response()->json([
            'status' => 1,
            'message' => 'Success',
            'timecd' => $timeCD,
            'data' => $arrUrl,
        ], 200);
    }

    public function Delete(Request $request)
    {
        $prefix_Web = env('PREFIX_CACHE_WEB');
        $prefix_Mob = env('PREFIX_CACHE_MB');
        $url = $request->url;
        $message = null;
        $timeCD = $request->timeCD ?? '';
        $arrUrl = [];
        if (!empty($url)) {
            $new_request = Request::create($url, 'GET');
            array_push( $arrUrl,$url);
            try {
                Route::dispatch($new_request);
                self::callProxy($url);
                $RouteName = Route::currentRouteName();
                $MemcacheServer = MemcachedHelpers::getMemcacheServer($RouteName);
                $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);
                $key_web = $prefix_Web . $request->url;
                $key_mb = $prefix_Mob . $request->url;
                $memcached->delete($key_web);
                $memcached->delete($key_mb);
            } catch (Exception $e) {
                return response()->json([
                    'status' => 0,
                    'message' => $e->getMessage(),
                    'timecd' => $timeCD,
                    'data' => $arrUrl,
                ], 200);
            }
        }
        return response()->json([
            'status' => 1,
            'message' => 'Success',
            'timecd' => $timeCD,
            'data' => $arrUrl,
        ]);
    }

    public function DeleteArticle(Request $request)
    {
        $apiurl = $request->header('apiurl');
        $apiaction = $request->header('apiaction');
        if (!env('SITE_MOBILE')) {
            $Domain = env('DOMAIN_CALL_API_PROXY');
        } else {
            $Domain = env('DOMAIN_CALL_API_PROXY_M');
        }
        $response = 400;

        if (!empty($apiaction)) {
            switch ($apiaction) {
                case "flush_proxy":
                    {
                        $request_param = [
                            'domain' => $Domain,
                            'command' => 'flush_all',
                        ];
                        $request_data = json_encode($request_param, JSON_UNESCAPED_SLASHES);
                        $client = new Client();
                        $res = $client->request(
                            'POST',
                            url(env('URL_CALL_API_PROXY')),
                            [
                                'timeout' => 1,
                                'connect_timeout' => 1,
                                'headers' => [
                                    'Accept' => 'application/json',
                                ],
                                'body' => $request_data
                            ]
                        );
                        $res = $res->getBody()->getContents();;
                        $res = json_decode($res);
                        $response = 'OK';
                        if (empty($res->response)) {
                            $response = 400;
                        }
                    }
                    break;
                case "delete_all":
                    {
                        try {
                            $memcache_server = config('cachepage.CachePage.MemcacheServer');
                            foreach ($memcache_server as $key => $value) {
                                $memcached = new Memcached;
                                $memcached->addServer($value['host'], $value['port']);
                                $memcached->flush();
                            }
                            $response = 'OK';
                        } catch (Exception $e) {
                            $response = 400;
                        }
                    }
                    break;
                case "delete":
                    {
                        try {
                            if (!empty($apiurl)) {
                                $new_request = Request::create($apiurl, 'GET');
                                $prefix_Web = env('PREFIX_CACHE_WEB');
                                $prefix_Mob = env('PREFIX_CACHE_MB');
                                if (!env('SITE_MOBILE')) {
                                    $prefix = $prefix_Web;
                                } else {
                                    $prefix = $prefix_Mob;
                                }
                                Route::dispatch($new_request);
                                $RouteName = Route::currentRouteName();
                                $MemcacheServer = MemcachedHelpers::getMemcacheServer($RouteName);
                                $memcached = MemcachedHelpers::connectMemcached($MemcacheServer);
                                $memcached->delete($prefix . $apiurl);

                                //Clear proxy
                                $request_param = [
                                    'domain' => $Domain,
                                    'url' => $apiurl,
                                    'expire' => 1,
                                ];
                                $request_data = json_encode($request_param, JSON_UNESCAPED_SLASHES);
                                $client = new Client();
                                $response = $client->request(
                                    'POST',
                                    url(env('URL_CALL_API_PROXY')),
                                    [
                                        'timeout' => 1,
                                        'connect_timeout' => 1,
                                        'headers' => [
                                            'Accept' => 'application/json',
                                        ],
                                        'body' => $request_data
                                    ]
                                );
                                $response = $response->getBody()->getContents();
                                $response = 'OK';
                            } else {
                                $response = 400;
                            }
                        } catch (Exception $e) {
                            $response = 400;
                        }
                    }
                    break;
            }

            if ($response == 'OK') {
                return $response;
            } else {
                return response(['status' => 'BadRequest'], 400);
            }
        } else
            return response(['status' => 'BadRequest'], 400);
    }

    public function callProxy($Path)
    {
        if (env('STATUS_PROXY_CACHE')) {
            if (!env('SITE_MOBILE')) {
                $Domain = env('DOMAIN_CALL_API_PROXY');
            } else {
                $Domain = env('DOMAIN_CALL_API_PROXY_M');
            }
            // Call Api Proxy
            $request_param = [
                'domain' => $Domain,
                'url' => $Path,
                'expire' => 1,
            ];

            try {
                $request_data = json_encode($request_param, JSON_UNESCAPED_SLASHES);
                $client = new Client();
                $response = $client->request(
                    'POST',
                    url(env('URL_CALL_API_PROXY')),
                    [
                        'timeout' => 5,
                        'connect_timeout' => 5,
                        'headers' => [
                            'Accept' => 'application/json',
                        ],
                        'body' => $request_data
                    ]
                );
            } catch (\Throwable $th) {

            }
        }
    }

}
