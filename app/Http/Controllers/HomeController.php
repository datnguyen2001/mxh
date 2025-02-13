<?php
namespace App\Http\Controllers;

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

        $featuredTopics = $pipeLineData['featuredTopics']??[];
        $trendPost = $pipeLineData['trendPost']??[];
        $homePost = $this->news->formatNewsDefault($pipeLineData['homePost'] ?? [],592,370,[],10,0,0,10);
//        dd($homePost);
        $data = [
            'featuredTopics' => $featuredTopics,
            'trendPost'=>$trendPost,
            'homePost'=>$homePost,
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
        $zoneALL = $this->zone->getZoneByKey();
        $zoneConfig = require(config_path() . '/keyPageWeb/zone_home2.php');
        $keyByZone = $this->news->binKeyPipeline($zoneConfig ?? []);
        $homeKey = array_merge($keyByZone ?? [], include(config_path() . '/keyPageWeb/home_page2.php'));
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($homeKey);

        // Xử lý dữ liệu theo vùng
        $dataByZone = $this->news->prepareDataByZone($zoneConfig, $pipeLineData, $zoneALL, $keyByZone);

        // Xử lý dữ liệu cho các box
        $data = [
            'dataByZone' => $dataByZone,
            'boxAnh' => $this->news->formatBoxData($pipeLineData['boxAnh'] ?? [], 1160,725,[],5,0,0,5),
            'boxInfographic' => $this->news->formatBoxData($pipeLineData['boxInfographic'] ?? [], 400,250,[],4,0,0,4),
            'boxVideo' => $this->news->formatBoxData($pipeLineData['boxVideo'] ?? [], 830,481,[],1,111,69,10),
            'boxMostView' => $this->news->formatNewsDefault($pipeLineData['boxMostView'] ?? [], 203,126,[],6,0,0,6),
        ];
        return view('home.index2', $data);
    }
}
