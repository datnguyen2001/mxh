<?php
return [
    'newsInZoneGiaoDuc' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$giaoducId??''),
        'start' => 0,
        'stop' => 6
    ],

    'newsInZoneCungCon' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$cungConId??''),
        'start' => 0,
        'stop' => 6
    ],

    'newsInZoneVanHoa' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$vanHoaId??''),
        'start' => 0,
        'stop' => 6
    ],

    'newsInZoneGiaiTri' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$giaiTriId??''),
        'start' => 0,
        'stop' => 6
    ],

    'newsInZoneBanDoc' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$banDocId??''),
        'start' => 0,
        'stop' => 2
    ],

    'newsInZoneThoiTrangTre' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$thoiTrangTreId??''),
        'start' => 0,
        'stop' => 5
    ],

    'newsInZoneAmThuc' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$amThucId??''),
        'start' => 0,
        'stop' => 2
    ],

    'newsInZoneBanCanBiet' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$banCanBietId??''),
        'start' => 0,
        'stop' => 2
    ],

    'newsInZoneGiaoVat' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyNewsInZoneFullOnHome')??'',$giaoVatId??''),
        'start' => 0,
        'stop' => 2
    ],

    'dungBoLo' => [
        'cmd' => 'zrevrange',
        'key' => sprintf(config('keyredis.KeyMostView')??'',0, 24),
        'start' => 0,
        'stop' => 8
    ]



];
