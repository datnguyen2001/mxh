<?php
namespace App\Http\Controllers;

use App\Helpers\ElasticsearchHelpers;
use App\Repositories\NewsRepository;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    protected $zone;
    protected $redisPipeLine;
    protected $news;

    public function __construct(ZoneRepository $zone, RedisPipeLineRepository $redisPipeLine, NewsRepository $news) {
        $this->zone = $zone;
        $this->redisPipeLine = $redisPipeLine;
        $this->news = $news;
    }

    public function index()
    {
        $homeKey = require(config_path() . '/keyPageWeb/home_new.php');
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($homeKey);

        $featuredTopics = $this->news->formatDataByEmbedbox($pipeLineData['featuredTopics']??[]);
        $trendPost = $pipeLineData['trendPost']??[];
        $homePostTop9 = $this->news->formatNewsDefault($pipeLineData['homePost'] ?? [],592,370,[],10,0,0,10);
        $homePostMore = $this->news->formatNewsDefault($pipeLineData['homePostMore'] ?? [],592,370,$homePostTop9,10,0,0,10);
        $homePost = array_merge($homePostTop9, $homePostMore);

        $ZoneInfoClientScript = '
        <input type="hidden" name="hdZoneHome" id="hdZoneHome" value="1" />
        <input type="hidden" name="hdZoneId" id="hdZoneId" value="0" />
        <input type="hidden" name="hdPageIndex" id="hdPageIndex" value="1" />';

        $data = [
            'featuredTopics' => $featuredTopics,
            'trendPost'=>$trendPost,
            'homePost'=>$homePost,
            'ZoneInfoClientScript' => $ZoneInfoClientScript,
        ];

        return view('home.index3', $data);
    }

    public function homeLoadingPage(Request $request)
    {
        switch ($request->pageIndex) {
            case 2:
                return self::homeLoadingPage2();
            default:
                return null;
        }
    }

    public function homeLoadingPage2()
    {
        // Load configuration và dữ liệu
        $key = [
            'listPostMore' => [
                'cmd' => 'zrevrange',
                'key' => sprintf(config('keyredis.KeyNewsInZoneIsOnHome') ?? '', 0),
                'start' => 0,
                'stop' => 19,
            ],
        ];
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($key);
        $dataPostMore = $this->news->formatNewsDefault($pipeLineData['listPostMore'] ?? [],592,370,[],10,0,0,10);

        return view('home.index4', compact('dataPostMore'));
    }
}
