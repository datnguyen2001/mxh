<?php
return
    $categoryKey = [
        //Bài đọc nhiều
        'boxMostView' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyMostView')??'',  $zone=$zoneId ?? 0,24),
            'start' => 0,
            'stop' => 4,
            'maping'=>'KeyMostView',

        ],
        //Bài đọc nhiều zone Cha
        'boxMostViewByZoneParent' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeyMostView')??'',  $zone=$categoryParrentId ?? 0,24),
            'start' => 0,
            'stop' => 4,
            'maping'=>'KeyMostView',

        ],
        //Bài cùng chuyên mục
        'listNewsInZone' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone')??'',$zone=$zoneId ?? ''),
            'start' => 0,
            'stop' => 15,
            'maping'=>'KeyNewsInZone',

        ],

        //Bài cùng chuyên mục
        'listNewsInZone' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone')??'',$zone=$zoneId ?? ''),
            'start' => 0,
            'stop' => 15,
            'maping'=>'KeyNewsInZone',

        ],
    ];

