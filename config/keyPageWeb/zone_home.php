<?php
$defaul = 196;
$cmdFocus = 'hGetAll';
$cmdOnhome = 'zrevrange';
$keyPosition = config('keyredis.KeyNewsPosition') ?? '';
$keyIsOnHome = config('keyredis.KeyNewsInZoneFullIsOnHome') ?? '';


return [
    'thoi-su' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 3, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['thoi-su']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 2,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['thoi-su']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 2,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 3, 'imgW' => 235, 'imgH' => 285],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'gioi-tre' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 3, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['gioi-tre']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 2,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['gioi-tre']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 2,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 3, 'imgW' => 235, 'imgH' => 285],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'gioi-tre/thanh-nien-khoi-nghiep' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['gioi-tre/thanh-nien-khoi-nghiep']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['gioi-tre/thanh-nien-khoi-nghiep']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 1, 'imgW' => 203, 'imgH' => 127],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
];

