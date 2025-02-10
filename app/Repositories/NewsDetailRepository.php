<?php

namespace App\Repositories;

use App\Helpers\LoggerHelpers;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Str;

class NewsDetailRepository
{
    protected $zone;
    protected $redisPipeLine;
    protected $news;
    public function __construct(ZoneRepository $zone,
                                RedisPipeLineRepository $redisPipeLine,
                                NewsRepository $news)
    {
        $this->zone = $zone;
        $this->redisPipeLine = $redisPipeLine;
        $this->news = $news;
    }

    public function getInputHiddenNewsDetail($newsContent, $zoneDetail) {
        $textScript = "<input type='hidden' name='hdZoneId' id='hdZoneId' value='%s' />
                    <input type='hidden' name='hdZoneUrl' id='hdZoneUrl' value='%s' />
                     <input type='hidden' name='hdParentUrl' id='hdParentUrl' value='%s' />
                     <input type='hidden' name='hdNewsId' id='hdNewsId' value='%s' />
                     <input type='hidden' name='hidLastModifiedDate' id='hidLastModifiedDate' value='%s' /><input type='hidden' name='hdCommentDomain' id='hdCommentDomain' value='' />
                     <input type='hidden' name='hdType' id='hdType' value='%s' />
                     <input type='hidden' name='distributionDate' id='distributionDate' value='%s' />
                     <input type='hidden' name='hdNewsTitle' id='hdNewsTitle' value='%s' />
                     <input type='hidden' name='hdUrl' id='hdUrl' value='%s' />
                      <input type='hidden' name='hdObjectType' id='hdObjectType' value='1' />";
        return sprintf(
            $textScript,
            ($newsContent->Type == 13)?13:0,
            $zoneDetail->ShortURL ?? '',
            $zoneDetail->ParentShortUrl ?? '',
            $newsContent->NewsId ?? '',
            $newsContent->LastModifiedDate ?? '',
            $newsContent->Type ?? '',
            $newsContent->DistributionDate ?? '',
            $newsContent->Title,
            $newsContent->Url,
            $newsContent->Avatar ?? '',
            $newsContent->Sapo ?? '',
            $zoneDetail->Name ?? '',
        );
    }

    public function updateSiteMapIfUpdateNews($request) {
        try {
            if ($request->isCache && !empty($request->isCache)) {
                Cache::forget('sitemap-index');
                $new_request = Request::create('/sitemap-render-xml', 'GET');
                Route::dispatch($new_request);
            }
        } catch (\Throwable $th) {
            LoggerHelpers::CallApiSetLog('Exception=' . $th->getMessage(), '500');
        }
    }

    public function getZoneDetailAndZoneParentInfo($newsContent) {
        $zoneDetail = $this->zone->getZoneByKey($newsContent->ZoneId);
        if (!empty($zoneDetail)) {
            $zoneParentId = $zoneDetail->ParentId;
            if ($zoneParentId != 0) {
                $zoneParentInfo = $this->zone->getZoneByKey($zoneParentId);
            } else {
                $zoneParentInfo = $zoneDetail;
            }
        }
        return [$zoneDetail, $zoneParentInfo ?? []];
    }

    public function getContentHtml($url) {
        try {
            $client = new Client();
            $res = $client->get($url);
            return (string)$res->getBody();

        }catch (\Throwable $th){
            LoggerHelpers::CallApiSetLog('Err Detail:' . $th->getMessage() . ']' , '500');
            return '';
        }
    }

