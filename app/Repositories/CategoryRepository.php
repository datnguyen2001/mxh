<?php

namespace App\Repositories;

use App\Helpers\LoggerHelpers;
use App\Helpers\UserInterfaceHelper;

class CategoryRepository
{
    protected $zone;
    protected $redisPipeLine;
    protected $news;

    public function __construct(NewsRepository $news,
                                ZoneRepository $zone,
                                RedisPipeLineRepository $redisPipeLine)
    {
        $this->news = $news;
        $this->zone = $zone;
        $this->redisPipeLine = $redisPipeLine;
    }

    /**
     * @param $request
     * @param array $options
     * @param bool $isMobile
     * @return array
     */
    public function index($request, $options = [], $isMobile = false)
    {
        list($shortURL, $shortURLParent, $zoneInfo, $zoneParentInfo) = $this->handleZoneInfo($request);
        list($zoneId, $listSubZone) = $this->getListSubZone($zoneInfo, $zoneParentInfo);
        $keyCate = require(config_path() . '/keyPageWeb/category.php');
        if ($isMobile) {
            $keyCate = require(config_path() . '/keyPageMob/category.php');
        }
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($keyCate);
        $listFocus = $this->news->formatNewsDefault($pipeLineData['newsFocus'] ?? [], $options['imgW'], $options['imgH'], [],1, $options['sImgW'], $options['sImgH']);
        $listNews = $pipeLineData['newsInzone'] ?? [] ;
        if (empty($listFocus) && !empty($listNews)){
            // khi không cài bài nổi bật
            $listFocus = $this->news->formatNewsDefault(array_splice($listNews,0,3), $options['imgW'], $options['imgH'], [],1, $options['sImgW'], $options['sImgH']);
        }
        if (!empty($listNews)){
            $listNews = $this->news->formatNewsDefault($listNews, $options['sImgW'], $options['sImgH'], $listFocus ?? []);
        }
        $ZoneInfoClientScript = $this->getInputHiddenCategory($zoneInfo);
        $data = [
            'currentPage' => '1',
            'zoneInfo' => (!empty($zoneInfo)) ? $zoneInfo : '',//Default name
            'zoneParentInfo' => (!empty($zoneParentInfo)) ? $zoneParentInfo : '',//Default name
            'listSubZone' => $listSubZone ??[],
            'listFocus' => $listFocus ??[],
            'listNews' => $listNews ?? [],
            'keyCd' => $keyCate ?? [],
            'ZoneInfoClientScript' => (!empty($ZoneInfoClientScript)) ? $ZoneInfoClientScript : '',
        ];
        if (!$isMobile) {
            $data['pagination'] = $this->getPagination($pipeLineData, $shortURLParent, $shortURL);
        }
        return $data;
    }

    public function index1($request, $options) {
        list($shortURL, $shortURLParent, $zoneInfo, $zoneParentInfo) = $this->handleZoneInfo($request);
        list($zoneId, $listSubZone) = $this->getListSubZone($zoneInfo, $zoneParentInfo);
        $keyCate = require(config_path() . '/keyPageWeb/category.php');
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($keyCate);
        $listFocus = $this->news->formatNewsDefault($pipeLineData['newsFocus'] ?? [], $options['imgW'], $options['imgW'], [],1, $options['sImgW'], $options['sImgH']);
        $listNews = $pipeLineData['newsInzone'] ?? [] ;
        if (empty($listFocus) && !empty($listNews)){
            // khi không cài bài nổi bật
            $listFocus = $this->news->formatNewsDefault(array_splice($listNews,0,3), $options['imgW'], $options['imgW'], [],1, $options['sImgW'], $options['sImgH']);
        }
        if (!empty($listNews)){
            $listNews = $this->news->formatNewsDefault($listNews, $options['sImgW'], $options['sImgH'], $listFocus ?? []);
        }
        $ZoneInfoClientScript = $this->getInputHiddenCategory($zoneInfo);
        return [
            'currentPage' => '1',
            'zoneInfo' => (!empty($zoneInfo)) ? $zoneInfo : '',//Default name
            'zoneParentInfo' => (!empty($zoneParentInfo)) ? $zoneParentInfo : '',//Default name
            'listSubZone' => $listSubZone ??[],
            'listFocus' => $listFocus ??[],
            'listNews' => $listNews ?? [],
            'keyCd' => $keyCate ?? [],
            'pagination' => $this->getPagination($pipeLineData, $shortURLParent, $shortURL),
            'ZoneInfoClientScript' => (!empty($ZoneInfoClientScript)) ? $ZoneInfoClientScript : '',
        ];
    }

