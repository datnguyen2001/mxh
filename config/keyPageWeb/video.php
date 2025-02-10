<?php
return
    $categoryKey = [
        'listvideoFocus' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox')??'', $zone=$zoneId ?? '',$type=1),
            'start' => 0,
            'stop' => 5,
            'maping'=>'KeyObjectEmbedBox',

        ],
        'listVideoAll' => [
            'cmd' => 'zrevrange',
            'key' => config('keyredis.KeySortedVideoGetAll'),
            'start' => 0,
            'stop' => 5,
            'maping'=>'KeySortedVideoGetAll',

        ],
        'listVideoHighlight' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeySortedVideoByModeAll')??'', $mode=1 ),
            'start' => 0,
            'stop' => 4,
            'maping'=>'KeySortedVideoGetAll',

        ],
        'listNewsVideoAll' => [
            'cmd' => 'zrevrange',
            'key' => config('keyredis.KeySortedVideoGetAll'),
            'start' => 0,
            'stop' => 13,
            'maping'=>'KeySortedVideoGetAll',

        ],
    ];

