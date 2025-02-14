<?php
return
    $homeKey = [
        'featuredTopics' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox')??'',0,3),
            'start' => 0,
            'stop' => 4,
        ],
        'trendPost' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyMostView')??'',0,24),
            'start' => 0,
            'stop' => 4,
        ],
        'homePost' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyNewsPosition')??'',0,1),
            'start' => 0,
            'stop' => 20,
            'callbackHgetAll' => true
        ],
        'homePostMore' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsInZoneIsOnHome')??'',0),
            'start' => 0,
            'stop' => 19,
        ],

    ];