    public function index2($request) {
        list($shortURL, $shortURLParent, $zoneInfo, $zoneParentInfo) = $this->handleZoneInfo($request);
        list($zoneId, $listSubZone) = $this->getListSubZone($zoneInfo, $zoneParentInfo);
        $currentPage = $request->pageIndex;
        $limit = 10;
        $keyCate = [
            'newsInzone' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeySortedNewsInZone') ?? '', $zoneId),
                'start' => ($currentPage - 1) * $limit,
                'stop' => $currentPage  * $limit - 1,
            ],
            'total' => [
                'cmd' => 'zCard',
                'key' => sprintf(config('keyredis.KeySortedNewsInZone') ?? '', $zoneId),
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($keyCate);
        $listNews = $pipeLineData['newsInzone'] ?? [] ;
        if (!empty($listNews)){
            $listNews = $this->news->formatNewsDefault($listNews ,235,147);
        }
        $ZoneInfoClientScript = $this->getInputHiddenCategory($zoneInfo);
        return [
            'currentPage' => '1',
            'zoneInfo' => (!empty($zoneInfo)) ? $zoneInfo : '',//Default name
            'zoneParentInfo' => (!empty($zoneParentInfo)) ? $zoneParentInfo : '',//Default name
            'listSubZone' => $listSubZone ??[],
            'listFocus' => $listFocus ??[],
            'listNews' => $listNews ?? [],
            'keyCd' => $keyCate ?? [],
            'pagination' => $this->getPagination($pipeLineData, $shortURLParent, $shortURL, $currentPage),
            'ZoneInfoClientScript' => (!empty($ZoneInfoClientScript)) ? $ZoneInfoClientScript : '',
        ];
    }

    public function handleZoneInfo($request) {
        $shortURL = (!empty($request->slug_child)) ? $request->slug_child : $request->slug_cat;
        $shortURLParent = (!empty($request->slug_child)) ? $request->slug_cat : null;
        //Get Category and Category Parent
        $zoneInfo = $zoneParentInfo = $this->zone->getZoneByKey((!empty($shortURLParent) ? $shortURLParent . '/' : '') . $shortURL);
        if (empty($zoneInfo)) {
            LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404');
            return abort(404);
        }
        if (!empty($zoneInfo->ParentId)){
            $zoneParentInfo = $this->zone->getZoneByKey(!empty($zoneInfo->ParentId) ? $zoneInfo->ParentId : $zoneId ?? '');
        }
        return [$shortURL, $shortURLParent, $zoneInfo, $zoneParentInfo];
    }

    public function getListSubZone($zoneInfo, $zoneParentInfo) {
        $zoneId = $zoneInfo->Id;
        $listSubZone = $this->zone->GetListZoneByParentId($zoneParentInfo->Id ?? '');
        if (empty($listSubZone)) {
            $listSubZone = $this->zone->GetListZoneByParentId($zoneId);
        }
        return [$zoneId, $listSubZone];
    }

    public function getInputHiddenCategory($zoneInfo) {
        $textScript = "<input type='hidden' name='hdCurrentUrlActive' id='hdCurrentUrlActive' value='%s' />
                <input type='hidden' name='hdZoneId' id='hdZoneId' value='%s' />
                <input type='hidden' name='hdZoneUrl' id='hdZoneUrl' value='%s' />
                <input type='hidden' name='hdParentUrl' id='hdParentUrl' value='%s'/>";
        return sprintf(
            $textScript,
            !empty($zoneInfo->ParentShortUrl) ? $zoneInfo->ParentShortUrl : $zoneInfo->ShortURL,
            $zoneInfo->Id,
            $zoneInfo->ShortURL,
            !empty($zoneInfo->ParentShortUrl) ? $zoneInfo->ParentShortUrl : ''
        );
    }

    public function getPagination($pipeLineData, $shortURLParent, $shortURL, $currentPage = 1) {
        $limit = 10;
        $totalPage = (int)ceil($pipeLineData['total'] / $limit);
        $pageURL = (!empty($shortURLParent) ? $shortURLParent . '/' : '') . $shortURL;
        return UserInterfaceHelper::getPagination($currentPage, $totalPage,$pageURL , null, env('CAT_FILENAME'));
    }

    public function loadMorePaging($request, $options = [])
    {
        $zoneId = $request->zoneId;
        $currentPage = $request->pageIndex;
        $limit = 10;
        $start = ($currentPage - 1) * $limit;
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeySortedNewsInZone') ?? '', $zone=$zoneId ?? ''),
                'start' => $start,
                'stop' => $limit * $currentPage - 1,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        return $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], $options['imgW'], $options['imgH']);
    }

    public function loadCateSidebar($request, $options = []) {
        $zoneId = (int)$request->zoneId;
        $zoneInfo = $this->zone->getZoneByKey($zoneId ?? '');
        if (empty( $zoneInfo->ParentId)){
            $listSubZone = $this->zone->GetListZoneByParentId(!empty($zoneInfo->ParentId) ? $zoneInfo->ParentId : $zoneId ?? '');
            $key=[];
            if (!empty($listSubZone)) {
                foreach ($listSubZone as $value) {
                    $subZoneId = $value->Id ?? '';
                    $subZoneUrl = $value->ShortURL ?? '';
                    $key['focus:' . $subZoneUrl] = [
                        'cmd' => 'hGetAll',
                        'key' => sprintf(config('keyredis.KeyNewsPosition') ?? '', $zone = $subZoneId, $type = 3),
                        'start' => 0,
                        'stop' => $options['stopFocus'],
                    ];
                    $key['inzone:' . $subZoneUrl] = [
                        'cmd' => 'zrevrange',
                        'key' => sprintf(config('keyredis.KeySortedNewsInZone') ?? '', $zone = $subZoneId),
                        'start' => 0,
                        'stop' => $options['stopInZone'],
                    ];
                }
            }
        }else{
            $key = [
                'boxMostView' => [
                    'cmd' => 'zrevrange',
                    'key' => sprintf(config('keyredis.KeyMostView') ?? '', 0, $hour = 24),
                    'start' => 0,
                    'stop' => 5,
                ],
            ];
        }

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $dataByZone = $this->getDataByZone($listSubZone ?? [], $pipeLineData, $key, $options);
        $boxMostView = $this->news->formatNewsDefault($pipeLineData['boxMostView'] ?? [], $options['imgW'], $options['imgH']);
        return [
            'zoneInfo' => $zoneInfo ?? [],
            'dataByZone' => $dataByZone ?? [],
            'boxMostView' => $boxMostView ?? [],
            'keyCD' => $key ?? [],
        ];
    }

    public function getDataByZone($listSubZone, $pipeLineData, $key, $options) {
        if (empty($listSubZone)) {
            return [];
        }
        foreach ($listSubZone as $value) {
            $subZoneUrl = $value->ShortURL ?? '';
            if (!empty($pipeLineData['focus:' . $subZoneUrl]) || !empty($pipeLineData['inzone:' . $subZoneUrl])) {
                $dataByZone['zone:' . $subZoneUrl] = [
                    'info' => $value ?? '',
                    'list' => $this->news->formatBoxPosition($pipeLineData['focus:' . $subZoneUrl] ?? [], $pipeLineData['inzone:' . $subZoneUrl] ?? [], $options['length'], $options['imgW'], $options['imgH']),
                    'cdKey' => ($key['focus:' . $subZoneUrl]['key'] ?? '') . ';' . ($key['inzone:' . $subZoneUrl]['key'] ?? ''),
                ];
            }
        }
        return $dataByZone ?? [];
    }

    public function loadTagTrending($request) {
        $zoneId = (int)$request->zoneId;
        $pipeLineData = $this->getListTags($zoneId);
        if (empty($pipeLineData['listTags'])){
            $pipeLineData = $this->getListTags(0);
        }
        $boxTags = $this->news->formatDataByEmbedbox($pipeLineData['listTags'] ?? []);
        $data = [
            'boxTags' => $boxTags ?? [],
        ];
        return view('components.category.box-tag-trending', $data);
    }

    public function getListTags($zoneId) {
        $key = [
            'listTags' => [
                'cmd' => 'hGetAll',
                'key' => sprintf(config('keyredis.KeyObjectEmbedBox') ?? '', $zoneId,1),
                'start' => 0,
                'stop' => 1,
            ],
        ];
        return $this->redisPipeLine->getDataByPipeLine($key);
    }
}
