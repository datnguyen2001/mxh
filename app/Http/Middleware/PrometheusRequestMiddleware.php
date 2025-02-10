<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Prometheus\CollectorRegistry;
use Prometheus\Storage\Redis;
use Prometheus\Storage\InMemory;
use Prometheus\RenderTextFormat;
class PrometheusRequestMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);
        Redis::setDefaultOptions( [
            'host' => env('REDIS_HOST', '127.0.0.1'),
            'password' => env('REDIS_PASSWORD', null),
            'port' => env('REDIS_PORT', '6379'),
            'timeout' => 0.1, // in seconds
            'read_timeout' => '10', // in seconds
            'persistent_connections' => false
        ]);
        $registry = CollectorRegistry::getDefault();
//        $registry->wipeStorage();
        $histogram = $registry->registerHistogram('http_requests', 'duration_seconds', 'sum', array('code', 'method','controller'), array(0.001, 0.002, 0.004, 0.008,0.016,0.032,0.064,0.128));
        $histogram->observe(1,  array($response->status(),$request->getMethod(),$request->route()->getActionName()));

        $counter = $registry->getOrRegisterCounter('http_requests_received', 'total', 'it increases', array('code','method','controller'));
        $counter->incBy(1, array($response->status(),$request->getMethod(),$request->route()->getActionName()));
//
//        $renderer = new RenderTextFormat();
//        $result = $renderer->render($registry->getMetricFamilySamples());
//
//        header('Content-type: ' . RenderTextFormat::MIME_TYPE);
//        echo $result;
        return $next($request);
    }
}
