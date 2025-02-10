<?php

namespace Modules\Mobile\Http\Controllers;


use App\Repositories\NewsRepository;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Str;

class HomeController extends BaseController
{
    protected $zone;
    protected $redisPipeLine;
    protected $news;

    public function __construct(ZoneRepository $zone, RedisPipeLineRepository $redisPipeLine, NewsRepository $news) {
        $this->zone = $zone;
        $this->redisPipeLine = $redisPipeLine;
        $this->news = $news;
    }

    public function index(){
        $zoneALL = $this->zone->getZoneByKey();
        $zoneConfig = require(config_path() . '/keyPageMob/zone_home.php');
        $keyByZone = $this->news->binKeyPipeline($zoneConfig ?? []);
        $homeKey = array_merge($keyByZone, include(config_path() . '/keyPageMob/home.php'));

        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($homeKey);

        $listThumb = [
            '0' => (object)['length' => 1, 'imgW' => 642,'imgH' => 401],
            '1' => (object)['length' => 6, 'imgW' => 230,'imgH' => 144],
        ];

        $boxFocusHome = $this->news->formatNewsByArrThumb($pipeLineData['boxFocusHome'] ?? [],   [],$listThumb, 7, true);
        $listStreamHome = $this->news->formatNewsDefault($pipeLineData['newsInZoneIsOnHome'] ?? [],230,144,$boxFocusHome,10,0,0,10);
        $boxEmagazine = $this->news->formatDataByEmbedbox($pipeLineData['boxEmagazine'] ?? []);
        $boxEmagazine = $this->news->formatNewsDefault($boxEmagazine ?? [],230,144,[],4,0,0,4);

        $dataByZone = $this->news->prepareDataByZone($zoneConfig, $pipeLineData, $zoneALL, $keyByZone);

        $boxTapchi = $this->news->formatNewsWithUrls($pipeLineData['boxTapchi'] ?? [],'/bao-giay/',268, 370);
        $boxAnpham = $this->news->formatNewsWithUrls($pipeLineData['boxAnpham'] ?? [],'/bao-giay/',268, 370);

        $ZoneInfoClientScript =
            '<input type="hidden" name="hdZoneHome" id="hdZoneHome" value="1" />
             <input type="hidden" name="hdZoneId" id="hdZoneId" value="0" />
             <input type="hidden" name="hdPageIndex" id="hdPageIndex" value="1" />';
        $data = [
            'boxFocusHome' => $boxFocusHome ?? '',
            'boxFocusHome1' => !empty($boxFocusHome) ?array_slice($boxFocusHome,0,3): [],
            'boxFocusHome2' => !empty($boxFocusHome) ?array_slice($boxFocusHome,3,4): [],
            'listStreamHome' => $listStreamHome ?? '',
            'dataByZone' => $dataByZone ?? '',
            'boxEmagazine' => $boxEmagazine ?? '',
            'boxTapchi' => $boxTapchi ?? '',
            'boxAnpham' => $boxAnpham ?? '',
            'ZoneInfoClientScript' => $ZoneInfoClientScript ?? '',
        ];

        return view('mobile::home.index',$data);
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
        $zoneConfig = require(config_path() . '/keyPageMob/zone_home2.php');
        $keyByZone = $this->news->binKeyPipeline($zoneConfig ?? []);
        $homeKey = array_merge($keyByZone ?? [], include(config_path() . '/keyPageMob/home_page2.php'));
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($homeKey);

        // Xử lý dữ liệu theo vùng
        $dataByZone = $this->news->prepareDataByZone($zoneConfig, $pipeLineData, $zoneALL, $keyByZone);

        $data = [
            'dataByZone' => $dataByZone ?? '',
            'boxAnh' => $this->news->formatBoxData($pipeLineData['boxAnh'] ?? [], 642,401,[],5,0,0,5),
            'boxInfographic' => $this->news->formatBoxData($pipeLineData['boxInfographic'] ?? [], 642,401,[],5,0,0,5),
            'boxVideo' => $this->news->formatBoxData($pipeLineData['boxVideo'] ?? [], 642,401,[],10,0,0,10),
            'boxMostView' => $this->news->formatNewsDefault($pipeLineData['boxMostView'] ?? [], 642,401,[],6,0,0,6),

        ];
        return view('mobile::home.index2', $data);
    }
}
