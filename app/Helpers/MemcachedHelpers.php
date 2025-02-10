<?php

namespace App\Helpers;

use Memcached;

class MemcachedHelpers
{
    public static function getExpireSeconds($routeName)
    {
        $cachepage = config('cachepage.CachePage');
        $Pages = $cachepage['Pages'];
        foreach ($Pages as $value) {
            if (!empty($value['RouteName']) && $value['RouteName'] === $routeName) {
                $expire = $value['ExpireSeconds'];
            }// Check RouteName
        }
        return $expire;
    }

    public static function connectMemcached($server)
    {
        $memcache_server = config('cachepage.CachePage.MemcacheServer.' . $server);
        $memcached = new Memcached;
        $memcached->addServers([$memcache_server]);
        return $memcached;
    }

    public static function getMemcacheServer($routeOrPath)
    {

        $cachepage = config('cachepage.CachePage');
        $Pages = $cachepage['Pages'];
        $RouteName = $Path = $routeOrPath;
        $memcache_server = null;

        foreach ($Pages as $value) {
            if (!empty($value['RouteName']) && $value['RouteName'] === $RouteName) {
                $memcache_server = $value['Server'];
            }// Check RouteName
            if (!empty($value['Path']) && preg_match('%^' . $value['Path'] . '.*?%', $Path, $regs)) {
                $memcache_server = $value['Server'];
            }// Check Path
        }
        return $memcache_server;
    }
}
