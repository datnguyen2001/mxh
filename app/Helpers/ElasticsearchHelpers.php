<?php

namespace App\Helpers;


use App\Helpers\LoggerHelpers;
use Elasticsearch\ClientBuilder;
use GuzzleHttp\Client;
use Illuminate\Support\Arr;
use Exception;

class ElasticsearchHelpers
{
    private static function callSearch($url, $params)
    {
        $client = new Client();
        $response = $client->request(
            'POST',
            $url,
            [
                'timeout' => 3,
                'connect_timeout' => 3,
                'headers' => [
                    'Content-Type' => 'application/json', 'Accept' => 'application/json'
                ],
                'body' => json_encode( $params)
            ]
        );

        return json_decode($response->getBody()->getContents());
    }
    public static function SearchByTitle(string $Title, int $pageIndex, int $pageSize, $zoneIds = null, $fromDate = null, $toDate = null)
    {
        try {
            $hosts = config('elasticsearch.host');
            $from = max(0, $pageIndex - 1) * $pageSize;

            $must = [
                [
                    "multi_match" => [
                        "query" => $Title,
                        "fields" => ["Title", "Title.folded"],
                        "type" => "phrase"
                    ]
                ]
            ];

            if (!empty($zoneIds)) {
                $must[] = [
                    "terms" => ["AllZone" => [$zoneIds]]
                ];
            }

            $filter = [];
            if (!empty($fromDate) && !empty($toDate)) {
                $filter = [
                    'range' => [
                        'DistributionDate' => [
                            'gte' => $fromDate,
                            'lt' => $toDate
                        ]
                    ]
                ];
            }

            $params = [
                'sort' => [["DistributionDate" => ["order" => "desc"]]],
                'query' => [
                    'bool' => [
                        'must' => $must,
                        'filter' => $filter
                    ]
                ],
                'size' => $pageSize,
                'from' => $from
            ];

            $results = self::callSearch($hosts[0] . '/' . config('elasticsearch.index') . '/_search', $params);
            if (!empty($results->hits)) {
                $response = $results->hits->hits ?? [];
                $total = $results->hits->total ?? 0;
                $collection = collect($response);
                $response = $collection->map(function ($values) {
                    return $values->_source;
                });
                $data = $response->values()->all();
            }
            return ['data' => $data ?? [], 'total' => $total ?? 0];
        } catch (\Throwable $th) {
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']', 'ExceptionEs');
            return ['data' => [], 'total' => 0];
        }
    }

    public static function SearchByTag(string $tagUrl, int $pageIndex, int $pageSize, $zoneIds = null)
    {
        try {
            $hosts = config('elasticsearch.host');
            $skip = !empty($pageIndex) ? $pageIndex - 1 : 0;
            $from = $skip * $pageSize;

            //query elasticsearch
            $params = [
                'sort' => [
                    [
                        "DistributionDate" => [
                            "order" => "desc",
                        ]
                    ]
                ],
                'query' => [
                    "term" => ['Tags' => $tagUrl],
                ],
                'size' => $pageSize,
                'from' => $from,
            ];

            $results = self::callSearch($hosts[0] . '/' . config('elasticsearch.index') . '/_search', $params);

            if (!empty($results->hits)) {
                $response = $results->hits->hits ?? [];
                $total = $results->hits->total ?? 0;
                $collection = collect($response);
                $response = $collection->map(function ($values) {
                    return $values->_source;
                });
                $data = $response->values()->all();
            }

            return ['data' => $data ?? [], 'total' => $total ?? 0];
        } catch (\Throwable $th) {
            LoggerHelpers::CallApiSetLog('Exception=[' . $th->getMessage() . ']', 'ExceptionEs');
            return ['data' => [], 'total' => 0];
        }
    }



    /** các hàm bên dưới ít khi dùng khi nào dùng viết lại cấu trúc theo 2 hàm trên */
    public static function SearchByNameVideo(string $Title, int $pageIndex, int $pageSize, $zoneIds = null)
    {
        try {
            $hosts = [env('HOST_ELASTIC_SEARCH_VIDEO')];
            $client = ClientBuilder::create()->setHosts($hosts)->build();
            $params = [
                'index' => env('INDEX_ELASTIC_SEARCH_VIDEO'),
                'type' => config('TYPE_ELASTIC_SEARCH_VIDEO'),
                'client' => [
                    'timeout' => 1,
                    'connect_timeout' => 1
                ]
            ];
            $skip = !empty($pageIndex) ? $pageIndex - 1 : 0;
            $per_page = $pageSize;
            $params['size'] = $pageSize;
            $params['from'] = $skip * $per_page;

            //query elasticsearch
            $params['body'] = [
                'query' => [
                    'bool' => [
                        'must' => [
                            ['match_phrase' => ['Name' => $Title]],
                        ],
                    ]
                ]
            ];

            $results = $client->search($params);

            $response = Arr::get($results, 'hits');
            $total = $response['total'];
            $response = $response['hits'];
            $collection = collect($response);
            $response = $collection->map(function ($values) {
                return $values['_source'];
            });
            $dataVideo = $response->values()->all();
            $data = array_map(function ($item) {
                $item['Title'] = $item['Name'];
                $item['NewsType'] = 2;
                return $item;
            }, $dataVideo);
            return ['data' => $data, 'total' => $total];
        }catch (Exception $e){
            return ['data' => [], 'total' => 0];
            LoggerHelpers::CallApiSetLog('Exception=[' . $e->getMessage() . ']' , 'Exception');
        }
    }

    public static function SearchByTagVideo(string $tagUrl, int $pageIndex, int $pageSize, $zoneIds = null)
    {
        try{
            $hosts = [env('HOST_ELASTIC_SEARCH_VIDEO')];
            $client = ClientBuilder::create()->setHosts($hosts)->build();
            $params = [
                'index' => env('INDEX_ELASTIC_SEARCH_VIDEO'),
                'type' => config('TYPE_ELASTIC_SEARCH_VIDEO'),
                'client' => [
                    'timeout' => 1,
                    'connect_timeout' => 1
                ]
            ];
            $skip = !empty($pageIndex) ? $pageIndex - 1 : 0;
            $per_page = $pageSize;
            $params['size'] = $pageSize;
            $params['from'] = $skip * $per_page;
            //query elasticsearch
            $params['body'] = [
                'sort' => [
                    [
                        "DistributionDate" =>
                            [
                                "order" => "desc",
                            ]
                    ]
                ],
                'query' => [
                    "bool" => [
                        "filter" => [
                            'match' => [
                                'Tags' => [
                                    ['query' => $tagUrl],
                                ],
                            ]
                        ],
                    ],
                ]

            ];
            $results = $client->search($params);
            $response = Arr::get($results, 'hits');
            $total = (!empty($response['total'])) ? $response['total'] : 0;
            $response = $response['hits'];
            $collection = collect($response);
            $response = $collection->map(function ($values) {
                return $values['_source'];
            });
            $dataVideo = $response->values()->all();
            $data = array_map(function ($item) {
                $item['Title'] = $item['Name'];
                $item['Sapo'] = $item['Description'];
                $item['NewsType'] = 13;
                return $item;
            }, $dataVideo);

            return ['data' => $data, 'total' => $total];
        }catch (Exception $exception){
            return ['data' =>[], 'total' => 0];
        }

    }

}
