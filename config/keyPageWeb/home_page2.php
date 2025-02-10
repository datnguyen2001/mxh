<?php
return
    $homeKey = [
        'boxVideo' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox') ?? '', 0, 4),
            'start' => 0,
            'stop' => 9
        ],
        'boxAnh' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox') ?? '', 0, 3),
            'start' => 0,
            'stop' => 5
        ],
        'boxInfographic' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox') ?? '', 0, 2),
            'start' => 0,
            'stop' => 0
        ],
        'boxMostView' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyMostView')??'', 0,24),
            'start' => 0,
            'stop' => 5,
        ],
    ];

