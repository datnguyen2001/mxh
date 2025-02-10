<?php
return
    $detailKey = [

        'boxListNewsInOnHome' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsInZoneIsOnHome')??'', 0),
            'start' => 0,
            'stop' => 20,
            'maping'=>'mapWithMGet',
        ],
        'boxDanhGiaXe' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox')??'', $zone=0,$type=0),
            'start' => 0,
            'stop' => 2,
            'maping'=>'KeyObjectEmbedBox',
        ],

    ];

