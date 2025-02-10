<?php

namespace App\Http\Middleware;

use App\Helpers\LoggerHelpers;
use App\Helpers\MemcachedHelpers;
use App\Helpers\UserInterfaceHelper;
use Closure;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Exception;


class ResponseCacheMiddleware
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

        if ($cachepage['Enable']) { //Check có bật cache hay không

            //Set Domain call proxy
            if (!env('SITE_MOBILE')) {
                $prefix = env('PREFIX_CACHE_WEB');  //Set prefix cache Web
                $domain = env('DOMAIN_CALL_API_PROXY');
            } else {
                $prefix = env('PREFIX_CACHE_MB');//Set prefix cache Mob
                $domain = env('DOMAIN_CALL_API_PROXY_M');
            }

            $key = $prefix . $request->getPathInfo();//Set key set cache theo path
            $pages = $cachepage['Pages'];//Get info page cache
            $routeName = $request->route()->getName();//Get routeName
            $path = $request->getPathInfo();
            $requestUri = $request->getRequestUri();
            $cacheInfo = null;
            $memcache_server = null;


            if($routeName=='loadMoreJson'){
                $path = $request->getRequestUri();
                $key = $prefix . $path;
            }

            foreach ($pages as $value) {
                if (!empty($value['RouteName']) && $value['RouteName'] === $routeName) {
                    $cacheInfo = $value;
                    $memcache_server = $value['Server'];
                }// Check RouteName
                if (!empty($value['Path']) && preg_match('%^' . $value['Path'] . '.*?%', $path, $regs)) {
                    $cacheInfo = $value;
                    $memcache_server = $value['Server'];
                }// Check Path
            }//If has RouteName get managercache page Expire , if has Path get managercache page Expire

            if ($cacheInfo) {
                //Có thông tin trong config cache
                $expire = $cacheInfo['ExpireSeconds']; //Get time
                $pageIndex=$request->route()->parameter('pageIndex');
                if (!empty($pageIndex) && $pageIndex <6 && !empty($cacheInfo['Monitor']) && $cacheInfo['Monitor']){
                    $expire=86400;
                }
                $date = date('d/m/Y H:i:s');
                $lastModifiedDate = date('d/m/Y H:i:s');
                $timeCD=$request->timeCD??''; //Time Cd monitor put

                //Memcached ==true
                if ($cachepage['Memcached']) {
                    //Connect memcached
                    $memcached = MemcachedHelpers::connectMemcached($memcache_server);

                    //Request với monitor = true hoặc call qua toll cache
                    if (!empty($request->isCache) || !empty($request->isCacheManual)) {
                        $response = $next($request);

                        //getLastModifiedDate page detail
                        if($routeName=='page_detail'){
                            $lastModifiedDate=UserInterfaceHelper::getLastModifiedDate($response->getContent());
                        }
                        if (!empty($request->isCache)){
                            $txtAddBody='<!--s: ' . $date . '-->  <!--CachedInfo:LastModifiedDate: ' . $lastModifiedDate . '|TimeCD: '.$timeCD.'-->';
                        }else{
                            $txtAddBody='<!--u: ' . $date . '-->  <!--CachedInfo:LastModifiedDate: ' . $lastModifiedDate .'-->';
                        }

                        if (($response->status() == 200 || $response->status() == 301) && !empty($response->getContent())) {
                            $memcached->set($key, $response->getContent() .$txtAddBody , $expire);

                            //Nếu ProxyCache==true call API Proxy
                            if ($cachepage['ProxyCache']) {
                                if (!empty($cacheInfo['Monitor']) && $cacheInfo['Monitor']) {
                                    self::callApiProxy($domain, $path, $expire);
                                }
                            }

                        } elseif ($response->status() == 404) {

                            LoggerHelpers::CallApiSetLog('404 url=[' . $requestUri . ']' , '404');

                        }

                        $response->header('timeexpire', $expire);
                        $response->header('timecd', $timeCD);
                        $response->header('lastmodifieddate', $lastModifiedDate);
                        $response->header('servername', env('SEVERNAME'));
                        $response->header('X-Frame-Options', 'SAMEORIGIN');
                        $response->header('Cache-Control', 'no-cache');



                        return $response;

                    }
                    else { // Request thường

                        //Get cache nếu đã có trong memcached
                        if ($memcached->get($key)) {
                            $content=$memcached->get($key);
                            $userAgent = $request->header('user-agent');
                            if (str_contains($userAgent,'Chrome-Lighthouse')){
                                $content=str_replace("</title>", "</title><meta name=\"uc:useragent\" content=\"$userAgent\">",$content);
                            }
                            $response = response($content);

                            if($routeName=='page_detail'){
                                $lastModifiedDate=UserInterfaceHelper::getLastModifiedDate($response->getContent());
                            }

                            $response->header('timeexpire', $expire);//add timeexpire==expire
                            $response->header('lastmodifieddate', $lastModifiedDate);
                            $response->header('servername', env('SEVERNAME'));
                            $response->header('X-Frame-Options', 'SAMEORIGIN');
                            $response->header('Cache-Control', 'no-cache');

                            if ($routeName == 'loadMoreJson') {
                                $data =  $response->getContent();
                                return response()->json(json_decode($data), 200)->header('timecache', "<!--u: " . $date . '-->')->header('timeexpire', $expire);
                            }elseif ($routeName=='loadMoreJsonApi' || $routeName=='loadJsonApi'){
                                return $response->header('timeexpire', 1)->header('Content-Type' , 'application/json;charset=UTF-8');
                            }
                            return $response;

                        }// Has key return response
                        $response = $next($request);

                        //Set log 404
                        if ($response->status() == 404) {
                            LoggerHelpers::CallApiSetLog('404 url=[' . $requestUri . ']' , '404');
                        }

                        //Put cache memcached nếu chưa set cache
                        if ($routeName == 'loadMoreJson' || $routeName =='loadMoreJsonApi') {
                            if ($response->status() == 200 && !empty($response->getContent())) {
                                $memcached->set($key, $response->getContent(), $expire);
                            }

                        } else {
                            if ($response->status() == 200 && !empty($response->getContent())) {
                                $memcached->set($key, $response->getContent() . "<!--u: " . $date . '-->', $expire);
                            }
                        }
                        //getLastModifiedDate page detail
                        if($routeName=='page_detail'){
                            $lastModifiedDate=UserInterfaceHelper::getLastModifiedDate($response->getContent());
                        }
                        $response->header('lastmodifieddate', $lastModifiedDate);
                        $response->header('timeexpire', $expire);//add timeexpire==expire
                        $response->header('servername', env('SEVERNAME'));
                        $response->header('X-Frame-Options', 'SAMEORIGIN');
                        $response->header('Cache-Control', 'no-cache');

                        return $response;
                    }
                }
            }
            else{
                $response = $next($request);
                //Không có trong config cache
                $response->header('timeexpire', 1);
                $response->header('servername', env('SEVERNAME'));
                $response->header('X-Frame-Options', 'SAMEORIGIN');
                $response->header('Cache-Control', 'no-cache');
                return $response;
            }
        }
        $response = $next($request);
        $response->header('timeexpire', 1);
        $response->header('servername', env('SEVERNAME'));
        $response->header('X-Frame-Options', 'SAMEORIGIN');
        $response->header('Cache-Control', 'no-cache');
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
                    'connect_timeout' =>5,
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

        }catch (\Throwable $e){

            LoggerHelpers::CallApiSetLog('ProxyCache Call Err:' . $e->getMessage() . ']' , 'CallCacheProxyErr');
        }
    }

}
