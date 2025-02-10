<?php

namespace App\Http\Controllers;

use App\Helpers\LoggerHelpers;
use App\Helpers\MemcachedHelpers;
use App\Repositories\RedisPipeLineRepository;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Memcached;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\MessageBag;

class CacheManagerController extends Controller
{
    protected $redisPipeLine;

    public function __construct(
        RedisPipeLineRepository $redisPipeLine
    ) {
        $this->redisPipeLine = $redisPipeLine;
    }
    public function index(Request $request){
        $sectionKey = $request->session()->get('KEY_MANAGER_LOGIN');
        if ( !empty($request->secret_key) && $request->secret_key==env('SECRET_KEY')){
            return view('manager.cache');
        }else{
            return view('manager.login');
        }
    }


    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function manager(Request $request)
    {
        //Link cache tay
        $path = filter_var($request->path, FILTER_SANITIZE_STRING);
        $action = filter_var($request->action, FILTER_SANITIZE_STRING);
        switch ($action) {
            case 'update': {
                    try {
                        $new_request = Request::create($path, 'GET', ['isCacheManual' => true]);
                        app()->handle($new_request);
                        return response()->json([
                            'status' => 200,
                            'message' => 'Cập nhật cache thành công!'
                        ]);
                    } catch (Exception $e) {
                        return  response()->json([
                            'status' => 500,
                            'message' => 'Có lỗi xảy ra vui lòng kiểm tra lại!'
                        ], 500);
                    }
                }

            case 'delete': {
                    $new_request = Request::create($path, 'GET');
                    try {
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
                        $memcached->delete($prefix . $path);

                        Log::channel('clearCache')->info('Delete Cache Manual: ' . $path);
                        return  response()->json([
                            'status' => true,
                            'message' => 'Xóa cache key "' . $path . '" thành công!'
                        ]);
                    } catch (Exception $e) {
                        return  response()->json([
                            'status' => false,
                            'message' => 'Url không tồn tại!'
                        ]);
                    }
                }

            case 'flush': {
                    //          Cache::flush();
                    $memcache_server = config('cachepage.CachePage.MemcacheServer');
                    foreach ($memcache_server as $key => $value) {
                        $memcached = new Memcached;
                        $memcached->addServer($value['host'], $value['port']);
                        $memcached->flush();
                    }
                    Log::channel('clearCache')->info('Clear All Cache Manual');
                    return  response()->json([
                        'status' => true,
                        'message' => 'Clear all cache thành công!'
                    ]);
                }

            case 'flush_proxy': {
                    if (!env('SITE_MOBILE')) {
                        $Domain = env('DOMAIN_CALL_API_PROXY');
                    } else {
                        $Domain = env('DOMAIN_CALL_API_PROXY_M');
                    }
                    if (!empty($path)) {
                        // Flush Proxy by url
                        $request_param = [
                            'domain' => $Domain,
                            'url' => $path,
                            'expire' => 1,
                        ];
                        $request_data = json_encode($request_param, JSON_UNESCAPED_SLASHES);
                        $client = new Client();
                        $response = $client->request(
                            'POST',
                            url(env('URL_CALL_API_PROXY')),
                            [
                                'headers' => [
                                    'Accept'     => 'application/json',
                                ],
                                'body'   => $request_data
                            ]
                        );

                        $response = $response->getBody()->getContents();;
                        $response = json_decode($response);
                    } else {
                        // Flush all proxy

                        $request_param = [
                            'domain' => $Domain,
                            'command' => 'flush_all',
                        ];
                        $request_data = json_encode($request_param, JSON_UNESCAPED_SLASHES);
                        $client = new Client();
                        $response = $client->request(
                            'POST',
                            url(env('URL_CALL_API_PROXY')),
                            [
                                'headers' => [
                                    'Accept'     => 'application/json',
                                ],
                                'body'   => $request_data
                            ]
                        );
                        $response = $response->getBody()->getContents();;
                        $response = json_decode($response);
                        //                if (!empty($response)){
                        //                    $response=$response->response;
                        //                }
                    }
                    if (!$response) {
                        return  response()->json([
                            'status' => false,
                            'message' => $response
                        ]);
                    }
                    return  response()->json([
                        'status' => true,
                        'message' => $response,
                    ]);
                }

            case 'cache_proxy': {
                    //Cache proxy theo Path
                    if (!env('SITE_MOBILE')) {
                        $Domain = env('DOMAIN_CALL_API_PROXY');
                    } else {
                        $Domain = env('DOMAIN_CALL_API_PROXY_M');
                    }
                    // Call Api Proxy

                    $request_param = [
                        'domain' => $Domain,
                        'url' => $path,
                        'expire' => env('EXPIRE_CACHE_PROXY'),
                    ];
                    //            dd($request_param);
                    $request_data = json_encode($request_param);
                    $client = new Client();
                    $response = $client->request(
                        'POST',
                        url(env('URL_CALL_API_PROXY')),
                        [
                            'headers' => [
                                'Accept'     => 'application/json',
                            ],
                            'body'   => $request_data
                        ]
                    );
                    $response = $response->getBody()->getContents();;
                    $response = json_decode($response);
                    //            if (!empty($response)){
                    //                $response=$response->response;
                    //            }
                    if (!$response) {
                        return  response()->json([
                            'status' => false,
                            'message' => $response,
                        ]);
                    }
                    return  response()->json([
                        'status' => true,
                        'message' => $response,
                    ]);
                }

            case 'remove_port': {
                    //Remove Port by Server Memcache
                    $server = $path;
                    $memcache_server = config('cachepage.CachePage.MemcacheServer.' . $server);

                    if (!$memcache_server) {
                        return  response()->json([
                            'status' => false,
                            'message' => 'Server Cache : ' . $server . ' Undefined'
                        ]);
                    } else {
                        $memcached = MemcachedHelpers::connectMemcached($server);
                        $memcached->flush();
                        return  response()->json([
                            'status' => true,
                            'message' => 'Clear port ' . $path . ' thành công!'
                        ]);
                    }
                }

            case 'clearZone': {
                Cache::store('zone')->clear();
                Cache::store('zoneUrl')->clear();
                return  response()->json([
                    'status' => true,
                    'message' => 'Clear Zone thành công!'
                ]);
            }
        }

        return  response()->json([
            'status' => false,
            'message' => 'Error'
        ]);
    }

