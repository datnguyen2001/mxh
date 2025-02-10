<?php
return
    $mediaKey = [
        'listNewsHot'=>[
            'cmd' => 'hGetAll',
            'key' => sprintf(config('keyredis.KeyObjectEmbedBox')??'',0,2),
            'start' => 0,
            'stop' => 2,
            'maping' => 'KeyObjectEmbedBox'
        ],
        'listNewsStream'=>[
            'cmd' => 'zrevrange',
            'key' => config('keyredis.KeyNewsMagazine')??'',
            'start' => 0,
            'stop' => 17,
            'maping' => 'KeyNewsMagazine'
        ],
    ];
