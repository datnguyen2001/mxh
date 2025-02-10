<?php
return
    [
        "CachePage"=> [
            "Enable"=>env('STATUS_CACHE_PAGE'),//true managercache; flase not managercache=>(MEMCACHE FALSE,PROXY FALSE)
            "Memcached"=>env('STATUS_MEMCACHED'), //(False & ProxyCache==true) =>CALL API PROXY
            "RedisCached"=>env('STATUS_REDISCACHED'), //(False & ProxyCache==true) =>CALL API PROXY
            "ProxyCache"=>env('STATUS_PROXY_CACHE'),
            "MemcacheServer"=>[
                "default"=>[
                    "host"=>env('MEMCACHED_HOST'),
                    "port"=>env('MEMCACHED_PORT')
                ],
                "server1"=>[
                    "host"=>env('MEMCACHED_HOST_SERVER1'),
                    "port"=>env('MEMCACHED_PORT_SERVER1')
                ],
            ],
            "RedisCacheSerVer"=>[
                "default"=>"redis_sever1",
//                "server1"=>"redis_sever2",
//                "server2"=>"redis_sever3"
            ],
            "Pages"=> [
                [
                    "RouteName"=>"page_home",
                    "ExpireSeconds"=> 86400,
                    "Monitor"=>true, // TRUE=>CALL API PROXY .False=>Add header time timeexpire
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_detail",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>true,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_category",
                    "ExpireSeconds"=> 86400,
                    "Monitor"=>true,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_category_by_date",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_video",
                    "ExpireSeconds"=> 86400,
                    "Monitor"=>true,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_detail_video",
                    "ExpireSeconds"=> 86400,
                    "Monitor"=>true,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_media",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>true,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_album",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_tag",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_thread",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_live",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_random",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_emagazine",
                    "ExpireSeconds"=> 86400,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"loadMorePaging",//Với data trả dạng json
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"loadMore",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"loadMoreJson",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"page_detail_bomb",
                    "ExpireSeconds"=> 300,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"loadMoreMonitor",
                    "ExpireSeconds"=> 900,
                    "Monitor"=>true,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"sitemap",
                    "ExpireSeconds"=> 300,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
                [
                    "RouteName"=>"rss",
                    "ExpireSeconds"=> 300,
                    "Monitor"=>false,
                    "Server"=>'default'
                ],
            ],
        ],

        //Use Api Controller
        "ConfigUrlCache"=>[
            "TimeLineHome"=>[
                "Status"=>true,
                "Url"=>"/timelinehome/%u.htm",//param  page
            ],
            "TimeLineCat"=>[
                "Status"=>true,
                "Url"=>"/timelinelist/%u/%u.htm"//param catId, page
            ],
            "TimeLineDetail"=>[
                "Status"=>false,
                "Url"=>"/timelinedetail/%u.htm"//param page
            ],
            "TimeLineCatByType"=>[
                "Status"=>true,
                "Url"=>"/timelinenewbytype/%u/%u.htm"//param type, page
            ],
            "UrlNewsByType"=>[
                "0"=>'/multimedia.htm',
                "13"=>"/video.htm",
                "20"=>"/infographic.htm",
                "27"=>"/magazine.htm",
                "29"=>"/anh.htm",
            ],
            "UrlVideoHome"=>"/video.chn",
            "TimeLineVideoHome"=>[
                "Status"=>true,
                "Url"=>"/timelinevideonew/%u/%u.htm",//param catId, page
            ],
            "TimeLineVideoCat"=>[
                "Status"=>true,
                "Url"=>"/timelinevideodetail/%u/%u.htm",//param catId, page
            ],
            "TimeLineVideoDetail"=>[
                "Status"=>false,
                "Url"=>"/timelinevideodetail/%u/%u.htm",//param catId, pagen


            ],
        ]
    ];


