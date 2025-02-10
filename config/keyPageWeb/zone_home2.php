<?php
$defaul = 196;
$cmdFocus = 'hGetAll';
$cmdOnhome = 'zrevrange';
$keyPosition = config('keyredis.KeyNewsPosition') ?? '';
$keyIsOnHome = config('keyredis.KeyNewsInZoneFullIsOnHome') ?? '';


return [
    'cong-nghe' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 7, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['cong-nghe']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 6,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['cong-nghe']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 6,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 1, 'imgW' => 565, 'imgH' => 353],
            1 => (object)['length' => 2, 'imgW' => 235, 'imgH' => 147],
            2 => (object)['length' => 4, 'imgW' => 104, 'imgH' => 65],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'giao-duc' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 3, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['giao-duc']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 2,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['giao-duc']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 2,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 1, 'imgW' => 565, 'imgH' => 353],
            1 => (object)['length' => 2, 'imgW' => 235, 'imgH' => 147],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'tai-chinh' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['tai-chinh']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['tai-chinh']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 257, 'imgH' => 160],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'ly-luan-tre' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['ly-luan-tre']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['ly-luan-tre']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 257, 'imgH' => 160],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'can-biet' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['can-biet']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['can-biet']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 257, 'imgH' => 160],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'suc-khoe' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['suc-khoe']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['suc-khoe']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 257, 'imgH' => 160],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'doanh-nhan' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['doanh-nhan']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['doanh-nhan']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 257, 'imgH' => 160],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'the-thao' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['the-thao']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['the-thao']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 257, 'imgH' => 160],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'giai-tri' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['giai-tri']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['giai-tri']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 262, 'imgH' => 164],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
    'ban-doc' => (object)[ // bắt buộc phải theo chuẩn của arraykey của zoneALL
        'length' => 4, //số lượng tin của 1 box gồm 2 key
        'boxkey' =>
            [
                'focus' => [
                    'cmd' => $cmdFocus,
                    'key' => sprintf($keyPosition, $zoneALL['ban-doc']->Id ?? $defaul, $type = 3),
                    'start' => 0,
                    'stop' => 3,
                ],
                'onhome' => [
                    'cmd' => $cmdOnhome,
                    'key' => sprintf($keyIsOnHome, $zoneALL['ban-doc']->Id ?? $defaul),
                    'start' => 0,
                    'stop' => 3,
                ]
            ],
        'thumb' => [
            0 => (object)['length' => 4, 'imgW' => 262, 'imgH' => 164],
        ],
        'isMerge' =>  false, //sử dụng khi mà box tin sử dụng tổng cả 2 key || sử dụng 2 key riêng biệt thì không cần
        'noCateNews' => true, // sử dụng khi box tin không cần map zone.
    ],
];

