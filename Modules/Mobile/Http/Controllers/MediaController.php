<?php

namespace Modules\Mobile\Http\Controllers;


use App\Repositories\RedisPipeLineRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use App\Repositories\NewsRepository;

class MediaController extends BaseController
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
                'stop' => 9,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],642,401);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="27" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('mobile::media.emagazine', $data);
    }

    public function video(){
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 13),
                'start' => 0,
                'stop' => 9,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],642,401);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="13" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('mobile::media.video', $data);
    }

    public function anh(){
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 29),
                'start' => 0,
                'stop' => 9,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],642,401);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="29" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('mobile::media.anh', $data);
    }

    public function infographic(){
        $key = [
            'listNews' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsByType') ?? '', 20),
                'start' => 0,
                'stop' => 9,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [],642,401);
        $ZoneInfoClientScript=
            '<input type="hidden" name="hdNewsByType" id="hdNewsByType" value="20" />';
        $data = [
            'listNews'=>$listNews,
            'ZoneInfoClientScript'=>(!empty($ZoneInfoClientScript))?$ZoneInfoClientScript:'',
        ];
        return view('mobile::media.infographic', $data);
    }

    public function loadMorePaging(Request $request){
        $type=$request->zoneId;
        $currentPage = $request->pageIndex??0;
        $limit = 10;
        $start =  ($currentPage - 1) * $limit;
        $stop =  $currentPage * $limit - 1;

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

        $listNews = $this->news->formatNewsDefault($pipeLineData['listNews'] ?? [], 642,401);

        if (!empty($listNews)) {
            $data = ['listNews' => $listNews];
            return view('mobile::components.template.item-loading', $data);
        }
        return null;
    }
}
