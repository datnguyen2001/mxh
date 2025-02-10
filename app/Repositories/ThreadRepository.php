<?php

namespace App\Repositories;

use App\Constants\NewsConstants;
use Illuminate\Support\Str;

class ThreadRepository
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
        $idThread = $request->threadId;
        $slugThread = $request->slug_thread;
        $stop = $currentPage * NewsConstants::PAGE_SIZE;
        $start = ($currentPage - 1) * NewsConstants::PAGE_SIZE;
        $arrKey = $this->getArrayKeyThread($idThread, $start, $stop);
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($arrKey);
        $threadInfo = $pipeLineData['threadInfo'];
        if (!empty($threadInfo)) {
            $threadInfo = json_decode($threadInfo);
            if (!empty($threadInfo->Url) && $slugThread != $threadInfo->Url) {
                $slugThread = Str::slug($threadInfo->Name ?? '', '-');
                return redirect(config('siteInfo.site_path') . "/dong-su-kien/$slugThread-$idThread." . env('CAT_FILENAME'), 301);
            }
            $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'], NewsConstants::THREAD_IMG_W, NewsConstants::THREAD_IMG_H);
            $ZoneInfoClientScript = $this->getInputHiddenThread($threadInfo->Id, $currentPage);
        } else {
            return abort(404);
        }
        return [
            'threadInfo' => $threadInfo ?? [],
            'totalPage' => $totalPage ?? 1,
            'shortURL' => $slugThread ?? '',
            'listNews' => !empty($listNews) ? $listNews : '',
            'ZoneInfoClientScript' => !empty($ZoneInfoClientScript) ? $ZoneInfoClientScript : '',
        ];
    }

    public function getArrayKeyThread($idThread, $start, $stop) {
        return [
            'threadInfo' =>
                [
                    'cmd' => 'get',
                    'key' => sprintf(config('keyredis.KeyThread'), $idThread)
                ],
            'listNews' =>
                [
                    'cmd' => 'zrevrange',
                    'key' => sprintf(config('keyredis.KeyThreadNews'), $idThread),
                    'start' => $start,
                    'stop' => $stop - 1
                ],

        ];
    }

    public function getInputHiddenThread($threadId, $currentPage) {
        $textScript = "<input type='hidden' name='hdThreadId' id='hdThreadId' value='%s' />
                <input type='hidden' name='hdPageIndex' id='hdPageIndex' value='%s' />
                <input type='hidden' name='hdZoneId' id='hdZoneId' value='%s'/>";
        return sprintf(
            $textScript,
            $threadId,
            $currentPage,
            $threadId
        );
    }

    public function loadMorePaging($request)
    {
        $threadId = (int)$request->threadId;
        $currentPage = (int)$request->pageIndex;
        $start = ($currentPage - 1) * NewsConstants::PAGE_SIZE;
        $stop = NewsConstants::PAGE_SIZE * $currentPage - 1;
        $arrKey = ['listNews' =>
            [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyThreadNews'), $threadId),
                'start' => $start,
                'stop' => $stop
            ]
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($arrKey);
        return $this->news->formatNewsDefault($pipeLineData['listNews'], NewsConstants::THREAD_IMG_W, NewsConstants::THREAD_IMG_H);
    }

}