    public function postLogin(Request $request){
        $key=$request->key;
        $secret_key = $request->secret_key;
        $key = filter_var( $key,FILTER_SANITIZE_STRING);
        $secret_key = filter_var( $secret_key,FILTER_SANITIZE_STRING);

        if ($key === config('siteInfo.login_key') && $secret_key === env('SECRET_KEY')){
            $request->session()->put('KEY_MANAGER_LOGIN', $key);
            $request->session()->put('KEY_MANAGER_SECRET', $secret_key);
            return redirect()->route('view_cache_manager',['secret_key' => $secret_key]);
        }

        $errors = new MessageBag(['errorlogin' => 'Mật khẩu không đúng']);
        return redirect()->back()->withInput()->withErrors($errors);
    }

    public function viewRedis(Request $request){
        if (!empty($request->key) && $request->key=='ws'){
            return view('manager.view-redis');
        }else{
            return abort(404);
        }
    }

    public function getKeyRedis(Request $request){
        try {
            $ad=$request->ad;
            $key=$request->key;
            $dataType=$request->dataType;
            $order=(int)$request->order;
            $index=$request->index;
            $take=$request->take;
            $ad=$request->ad;
            $configKey = [
                'type' => [
                    'cmd' => 'type',
                    'key' => $key,
                    'start' => 0,
                    'stop' => 0,
                ]
            ];
            $redisNews=config('database.redis.default');
            $redisDetail=config('database.redis.news_content');
            $redisInfo['redisNews']['connectionString']=$redisNews;
            $redisInfo['redisDetail']['connectionString']=$redisDetail;
            $pipelineData = $this->redisPipeLine->getDataByPipeLine($configKey);
            $start= ($index-1)*$take;
            $stop=$index*$take;
            $message='False';
            if($pipelineData['type']=='none') {

                $data = [];
            }elseif ($pipelineData['type']=='hash') {

                $configKey = [
                    'Data' => [
                        'cmd' => 'hGetAll',
                        'key' => $key,
                        'start' => !empty($start) ? $start : 0,
                        'stop' => !empty($stop) ? $stop : 9,
                    ]
                ];
                $pipelineData = $this->redisPipeLine->getDataByPipeLine($configKey);
                $data = (string)json_encode($pipelineData['Data']);
                $message = 'Success';
            }elseif ($pipelineData['type']=='zset') {

                $configKey = [
                    'Data' => [
                        'cmd' => ($order == 1) ? 'zrevrange' : 'zRange',
                        'key' => $key,
                        'start' => !empty($start) ? $start : 0,
                        'stop' => !empty($stop) ? $stop : 9,
                    ]
                ];
                $pipelineData = $this->redisPipeLine->getDataByPipeLine($configKey);
                $data = (string)json_encode($pipelineData['Data']);
                $message = 'Success';
            }elseif ($pipelineData['type']=='string'){
                $configKey= [
                    'Data' => [
                        'cmd' => 'get',
                        'key' => $key,
                        'start' =>!empty($start)?$start:0,
                        'stop' => !empty($stop)?$stop:9,
                    ]
                ];
                $pipelineData = $this->redisPipeLine->getDataByPipeLine($configKey);
                $data=$pipelineData['Data'];
                $message='Success';
            }
            return response()->json([
                'data' => $data,
                'message' => $message,
                'redisInfo' => ($ad==='ws'||$ad==='anhnt')?$redisInfo:'',
                'result' => 1,
            ]);
        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Get pipelineRedis Views Error:'.$th->getMessage(), 'RedisEx');
        }
    }
}
