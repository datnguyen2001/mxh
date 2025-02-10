<?php

namespace App\Repositories;

use App\Constants\NewsConstants;
use App\Helpers\UserInterfaceHelper;
use Illuminate\Support\Str;

class TopicRepository
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

    public function index($request) {
        $currentPage = (!empty($request->pageIndex)) ? $request->pageIndex : 1;
        $idTopic = $request->topicId;
        $slugTopic = $request->slugTopic;
        $stop =  $currentPage * NewsConstants::PAGE_SIZE;
        $start = ($currentPage - 1) * NewsConstants::PAGE_SIZE;
        $arrKey = $this->getArrayKeyTopic($idTopic, $start, $stop);
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($arrKey);
        $topicInfo = $pipeLineData['topicInfo'] ?? [];
        if(!empty($topicInfo)){
            $topicInfo = json_decode($topicInfo);
            if (!empty($topicInfo->RefUrl)&& $slugTopic != $topicInfo->RefUrl) {
                $slugTopic=Str::slug($topicInfo->TopicName ?? '','-');
                return redirect(config('siteInfo.site_path')."/chu-de/$slugTopic-$idTopic.".env('CAT_FILENAME'), 301);
            }
            $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'],NewsConstants::TOPIC_IMG_W,NewsConstants::TOPIC_IMG_H);
            $ZoneInfoClientScript = $this->getInputHiddenTopic($topicInfo->Id, $currentPage);
        }else{
            return  abort(404);
        }
        return [
            'topicInfo' => $topicInfo ?? [],
            'totalPage' => $totalPage ?? 1,
            'shortURL' => $slugTopic ?? '',
            'pagination' => $pagination ?? '',
            'listNews' => !empty($listNews) ? $listNews : '',
            'ZoneInfoClientScript' => !empty($ZoneInfoClientScript) ? $ZoneInfoClientScript : '',
        ];
    }

    public function getArrayKeyTopic($idTopic, $start, $stop) {
        return  [
            'topicInfo' => [
                'cmd' => 'get',
                'key' => sprintf(config('keyredis.KeyTopic'), $idTopic)
            ],
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsInTopic'), $idTopic),
                'start' => $start,
                'stop' => $stop - 1
            ],

        ];
    }

    public function getInputHiddenTopic($topicId, $currentPage) {
        $textScript = "<input type='hidden' name='hdTopicId' id='hdTopicId' value='%s' />
                <input type='hidden' name='hdPageIndex' id='hdPageIndex' value='%s' />
                <input type='hidden' name='hdZoneId' id='hdZoneId' value='%s'/>";
        return sprintf(
            $textScript,
            $topicId,
            $currentPage,
            $topicId
        );
    }

    public function index2($request) {
        $currentPage = (!empty($request->pageIndex)) ? $request->pageIndex : 1;
        $idTopic = $request->topicId;
        $slugTopic = $request->slugTopic;
        $stop =  $currentPage * NewsConstants::PAGE_SIZE;
        $start = ($currentPage - 1) * NewsConstants::PAGE_SIZE;
        $arrKey = $this->getArrayKeyTopic2($idTopic, $start, $stop);

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($arrKey);
        $topicInfo = $pipeLineData['topicInfo'];
        if(!empty($topicInfo)){
            $topicInfo = json_decode($topicInfo);
            if ($slugTopic != $topicInfo->Url) {
                $slugTopic=$topicInfo->Url;
                return redirect(config('siteInfo.site_path')."/chu-de/$slugTopic-$idTopic.".env('CAT_FILENAME'), 301);
            }
            $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'],NewsConstants::TOPIC_IMG_W,NewsConstants::TOPIC_IMG_H);
            //Pagination
            $total_records = $pipeLineData['total'];
            $totalPage = (int)ceil($total_records / NewsConstants::PAGE_SIZE);
            if ($currentPage > $totalPage) {
                $currentPage = $totalPage;
            }
            else if ($currentPage < 1) {
                $currentPage = 1;
            }
            $shortURL='chu-de/'  .$topicInfo->Url. '-'. $idTopic ;
            $pagination = UserInterfaceHelper::getPagination($currentPage, $totalPage,$shortURL , null, env('CAT_FILENAME'));
            $ZoneInfoClientScript = $this->getInputHiddenTopic($topicInfo->Id, $currentPage);
        }else{
            return  abort(404);
        }
        return [
            'topicInfo' => $topicInfo ?? [],
            'totalPage' => $totalPage ?? 1,
            'shortURL' => $slugTopic ?? '',
            'pagination' => $pagination ?? '',
            'listNews' => !empty($listNews) ? $listNews : '',
            'ZoneInfoClientScript' => !empty($ZoneInfoClientScript) ? $ZoneInfoClientScript : '',
        ];
    }

    public function getArrayKeyTopic2($idTopic, $start, $stop) {
        return [
            'topicInfo' => [
                'cmd' => 'get',
                'key' => sprintf(config('keyredis.KeyTopic'), $idTopic)
            ],
            'listNews' => ['cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsInTopic'), $idTopic),
                'start' => $start,
                'stop' => $stop - 1
            ],
            'total' => [
                'cmd' => 'zCard',
                'key' => sprintf(config('keyredis.KeyNewsInTopic') ?? '', $idTopic)
            ],
        ];
    }

    public function loadMorePaging($request) {
        $topicId = (int)$request->topicId;
        $currentPage = (int)$request->pageIndex;
        $start = ($currentPage - 1) * NewsConstants::PAGE_SIZE;
        $stop = NewsConstants::PAGE_SIZE * $currentPage - 1;
        $arrKey= [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsInTopic'), $topicId),
                'start' => $start,
                'stop' => $stop
            ]
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($arrKey);
        return $this->news->formatNewsDefault($pipeLineData['listNews'],NewsConstants::TOPIC_IMG_W,NewsConstants::TOPIC_IMG_H);
    }
}
