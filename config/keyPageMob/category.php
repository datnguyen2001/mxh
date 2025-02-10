<?php
return
    $categoryKey = [
        'newPr0'=>[
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsPrByModeAndZone')??'',$zone=$zoneId ?? 0,5000),
            'start' => 0,
            'stop' => 0,
            'maping' => 'KeyNewsInZone'
        ],
        'newPr1'=>[
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsPrByModeAndZone')??'',$zone=$zoneId ?? 0,5009),
            'start' => 0,
            'stop' => 1,
            'maping' => 'KeyNewsInZone'
        ],
        'newPr2'=>[
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsPrByModeAndZone')??'',$zone=$zoneId ?? 0,5010),
            'start' => 0,
            'stop' => 0,
            'maping' => 'KeyNewsInZone'
        ],
        'newPr3'=>[
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsPrByModeAndZone')??'',$zone=$zoneId ?? 0,5011),
            'start' => 0,
            'stop' => 0,
            'maping' => 'KeyNewsInZone'
        ],
        'newPr4'=>[
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyNewsPrByModeAndZone')??'',$zone=$zoneId ?? 0,5012),
            'start' => 0,
            'stop' => 0,
            'maping' => 'KeyNewsInZone'
        ],
        'boxFocus' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyNewsPosition')??'', $zone=$zoneId??0,$type=3),
            'start' => 0,
            'stop' => 2,
            'maping'=>'KeyNewsPosition',
        ],
        'boxNewsNew' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone')??'', $zone=$zoneId ?? 0),
            'start' => 0,
            'stop' => 19,
            'maping'=>'mapWithMGet',
        ],
    ];

