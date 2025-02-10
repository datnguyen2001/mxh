<?php

return [
    'host' => [env('HOST_ELASTIC_SEARCH')],
    'index' => env('INDEX_ELASTIC_SEARCH'),
    'type' => env('TYPE_ELASTIC_SEARCH'),
    'host-live' => [env('HOST_ELASTIC_SEARCH_LIVE')],
    'index-live' => env('INDEX_ELASTIC_SEARCH_LIVE'),
    'type-live' => env('TYPE_ELASTIC_SEARCH_LIVE'),
    'host-mp3' => [env('HOST_ELASTIC_SEARCH_MP3')],
    'index-mp3' => env('INDEX_ELASTIC_SEARCH_MP3'),
    'type-mp3' => env('TYPE_ELASTIC_SEARCH_MP3'),
    'host-video' => [env('HOST_ELASTIC_VIDEO')],
    'index-video' => env('INDEX_ELASTIC_SEARCH_VIDEO'),
];
