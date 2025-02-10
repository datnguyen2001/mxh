<?php

namespace App\Http\Controllers;

use App\Helpers\FormatHelpers;
use App\Helpers\LoggerHelpers;
use App\Repositories\NewsRepository;
use App\Repositories\RedisPipeLineRepository;
use App\Repositories\VideoRepository;
use App\Repositories\ZoneRepository;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;

class VideoController extends BaseController
{
    protected $news;
    protected $zone;
    protected $video;
    protected $redisPipeLine;

    public function __construct(
        NewsRepository $news,
        ZoneRepository $zone,
        RedisPipeLineRepository $redisPipeLine,
        VideoRepository $video)
    {
        $this->news = $news;
        $this->zone= $zone;
        $this->redisPipeLine = $redisPipeLine;
        $this->video = $video;
    }

    public function index(Request $request)
    {
        //Tất cả Zone Video
        $zoneVideo = $this->video->getAllZoneVideo();
        $zoneVideoParent = [];
        foreach($zoneVideo as $key => $value){
            if($value->ParentId == 0 && $value->Url != 'truyen-hinh'  && $value->Url != 'phat-thanh'){
                $zoneVideoParent[$key] = $value;
            }
        }
        // video mới nhất theo zone video
        $subData = [];
        if (!empty($zoneVideoParent)){
            foreach ($zoneVideoParent as $key=>$value){
                $listKeyVideoByZone['videoInZone'.$value->Id]=[
                    'cmd' => 'zrevrange',
                    'key' => sprintf(config('keyredis.KeySortedVideoInZone'),$value->Id ?? ''),
                    'start' => 0,
                    'stop' => 3,
                    'maping'=>'KeySortedVideoInZone',
                ];
            }
        }

        $videoKey= include(config_path() . '/keyPageWeb/video.php');
        $videoKey=array_merge($videoKey,$listKeyVideoByZone);
        $pipeLineData = $this->redisPipeLine->getDataByPipeLine($videoKey);

        // video focus
        $videoFocus =$this->redisPipeLine->formatVideoDefault( $pipeLineData['listvideoFocus'],212,133);

        // video nổi bật
        $videoHighlight =$this->redisPipeLine->formatVideoDefault( $pipeLineData['listVideoHighlight'], 568,355,[],1,272,170);


        // video mới nhất
        $videoNewsList = $this->redisPipeLine->formatVideoDefault( $pipeLineData['listNewsVideoAll'],272, 170, $videoFocus,0,0,0,8);

        if (!empty($zoneVideoParent)){
            foreach ($zoneVideoParent as $key=>$value){
                $subData[$key]['info']=$value;
                $subData[$key]['data']=$this->redisPipeLine->formatVideoDefault( $pipeLineData['videoInZone'.$value->Id],478,299,[],1,128,80);
            }
        }

        if(!empty($videoFocus[0])){
            $ZoneInfoClientScript = $this->video->getInputHiddenVideo(0, $videoFocus[0]);
        }

        $data = [
            'videoFocus' => !empty($videoFocus) ? $videoFocus : [],
            'zoneVideo' => !empty($zoneVideoParent)?$zoneVideoParent:'',
            'videoHighlight' => !empty($videoHighlight)?$videoHighlight:'',
            'videoNewsList' => !empty($videoNewsList)?$videoNewsList:'',
            'subData' => !empty($subData)?$subData:'',
            'ZoneInfoClientScript'=>!empty($ZoneInfoClientScript)?$ZoneInfoClientScript:'',
        ];
        return view('video.index',$data);
    }


    /**
     * author: Thuylv
     * date: 2022-06-27
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector|\never
     */
    public function list(Request $request){

        $slug_video=$request->slug_video;
        //Tất cả Zone Video
        $zoneVideo=$this->zone->getAllZoneVideo();

        foreach ($zoneVideo as $value) {
            if ($value->Url == $slug_video && $value->ParentId == 0) {
                $zoneVideoInfo = $value;
            }
        }

        if (empty($zoneVideoInfo)){
            LoggerHelpers::CallApiSetLog('url='.$request->url(),'404');
            return abort(404);
        }


        // video focus
        $videoFocus = [];
        if (empty($videoFocus)){
            //Không có box cài lấy video mới nhất
            $videoFocus =[];
        }
        // video nổi bật
        $videoHighlight = [];
        $videoHighlight1 = FormatHelpers::formatNews(array_slice($videoHighlight,0,1),568,355);
        $videoHighlight = array_merge($videoHighlight1,array_slice($videoHighlight,1));

        // video mới nhất remove video Focus
        $videoNewsList = [];

        if(!empty($videoFocus)){
            $ZoneInfoClientScript = $this->video->getInputHiddenVideo(0, $videoFocus[0]);
        }

        $data = [
            'ZoneVideoInfo' => !empty($zoneVideoInfo)?$zoneVideoInfo:[],
            'zoneVideoParent' => '',
            'videoFocus' => !empty($videoFocus)?$videoFocus:[],
            'videoHighlight' => !empty($videoHighlight)?$videoHighlight:[],
            'videoNewsList' => !empty($videoNewsList)?$videoNewsList:[],
            'ZoneInfoClientScript' => !empty($ZoneInfoClientScript)?$ZoneInfoClientScript:[],
        ];

        return view('video.list' ,$data);
    }

    public function detail(Request $request)
    {
        //Video chi tiết
        $videoId = $request->video_id;
        $videoFocus = $this->video->getKeyVideo($videoId);
        $listVideoRemove = [];
        if (empty($videoFocus)) {
            LoggerHelpers::CallApiSetLog('url=' . $request->url(), '404');
            return abort(404);
        } else if ($request->path() != preg_replace('/\//', '', $videoFocus->Url, 1)) {
            return redirect($videoFocus->Url);
        }
        $zoneId = $videoFocus->ZoneId;
        if(!empty($videoFocus->VideoRelation)){
            // video liên quan
            $sameList = preg_split('/(,|;)/', $videoFocus->VideoRelation);
            $videoRelation = $this->video->hgetMultiKeyVideo($sameList,5,212,133);


            if (!empty($videoRelation)){
                $listVideoFocus=array_merge([$videoFocus],$videoRelation);
            }
        }else{
            $listVideoFocus=[$videoFocus];
        }

        // video cùng chuyên mục
        $listVideo = $this->video->zrevrangeKeySortedVideoInZone($zoneId,0,23,175,110,$listVideoRemove);
        $zoneInfo=$this->video->getZoneVideo($zoneId);

        // xem thêm
        $listVideoMore = FormatHelpers::formatNews(array_slice($listVideo,12),272,170);
        $ZoneInfoClientScript = $this->video->getInputHiddenVideo($zoneId, $videoFocus);
        $data = [
            'videoFocus' => !empty($videoFocus) ? $videoFocus : [],
            'listVideoFocus' => !empty($listVideoFocus) ? $listVideoFocus : [],
            'listVideo' => !empty($listVideo) ? $listVideo : [],
            'listVideoMore' => !empty($listVideoMore) ? $listVideoMore : [],
            'zoneInfo' => !empty($zoneInfo) ? $zoneInfo : [],
            'ZoneInfoClientScript' => !empty($ZoneInfoClientScript) ? $ZoneInfoClientScript : '',
        ];
        return view('video.detail', $data);
    }

    public function loadMorePaging(Request $request)
    {
        $options = [
            'videoW' => 272,
            'videoH' => 170,
        ];
        $list = $this->video->loadMorePaging($request, $options);
        if (!empty($list)){
            $data = ['listVideos'=>$list];
            return view('components.template.box-layout14',$data);
        }
        return null;
    }

}
