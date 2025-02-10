<?php

namespace App\Http\Controllers;

use App\Helpers\FormatHelpers;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Http\Request;
use App\Repositories\NewsRepository;

class MediaController extends Controller
{
    protected $zone;
    protected $redisPipeLine;
    protected $news;

    public function __construct(ZoneRepository $zone, RedisPipeLineRepository $redisPipeLine, NewsRepository $news) {
        $this->zone = $zone;
        $this->redisPipeLine = $redisPipeLine;
        $this->news = $news;
    }

    public function emagazine(){
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 27),
                'start' => 0,
                'stop' => 8,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],1160,725,[],1,565,353);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="27" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('media.emagazine', $data);
    }

    public function video(){
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 13),
                'start' => 0,
                'stop' => 19,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],962,601,[],5,257,160);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="13" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('media.video', $data);
    }

    public function anh(){
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 29),
                'start' => 0,
                'stop' => 15,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],1160,725,[],1,257,160);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="29" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('media.anh', $data);
    }

    public function infographic(){
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 20),
                'start' => 0,
                'stop' => 15,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],1160,725,[],1,257,160);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="20" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('media.infographic', $data);
    }

    public function loadMorePaging(Request $request){
        $type=$request->zoneId;
        $currentPage = $request->pageIndex;
        if ($type==27){
            $limit = 8;
            $lengthFirst = 11;
        }elseif ($type==13){
            $limit = 12;
            $lengthFirst = 20;
        }elseif ($type==29){
            $limit = 12;
            $lengthFirst = 16;
        }

        $start = ($lengthFirst - $limit) + ($currentPage - 1) * $limit;
        $stop = ($lengthFirst - $limit) + $currentPage * $limit - 1;

        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType')??'',$type ?? ''),
                'start' => $start,
                'stop' => $stop,
            ],
        ];
        try {
            $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        } catch (\Throwable $th) {
            $pipeLineData = [];
        }


        if ($type==13 || $type==29 || $type==20){
            $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], 257,160,[],$limit,0,0,$limit);
        }else{
            $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], 565,353,[],$limit,0,0,$limit);
        }


        if (!empty($listNews)) {
            $data = ['listNews' => $listNews];
            return view('components.template.item-loading-magazine', $data);
        }
        return null;
    }


}
