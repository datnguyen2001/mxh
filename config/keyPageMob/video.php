<?php
$reqUrl = !empty($reqUrl)?$reqUrl:'';
    $categoryKey = [
        'listVideoNew' => [
            'cmd' => 'zrevrange',
            'key' => config('keyredis.KeySortedVideoGetAll')??'',
            'start' => 0,
            'stop' => 19,
            'maping'=>'mapWithMGet',
        ],
        'listVideoHot' => [
            'cmd' => 'zrevrange',
            'key' => sprintf(config('keyredis.KeySortedVideoByModeAll')??'', $mode=1),
            'start' => 0,
            'stop' => 9,
            'maping'=>'mapWithMGet',
        ],
    ];
return $categoryKey;

