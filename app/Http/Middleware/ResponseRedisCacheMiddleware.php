<?php

namespace App\Http\Middleware;

use App\Helpers\LoggerHelpers;
use App\Helpers\UserInterfaceHelper;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;


class ResponseRedisCacheMiddleware
{

    /**
     * Handle an incoming request.
     *
     * @param \Illuminate\Http\Request $request
     * @param \Closure $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $cachepage = config('cachepage.CachePage');
        $userAgent = $request->header('user-agent');

        //Check Status Cache
        if ($cachepage['Enable']) {

            //Set Domain Call Cache Proxy + Prefix Cache
            if (!env('SITE_MOBILE')) {
                $prefix = env('PREFIX_CACHE_WEB');  //Set prefix cache Web
                $domain = env('DOMAIN_CALL_API_PROXY');
            } else {
                $prefix = env('PREFIX_CACHE_MB');//Set prefix cache Mob
                $domain = env('DOMAIN_CALL_API_PROXY_M');
            }
            $pages = $cachepage['Pages'] ?? [];//Get info page cache
            $routeName = $request->route()->getName();//Get routeName
            $path = $request->getPathInfo();
            if ($routeName == 'loadMoreJson' || $routeName == 'loadMoreJsonApi') {
                $path = $request->getRequestUri();
            }
            $key = $prefix . $path;//Set key set cache theo path
            $requestUri = $request->getRequestUri();

            //Get info cache to route name
            $cacheInfo = collect($pages)->where('RouteName', $routeName)->values()->first();
            $cacheServer = $cacheInfo['Server'] ?? '';

            if ($cacheInfo) {

                $expire = $cacheInfo['ExpireSeconds'] ?? '';
                //Set expire page loadmore
                $pageIndex = $request->route()->parameter('pageIndex');
                if (!empty($pageIndex) && $pageIndex < 6 && !empty($cacheInfo['Monitor']) && $cacheInfo['Monitor']) {
                    $expire = 86400;
                }
                $dateNow = date('d/m/Y H:i:s');
                $lastModifiedDate = date('d/m/Y H:i:s');
                $timeCD = $request->timeCD ?? ''; //Time Cd monitor put

                //Cache ==true
                if ($cachepage['RedisCached']) {
                    //Connect Cache
                    try {
                        $redisCached = Cache::store($cachepage['RedisCacheSerVer'][$cacheServer] ?? 'redis')->tags(config('cache.prefix'));
                        $statusCacheConnect = true;
                        $isCacheRedis=true;
                    } catch (\Throwable $th) {
                        $statusCacheConnect = false;
                        $isCacheRedis=false;
                    }

                    try {
                        //Request với monitor = true || call cache manual
                        if (!empty($request->isCache) || !empty($request->isCacheManual)) {
                            $response = $next($request);
                            //getLastModifiedDate page detail
                            if ($routeName == 'page_detail' && $response->status() == 200) {
                                $getlastModifiedDate = UserInterfaceHelper::getLastModifiedDate($response->getContent());
                                $lastModifiedDate = $getlastModifiedDate['lastModifiedDate'] ?? $lastModifiedDate;
                                $expire = $getlastModifiedDate['expire'] ?? $expire;
                                $isCacheRedis= $getlastModifiedDate['isCacheRedis'] ?? true;
                            }
                            if (!empty($request->isCache)) {
                                $txtAddBody = '<!--s: ' . $dateNow . '-->  <!--CachedInfo:LastModifiedDate: ' . $lastModifiedDate . ' | TimeCD: ' . $timeCD . '-->';
                            } else {
                                $txtAddBody = '<!--u: ' . $dateNow . '-->  <!--CachedInfo:LastModifiedDate: ' . $lastModifiedDate . '-->';
                            }

                            if (($response->status() == 200) && !empty($response->getContent())) {
                                if ($statusCacheConnect && $isCacheRedis) {
                                    $redisCached->set($key, $response->getContent() . $txtAddBody, $expire);
                                }

                                //ProxyCache==true Call cache proxy
                                if ($cachepage['ProxyCache']) {
                                    if (!empty($cacheInfo['Monitor']) && $cacheInfo['Monitor']) {
                                        self::callApiProxy($domain, $path, $expire);
                                    }
                                }

                            } elseif ($response->status() == 404) {

                                LoggerHelpers::CallApiSetLog('404 url=[' . $requestUri . ']', '404');

                            }

                            $response->header('timeexpire', $expire)->header('timecd', $timeCD)->header('lastmodifieddate', $lastModifiedDate);
                            $response->header('servername', env('SEVERNAME'))->header('Cache-Control', 'no-cache');
                            return $response;

                        } else { // Request thường

                            //Get cache
                            if (($statusCacheConnect) && $redisCached->get($key)) {
                                $content = $redisCached->get($key);
                                if (str_contains($userAgent, 'Chrome-Lighthouse')) {
                                    $content = str_replace("</title>", "</title><meta name=\"uc:useragent\" content=\"$userAgent\">", $content);
                                }
                                $response = response($content);
                                if ($routeName == 'page_detail' && $response->status() == 200) {
                                    $getlastModifiedDate = UserInterfaceHelper::getLastModifiedDate($response->getContent());
                                    $lastModifiedDate = $getlastModifiedDate['lastModifiedDate'] ?? $lastModifiedDate;
                                    $expire = $getlastModifiedDate['expire'] ?? $expire;
                                }

                                $response->header('lastmodifieddate', $lastModifiedDate)->header('timeexpire', $expire);
                                $response->header('servername', env('SEVERNAME'))->header('Cache-Control', 'no-cache');

                                if ($routeName == 'loadMoreJson') {
                                    $data = $response->getContent();
                                    return response()->json(json_decode($data), 200)->header('timecache', "<!--u: " . $dateNow . '-->')->header('timeexpire', $expire);
                                } elseif ($routeName == 'loadMoreJsonApi' || $routeName=='loadJsonApi') {
                                    return $response->header('timeexpire', 1)->header('timecache', "<!--u: " . $dateNow . '-->')->header('Content-Type', 'application/json;charset=UTF-8');
                                }
                                return $response;

                            }// Has key return response

                            $response = $next($request);
                            //Log 404
                            if ($response->status() == 404) {
                                LoggerHelpers::CallApiSetLog('404 url=[' . $requestUri . ']', '404');
                            }
                            //getLastModifiedDate page detail
                            if ($routeName == 'page_detail' && $response->status() == 200) {
                                $getlastModifiedDate = UserInterfaceHelper::getLastModifiedDate($response->getContent());
                                $lastModifiedDate = $getlastModifiedDate['lastModifiedDate'] ?? $lastModifiedDate;
                                $expire = $getlastModifiedDate['expire'] ?? $expire;
                                $isCacheRedis= $getlastModifiedDate['isCacheRedis'] ?? true;
                            }
                            //Set cache
                            if ($response->status() == 200 && !empty($response->getContent()) && $statusCacheConnect && $isCacheRedis) {
                                $txtAddBody = "<!--u: $dateNow -->";
                                if ($routeName == 'loadMoreJson' || $routeName == 'loadMoreJsonApi') {
                                    $txtAddBody = '';
                                }
                                $redisCached->set($key, $response->getContent() . $txtAddBody, $expire);
                            }

                            $response->header('lastmodifieddate', $lastModifiedDate)->header('timeexpire', $expire);
                            $response->header('servername', env('SEVERNAME'))->header('Cache-Control', 'no-cache');
                            return $response;
                        }
                    } catch (\Throwable $th) {
                        LoggerHelpers::CallApiSetLog('Message=[' . $th->getMessage() . ']', 'ErrMiddlewareCache');
                    }

                    $response = $next($request);
                    $response->header('timeexpire', $expire)->header('lastmodifieddate', $lastModifiedDate);
                    $response->header('servername', env('SEVERNAME'))->header('Cache-Control', 'no-cache');
                    return $response;
                }

            } else {
                $response = $next($request);
                $response->header('timeexpire', 1)->header('servername', env('SEVERNAME'))->header('Cache-Control', 'no-cache');
                return $response;
            }
        }

        $response = $next($request);
        if (str_contains($userAgent, 'Chrome-Lighthouse')) {
            $content = str_replace("</title>", "</title><meta name=\"uc:useragent\" content=\"$userAgent\">", $response->getContent());
            $response = response($content);
        }
        $response->header('timeexpire', 1)->header('servername', env('SEVERNAME'))->header('Cache-Control', 'no-cache');
        return $response;

    }


    public function callApiProxy($domain, $path, $expire)
    {
        try {

            // Call Api Proxy
            $request_param = [
                'domain' => $domain,
                'url' => $path,
                'expire' => $expire,
            ];
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
            if ($response->getStatusCode() == 200 && !empty($response->getBody())) {
                LoggerHelpers::CallApiSetLog('ProxyCache set url=[' . $path . ']' . $response->getBody(), 'CallCacheProxyOk');
            } else {
                LoggerHelpers::CallApiSetLog('ProxyCache set url=[' . $path . ']', 'CallCacheProxyErr');
            }

        } catch (\Throwable $e) {

            LoggerHelpers::CallApiSetLog('ProxyCache Call Err:' . $e->getMessage() . ']', 'CallCacheProxyErr');
        }
    }

}
