<?php
return
    $homeKey = [
        'boxFocusHome' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyNewsPosition') ?? '', $zone = 0, $type = 1),
            'start' => 0,
            'stop' => 6,
        ],
        'newsInZoneIsOnHome' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsInZoneIsOnHome') ?? '', 0),
            'start' => 0,
            'stop' => 20,
        ],
//        'boxMostView' => [
//            'cmd' => 'zrevrange',
//            'key' => sprintf(config('keyredis.KeyMostView')??'', 0,48),
//            'start' => 0,
//            'stop' => 3,
//        ],
        'boxEmagazine' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox') ?? '', 0, 5),
            'start' => 0,
            'stop' => 1,
        ],
        'boxTapchi' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyMagazineType') ?? '', 1),
            'start' => 0,
            'stop' => 0
        ],
        'boxAnpham' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyMagazineType') ?? '', 2),
            'start' => 0,
            'stop' => 0
        ]
    ];
