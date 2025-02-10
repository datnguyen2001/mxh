<?php
$defaul = 214;
return
    $categoryKey = [
        'newsFocus' => [
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyNewsPosition')??'', $zoneId ?? $defaul,$type=3),
            'start' => 0,
            'stop' => 2,
        ],
        'newsInzone' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone')??'',$zoneId ?? $defaul),
            'start' => 0,
            'stop' => 9,
        ],
        'total' => [
            'cmd' => 'zCard',
            'key' => sprintf(config('keyredis.KeySortedNewsInZone')??'',$zoneId ?? $defaul),
        ],
    ];
