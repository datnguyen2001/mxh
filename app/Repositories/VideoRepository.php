<?php

namespace App\Repositories;

use Illuminate\Http\Request;

class VideoRepository
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

    public function getInputHiddenVideo($zoneVideoId, $videoFocus) {
        $textScript = "<input type='hidden' name='hdCurrentUrlActive' id='hdCurrentUrlActive' value='video' />
                        <input type='hidden' name='hdZoneVideo' id='hdZoneVideo' value='%s' />
                        <input type='hidden' name='hdNewsId' id='hdNewsId' value='%s' />
                        <input type='hidden' name='hdNewsTitle' id='hdNewsTitle' value='%s' />
                        <input type='hidden' name='hdZoneId' id='hdZoneId' value='%s' />
                        <input type='hidden' name='hdObjectType' id='hdObjectType' value='2' />";
        return sprintf(
            $textScript,
            $zoneVideoId,
            $videoFocus->Id,
            $videoFocus->Name,
            $videoFocus->ZoneId
        );
    }

    public function loadMorePaging(Request $request, $options)
    {
        $zoneId = $request->zoneId;
        $currentPage = $request->pageIndex;
        $limit = 10;
        $start =($currentPage - 1) * $limit;
        if ($zoneId==0){
            $list = $this->zrevrangeKeySortedVideoGetAll($start, $currentPage * $limit - 1, $options['videoW'], $options['videoH']);
        }else{
            $list = $this->zrevrangeKeySortedVideoInZone($zoneId, $start, $currentPage * $limit - 1 , $options['videoW'], $options['videoH'], null);
        }
        return $list ?? [];
    }
}