    public function loadRelated($request, $options, $isMobile = false)
    {
        $zoneId = $request->zoneId;
        $boxKey = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeySortedNewsInZone') ?? '', $zoneId),
                'start' => 0,
                'stop' => $options['listNewsStop'],
            ]
        ];

        if (!$isMobile) {
            $boxKey['boxFocusHome'] = [
                'cmd' => 'hGetAll',
                'key' => sprintf(config('keyredis.KeyNewsPosition') ?? '', 0, 1),
                'start' => 0,
                'stop' => 4,
            ];
        }

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($boxKey);
        if (!$isMobile) {
            $newsFocus = $this->news->formatNewsDefault($pipeLineData['boxFocusHome'] ?? [], $options['boxFocusImgW'], $options['boxFocusImgH']);
        }
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], $options['listNewsImgW'], $options['listNewsImgH']);
        $data = [
           'listNews' => $listNews ?? [],
           'keyCd' => $boxKey ?? []
        ];
        if (!$isMobile) {
            $data['newsFocus'] = $newsFocus ?? [];
        }
        return $data;
    }

    public function loadDetailMagazineBottom($stop, $options)
    {
        $boxKey = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 27),
                'start' => 0,
                'stop' => $stop,
            ]
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($boxKey);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], $options['imgW'], $options['imgH']);

        return [
            'listNews' => $listNews ?? [],
            'keyCd' => $boxKey ?? []
        ];
    }

    public function loadDetailVideoBottom($options) {
        $boxKey = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 13),
                'start' => 0,
                'stop' => 14,
            ]
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($boxKey);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], $options['imgW'], $options['imgH']);

        return [
            'listNews' => $listNews ?? [],
            'keyCd' => $boxKey ?? []
        ];
    }

    public function loadDetailBottom($options)
    {
        $boxKey = [
            'mostViews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyMostView') ?? '', 0, 24),
                'start' => 0,
                'stop' => 5,
            ],
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeySortedNewsInZone') ?? '', 0),
                'start' => 0,
                'stop' => 7,
            ],
        ];

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($boxKey);
        $mostViews = $this->news->formatNewsDefault($pipeLineData['mostViews'] ?? [], 0, 0);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], $options['imgW'], $options['imgH']);
        return [
            'listNews' => $listNews ?? [],
            'mostViews' => $mostViews ?? [],
            'keyCd' => $boxKey ?? []
        ];
    }

    public function handleNewsContentRedirect($newsContent, $request, $newsId) {
        if (empty($newsContent) || !is_object($newsContent) || empty($newsContent->Url)) {
            $userAgent = $request->header('user-agent');
            if ($userAgent === 'TelegramBot (like TwitterBot)') {
                return redirect(config('siteInfo.site_path') . "/short-link-tele-$newsId." . env('DETAIL_FILENAME'), 301);
            }
            LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404Detail');
            return abort(404);
        } else if ($request->path() != preg_replace('/\//', '', $newsContent->Url, 1)) {
            return redirect(config('siteInfo.site_path') . $newsContent->Url, 301);
        }
        return null;
    }

    public function detailBaoGiay($request) {
        $newsId = $request->newsid;
        $arrKey =  [
            'news' => [
                'cmd' => 'get',
                'key' => sprintf(config('keyredis.KeyMagazine'), $newsId ?? ''),
            ],
        ];

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($arrKey);
        $newsContent = $pipeLineData['news'] ??[];
        if (empty($newsContent)){
            return abort(404);
        }
        try {
            $newsContent = $this->formatBaoGiay($newsContent);
        } catch (\Throwable $th) {}
        return [
            'newsContent' => $newsContent,
            'cdKey' => $arrKey
        ];
    }

    public function formatBaoGiay($arr = null){
        $listNews = $arr;
        if (!empty($listNews)){
            if (is_array($listNews)){
                $listNews = array_map(function ($item){
                    $item->Url = '/bao-giay/'.str::slug($item->Title ??'').'-'.($item->Id ?? '').'.htm';
                    return $item;
                },$listNews);
            }elseif (is_string($listNews)){
                $listNews = json_decode($listNews);
                $listNews->Url = '/bao-giay/'.str::slug($listNews->Title ??'').'-'.($listNews->Id ?? '').'.htm';
            }
        }
        return $listNews;
    }

}
